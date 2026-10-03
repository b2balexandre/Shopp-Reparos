<?php

namespace App\Services;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;
use ZipArchive;

class ProdutoPlanilhaImporter
{
    private const NS = 'http://schemas.openxmlformats.org/spreadsheetml/2006/main';

    /**
     * Cria produtos a partir da planilha. Título já cadastrado não é alterado.
     *
     * @return array{criados: array<int, string>, ignorados: array<int, string>, sem_categoria: array<int, string>, erros: array<int, string>, imagens: int}
     */
    public function import(string $path, ?int $categoriaPadraoId = null): array
    {
        $zip = new ZipArchive();
        if ($zip->open($path) !== true) {
            throw new RuntimeException('Não foi possível abrir a planilha. Envie um arquivo .xlsx.');
        }

        try {
            $shared = $this->sharedStrings($zip);
            $sheets = $this->worksheets($zip);
            $existentes = $this->titulosExistentes();
            $categorias = $this->categoriasPorNome();

            $resultado = [
                'criados' => [],
                'ignorados' => [],
                'sem_categoria' => [],
                'erros' => [],
                'imagens' => 0,
            ];

            $houveAbaDeProduto = false;

            foreach ($sheets as $sheet) {
                $rows = $this->sheetRows($zip->getFromName($sheet['path']), $shared);
                $header = $this->mapearCabecalho($rows);
                if ($header === null) {
                    continue;
                }

                $houveAbaDeProduto = true;
                $imagens = $this->imagensPorLinha($zip, $sheet['path']);

                foreach ($rows as $numero => $cells) {
                    if ($numero <= $header['linha']) {
                        continue;
                    }

                    $nome = $this->celula($cells, $header['colunas'], 'nome');
                    if ($nome === '') {
                        continue;
                    }

                    $chave = $this->chaveTitulo($nome);
                    if (isset($existentes[$chave])) {
                        $resultado['ignorados'][] = $nome;
                        continue;
                    }

                    $categoriaId = $this->resolverCategoria(
                        $this->celula($cells, $header['colunas'], 'categoria'),
                        $categoriaPadraoId,
                        $categorias
                    );

                    if ($categoriaId === null) {
                        $resultado['sem_categoria'][] = $nome;
                        continue;
                    }

                    $marca = $this->marca($this->celula($cells, $header['colunas'], 'marca'));
                    $descricao = $this->descricao(
                        $this->celula($cells, $header['colunas'], 'especificacao'),
                        $this->celula($cells, $header['colunas'], 'observacoes'),
                        $this->celula($cells, $header['colunas'], 'link')
                    );

                    $produto = Produto::create([
                        'nome' => $nome,
                        'descricao' => $descricao !== '' ? $descricao : null,
                        'marca' => $marca,
                        'categoria_id' => $categoriaId,
                        'loja_aguas_claras' => true,
                        'loja_taguatinga' => true,
                    ]);

                    if (isset($imagens[$numero])) {
                        $arquivo = $this->salvarImagem($imagens[$numero]['bytes'], $imagens[$numero]['ext']);
                        if ($arquivo) {
                            $produto->imagem = $arquivo;
                            $produto->save();
                            $resultado['imagens']++;
                        }
                    }

                    $existentes[$chave] = true;
                    $resultado['criados'][] = $nome;
                }
            }

            if (! $houveAbaDeProduto) {
                $resultado['erros'][] = 'Nenhuma aba com a coluna Produto foi encontrada.';
            }

            return $resultado;
        } finally {
            $zip->close();
        }
    }

    public function mensagem(array $resultado): string
    {
        $partes = [];
        $partes[] = count($resultado['criados']).' '.($this->plural(count($resultado['criados']), 'produto criado', 'produtos criados'));

        if ($resultado['imagens'] > 0) {
            $partes[] = $resultado['imagens'].' '.($this->plural($resultado['imagens'], 'imagem salva', 'imagens salvas'));
        }

        if ($resultado['ignorados'] !== []) {
            $partes[] = count($resultado['ignorados']).' já cadastrados e mantidos sem alteração';
        }

        if ($resultado['sem_categoria'] !== []) {
            $partes[] = count($resultado['sem_categoria']).' sem categoria';
        }

        return implode('. ', $partes).'.';
    }

