<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Produto;
use App\Models\User;
use App\Services\ProdutoPlanilhaImporter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use ZipArchive;

class ProdutoPlanilhaImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_planilha_cria_produto_novo_e_nao_substitui_titulo_existente(): void
    {
        $categoria = Categoria::create(['nome' => 'Elétrica']);
        $existente = Produto::create([
            'nome' => 'Interruptor simples',
            'descricao' => 'Texto original que deve permanecer',
            'marca' => 'Original',
            'categoria_id' => $categoria->id,
        ]);

        $resultado = app(ProdutoPlanilhaImporter::class)->import($this->planilhaComImagem(), $categoria->id);

        $this->assertSame(['Lâmpada LED bulbo', 'Tomada 2P+T'], $resultado['criados']);
        $this->assertSame(['Interruptor simples'], $resultado['ignorados']);
        $this->assertSame(1, $resultado['imagens']);

        $lampada = Produto::query()->where('nome', 'Lâmpada LED bulbo')->first();
        $this->assertNotNull($lampada);
        $this->assertNull($lampada->marca);
        $this->assertSame('9W, 12W e 15W', $lampada->descricao);
        $this->assertSame($categoria->id, $lampada->categoria_id);
        $this->assertNotNull($lampada->imagem);
        $this->assertFileExists(storage_path('app/public/produtos/'.$lampada->imagem));

        $tomada = Produto::query()->where('nome', 'Tomada 2P+T')->first();
        $this->assertSame('Tramontina', $tomada->marca);
        $this->assertSame('Hidráulica', $tomada->categoria->nome);

        $existente->refresh();
        $this->assertSame('Texto original que deve permanecer', $existente->descricao);
        $this->assertSame('Original', $existente->marca);
        $this->assertNull($existente->imagem);
    }

    public function test_planilha_so_acrescenta_foto_em_produto_que_ja_existe(): void
    {
        $categoria = Categoria::create(['nome' => 'Elétrica']);
        $existente = Produto::create([
            'nome' => 'Tomada 2P+T',
            'descricao' => 'Descrição que deve permanecer',
            'marca' => 'Steck',
            'categoria_id' => $categoria->id,
        ]);

        $resultado = app(ProdutoPlanilhaImporter::class)->import($this->planilhaComFotoNaCelula());

        $this->assertSame([], $resultado['criados']);
        $this->assertSame(1, $resultado['imagens']);
        $existente->refresh();
        $this->assertSame('Descrição que deve permanecer', $existente->descricao);
        $this->assertSame('Steck', $existente->marca);
        $this->assertNotNull($existente->imagem);
        $this->assertFileExists(storage_path('app/public/produtos/'.$existente->imagem));
    }

    public function test_admin_envia_a_planilha_pela_tela(): void
    {
        $admin = User::factory()->create(['perfil' => 'admin']);
        $categoria = Categoria::create(['nome' => 'Elétrica']);
        $arquivo = new UploadedFile($this->planilhaComImagem(), 'catalogo.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', null, true);

        $this->actingAs($admin)
            ->post(route('admin.produtos.importar.store'), [
                'planilha' => $arquivo,
                'categoria_id' => $categoria->id,
            ])
            ->assertRedirect(route('admin.produtos.index'));

        $this->assertDatabaseHas('produtos', ['nome' => 'Lâmpada LED bulbo']);
    }

    private function planilhaComImagem(): string
    {
        $path = storage_path('app/planilha-teste-'.uniqid().'.xlsx');
        $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==');

        $shared = <<<'XML'
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<sst xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" count="12" uniqueCount="12">
<si><t>Produto</t></si>
<si><t>Especificação / variações</t></si>
<si><t>Marca</t></si>
<si><t>Categoria</t></si>
<si><t>Lâmpada LED bulbo</t></si>
<si><t>9W, 12W e 15W</t></si>
<si><t>sem marca definida</t></si>
<si><t>Elétrica</t></si>
<si><t>Tomada 2P+T</t></si>
<si><t>10A e 20A</t></si>
<si><t>Tramontina</t></si>
<si><t>Hidráulica</t></si>
<si><t>Interruptor simples</t></si>
<si><t>Descrição nova que não pode substituir</t></si>
</sst>
XML;

        $sheet = <<<'XML'
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
<sheetData>
<row r="1">
<c r="B1" t="s"><v>0</v></c>
<c r="C1" t="s"><v>1</v></c>
<c r="D1" t="s"><v>2</v></c>
<c r="E1" t="s"><v>3</v></c>
</row>
<row r="2">
<c r="B2" t="s"><v>4</v></c>
<c r="C2" t="s"><v>5</v></c>
<c r="D2" t="s"><v>6</v></c>
<c r="E2" t="s"><v>7</v></c>
</row>
<row r="3">
<c r="B3" t="s"><v>8</v></c>
<c r="C3" t="s"><v>9</v></c>
<c r="D3" t="s"><v>10</v></c>
<c r="E3" t="s"><v>11</v></c>
</row>
<row r="4">
<c r="B4" t="s"><v>12</v></c>
<c r="C4" t="s"><v>13</v></c>
<c r="D4" t="s"><v>10</v></c>
<c r="E4" t="s"><v>7</v></c>
</row>
</sheetData>
</worksheet>
XML;

        $drawing = <<<'XML'
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<xdr:wsDr xmlns:xdr="http://schemas.openxmlformats.org/drawingml/2006/spreadsheetDrawing" xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
<xdr:oneCellAnchor>
<xdr:from><xdr:col>5</xdr:col><xdr:colOff>0</xdr:colOff><xdr:row>1</xdr:row><xdr:rowOff>0</xdr:rowOff></xdr:from>
<xdr:ext cx="100" cy="100"/>
<xdr:pic>
<xdr:nvPicPr><xdr:cNvPr id="2" name="Foto"/><xdr:cNvPicPr/></xdr:nvPicPr>
<xdr:blipFill><a:blip r:embed="rId1"/></xdr:blipFill>
<xdr:spPr/>
</xdr:pic>
<xdr:clientData/>
</xdr:oneCellAnchor>
</xdr:wsDr>
XML;

        $zip = new ZipArchive();
        $zip->open($path, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $zip->addFromString('xl/sharedStrings.xml', $shared);
        $zip->addFromString('xl/worksheets/sheet1.xml', $sheet);
        $zip->addFromString('xl/workbook.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><sheets><sheet name="Catalogo" sheetId="1" r:id="rId1"/></sheets></workbook>');
        $zip->addFromString('xl/_rels/workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/></Relationships>');
        $zip->addFromString('xl/worksheets/_rels/sheet1.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/drawing" Target="../drawings/drawing1.xml"/></Relationships>');
        $zip->addFromString('xl/drawings/drawing1.xml', $drawing);
        $zip->addFromString('xl/drawings/_rels/drawing1.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="../media/image1.png"/></Relationships>');
        $zip->addFromString('xl/media/image1.png', $png);
        $zip->close();

        return $path;
    }

    private function planilhaComFotoNaCelula(): string
    {
        $path = storage_path('app/planilha-celula-'.uniqid().'.xlsx');
        $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==');
        $shared = <<<'XML'
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<sst xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
<si><t>Produto</t></si>
<si><t>Tomada 2P+T</t></si>
<si><t>Descrição nova que não pode substituir</t></si>
</sst>
XML;
        $sheet = <<<'XML'
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
<sheetData>
<row r="1"><c r="B1" t="s"><v>0</v></c></row>
<row r="2">
<c r="B2" t="s"><v>1</v></c>
<c r="C2" t="s"><v>2</v></c>
<c r="F2"><f>_xlfn.DISPIMG(&quot;ID_TOMADA&quot;,1)</f></c>
</row>
</sheetData>
</worksheet>
XML;
        $cellImages = <<<'XML'
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<etc:cellImages xmlns:etc="http://www.wps.cn/officeDocument/2017/etCustomData" xmlns:xdr="http://schemas.openxmlformats.org/drawingml/2006/spreadsheetDrawing" xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
<etc:cellImage>
<xdr:pic>
<xdr:nvPicPr><xdr:cNvPr id="2" name="ID_TOMADA"/></xdr:nvPicPr>
<xdr:blipFill><a:blip r:embed="rId1"/></xdr:blipFill>
</xdr:pic>
</etc:cellImage>
</etc:cellImages>
XML;

        $zip = new ZipArchive();
        $zip->open($path, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $zip->addFromString('xl/sharedStrings.xml', $shared);
        $zip->addFromString('xl/worksheets/sheet1.xml', $sheet);
        $zip->addFromString('xl/workbook.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><sheets><sheet name="Catalogo" sheetId="1" r:id="rId1"/></sheets></workbook>');
        $zip->addFromString('xl/_rels/workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/></Relationships>');
        $zip->addFromString('xl/cellimages.xml', $cellImages);
        $zip->addFromString('xl/_rels/cellimages.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/tomada.png"/></Relationships>');
        $zip->addFromString('xl/media/tomada.png', $png);
        $zip->close();

        return $path;
    }
}