    private function plural(int $n, string $um, string $varios): string
    {
        return $n === 1 ? $um : $varios;
    }

    /**
     * @return array<int, string>
     */
    private function sharedStrings(ZipArchive $zip): array
    {
        $xml = $zip->getFromName('xl/sharedStrings.xml');
        if ($xml === false) {
            return [];
        }

        $doc = simplexml_load_string($xml);
        $strings = [];
        foreach ($doc->children(self::NS)->si as $si) {
            $parts = [];
            foreach ($si->children(self::NS)->t as $t) {
                $parts[] = (string) $t;
            }
            foreach ($si->children(self::NS)->r as $run) {
                foreach ($run->children(self::NS)->t as $t) {
                    $parts[] = (string) $t;
                }
            }
            $strings[] = trim(implode('', $parts));
        }

        return $strings;
    }

    /**
     * @return array<int, array{path: string}>
     */
    private function worksheets(ZipArchive $zip): array
    {
        $workbook = simplexml_load_string($zip->getFromName('xl/workbook.xml'));
        $rels = simplexml_load_string($zip->getFromName('xl/_rels/workbook.xml.rels'));
        $targets = [];
        foreach ($rels->Relationship as $rel) {
            $targets[$this->atributo($rel, 'Id')] = $this->atributo($rel, 'Target');
        }

        $sheets = [];
        $ns = $workbook->children(self::NS);
        foreach ($ns->sheets->sheet as $sheet) {
            $id = (string) $sheet->attributes('http://schemas.openxmlformats.org/officeDocument/2006/relationships')['id'];
            $target = $targets[$id] ?? null;
            if (! $target) {
                continue;
            }
            $path = str_starts_with($target, '/') ? ltrim($target, '/') : 'xl/'.ltrim($target, '/');
            $sheets[] = ['path' => $path];
        }

        return $sheets;
    }

    /**
     * @param  array<int, string>  $shared
     * @return array<int, array<string, string>>
     */
    private function sheetRows(string|false $xml, array $shared): array
    {
        if ($xml === false) {
            return [];
        }

        $doc = simplexml_load_string($xml);
        $rows = [];
        $sheetData = $doc->children(self::NS)->sheetData;
        if (! $sheetData) {
            return [];
        }

        foreach ($sheetData->row as $row) {
            $numero = (int) $this->atributo($row, 'r');
            $cells = [];
            foreach ($row->c as $cell) {
                $ref = $this->atributo($cell, 'r');
                $col = preg_replace('/\d+/', '', $ref) ?: '';
                $type = $this->atributo($cell, 't');
                if ($type === 's') {
                    $value = $shared[(int) $cell->v] ?? '';
                } elseif ($type === 'inlineStr') {
                    $value = '';
                    foreach ($cell->children(self::NS)->is->children(self::NS)->t as $t) {
                        $value .= (string) $t;
                    }
                } else {
                    $value = (string) $cell->v;
                }
                $cells[$col] = trim($value);
            }
            $rows[$numero] = $cells;
        }

        return $rows;
    }

    /**
     * @param  array<int, array<string, string>>  $rows
     * @return array{linha: int, colunas: array<string, string>}|null
     */
    private function mapearCabecalho(array $rows): ?array
    {
        foreach ($rows as $numero => $cells) {
            if ($numero > 8) {
                break;
            }
            $colunas = [];
            foreach ($cells as $col => $valor) {
                $campo = $this->campoDoCabecalho($valor);
                if ($campo && ! isset($colunas[$campo])) {
                    $colunas[$campo] = $col;
                }
            }
            if (isset($colunas['nome'])) {
                return ['linha' => $numero, 'colunas' => $colunas];
            }
        }

        return null;
    }

    private function campoDoCabecalho(string $valor): ?string
    {
        $h = $this->normalizar($valor);
        if ($h === '') {
            return null;
        }
        if (str_contains($h, 'produto') || $h === 'nome' || str_contains($h, 'nome do produto')) {
            return 'nome';
        }
        if (str_contains($h, 'especific') || $h === 'descricao' || str_contains($h, 'variac')) {
            return 'especificacao';
        }
        if (str_contains($h, 'marca') || str_contains($h, 'fabricante')) {
            return 'marca';
        }
        if (str_contains($h, 'categoria') || $h === 'grupo' || str_contains($h, 'departamento') || $h === 'linha') {
            return 'categoria';
        }
        if (str_contains($h, 'observ')) {
            return 'observacoes';
        }
        if (str_contains($h, 'link') || $h === 'url') {
            return 'link';
        }

        return null;
    }

    /**
     * @param  array<string, string>  $cells
     * @param  array<string, string>  $colunas
     */
    private function celula(array $cells, array $colunas, string $campo): string
    {
        $col = $colunas[$campo] ?? null;

        return $col ? trim($cells[$col] ?? '') : '';
    }

    private function descricao(string $especificacao, string $observacoes, string $link): string
    {
        $partes = [];
        foreach ([$especificacao, $observacoes] as $texto) {
            if ($texto === '' || $this->normalizar($texto) === 'imagem ilustrativa') {
                continue;
            }
            if (! in_array($texto, $partes, true)) {
                $partes[] = $texto;
            }
        }
        if ($link !== '' && filter_var($link, FILTER_VALIDATE_URL)) {
            $partes[] = 'Referência: '.$link;
        }

        return implode("\n", $partes);
    }

    private function marca(string $marca): ?string
    {
        $chave = $this->normalizar($marca);
        if ($chave === '' || in_array($chave, ['sem marca', 'sem marca definida', 'nao informada', 'nao informado', 'n a', 'nd', 's n'], true)) {
            return null;
        }

        return $marca;
    }

    /**
     * @param  array<string, int>  $categorias
     */
    private function resolverCategoria(string $nome, ?int $padraoId, array &$categorias): ?int
    {
        $nome = trim($nome);
        if ($nome !== '') {
            $chave = $this->chaveTitulo($nome);
            if (isset($categorias[$chave])) {
                return $categorias[$chave];
            }
            $categoria = Categoria::create(['nome' => $nome]);
            $categorias[$chave] = $categoria->id;

            return $categoria->id;
        }

        return $padraoId;
    }

    /**
     * @return array<string, true>
     */
    private function titulosExistentes(): array
    {
        $mapa = [];
        foreach (Produto::query()->pluck('nome') as $nome) {
            $mapa[$this->chaveTitulo((string) $nome)] = true;
        }

        return $mapa;
    }

    /**
     * @return array<string, int>
     */
    private function categoriasPorNome(): array
    {
        $mapa = [];
        foreach (Categoria::query()->get(['id', 'nome']) as $categoria) {
            $mapa[$this->chaveTitulo($categoria->nome)] = $categoria->id;
        }

        return $mapa;
    }

    private function chaveTitulo(string $nome): string
    {
        $nome = preg_replace('/\s+/u', ' ', trim($nome)) ?? trim($nome);

        return mb_strtolower($nome);
    }

    private function normalizar(string $valor): string
    {
        $valor = Str::ascii($valor);
        $valor = mb_strtolower($valor);
        $valor = preg_replace('/[^a-z0-9]+/', ' ', $valor) ?? '';

        return trim($valor);
    }

    /**
     * @return array<int, array{bytes: string, ext: string}>
     */
    private function imagensPorLinha(ZipArchive $zip, string $sheetPath): array
    {
        $relsPath = $this->relsPath($sheetPath);
        $relsXml = $zip->getFromName($relsPath);
        if ($relsXml === false) {
            return [];
        }

        $drawingPath = null;
        $rels = simplexml_load_string($relsXml);
        foreach ($rels->Relationship as $rel) {
            $type = $this->atributo($rel, 'Type');
            if (str_contains($type, '/drawing')) {
                $drawingPath = $this->resolveTarget(dirname($sheetPath), $this->atributo($rel, 'Target'));
                break;
            }
        }
        if (! $drawingPath) {
            return [];
        }

        $drawingRels = $zip->getFromName($this->relsPath($drawingPath));
        $midias = [];
        if ($drawingRels !== false) {
            $relDoc = simplexml_load_string($drawingRels);
            foreach ($relDoc->Relationship as $rel) {
                $midias[$this->atributo($rel, 'Id')] = $this->resolveTarget(dirname($drawingPath), $this->atributo($rel, 'Target'));
            }
        }

        $drawingXml = $zip->getFromName($drawingPath);
        if ($drawingXml === false) {
            return [];
        }

        $drawing = simplexml_load_string($drawingXml);
        $drawing->registerXPathNamespace('xdr', 'http://schemas.openxmlformats.org/drawingml/2006/spreadsheetDrawing');
        $drawing->registerXPathNamespace('a', 'http://schemas.openxmlformats.org/drawingml/2006/main');
        $drawing->registerXPathNamespace('r', 'http://schemas.openxmlformats.org/officeDocument/2006/relationships');

        $imagens = [];
        foreach ($drawing->xpath('//xdr:twoCellAnchor|//xdr:oneCellAnchor') ?: [] as $anchor) {
            $from = $anchor->xpath('xdr:from/xdr:row');
            $blip = $anchor->xpath('.//a:blip');
            if (! $from || ! $blip) {
                continue;
            }
            $linha = (int) $from[0] + 1;
            if (isset($imagens[$linha])) {
                continue;
            }
            $embed = (string) $blip[0]->attributes('http://schemas.openxmlformats.org/officeDocument/2006/relationships')['embed'];
            $media = $midias[$embed] ?? null;
            if (! $media) {
                continue;
            }
            $bytes = $zip->getFromName($media);
            if ($bytes === false) {
                continue;
            }
            $ext = strtolower(pathinfo($media, PATHINFO_EXTENSION));
            if (! in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
                continue;
            }
            $imagens[$linha] = ['bytes' => $bytes, 'ext' => $ext === 'jpeg' ? 'jpg' : $ext];
        }

        return $imagens;
    }

    private function atributo(\SimpleXMLElement $element, string $nome): string
    {
        $attributes = $element->attributes();

        return isset($attributes[$nome]) ? (string) $attributes[$nome] : '';
    }

    private function relsPath(string $part): string
    {
        $dir = dirname($part);
        $file = basename($part);

        return ($dir === '.' ? '' : $dir.'/').'_rels/'.$file.'.rels';
    }

    private function resolveTarget(string $baseDir, string $target): string
    {
        $target = str_replace('\\', '/', $target);
        if (str_starts_with($target, '/')) {
            return ltrim($target, '/');
        }

        $parts = explode('/', trim($baseDir, '/'));
        foreach (explode('/', $target) as $piece) {
            if ($piece === '' || $piece === '.') {
                continue;
            }
            if ($piece === '..') {
                array_pop($parts);
                continue;
            }
            $parts[] = $piece;
        }

        return implode('/', $parts);
    }

    private function salvarImagem(string $bytes, string $ext): ?string
    {
        $filename = uniqid('produto_').'.'.$ext;
        $relative = 'produtos/'.$filename;
        Storage::disk('public')->put($relative, $bytes);

        if (! is_link(public_path('storage'))) {
            $targetDir = public_path('storage/produtos');
            if (! is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            file_put_contents(public_path('storage/'.$relative), $bytes);
        }

        return $filename;
    }
}
