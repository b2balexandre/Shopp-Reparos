<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Promocao;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PromocaoTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['perfil' => 'admin']);
    }

    public function test_pagina_mostra_apenas_promocoes_vigentes(): void
    {
        $hoje = Promocao::hoje();
        Promocao::create(['titulo' => 'Oferta no ar', 'preco_de' => 100, 'preco_por' => 75, 'termina_em' => $hoje]);
        Promocao::create(['titulo' => 'Oferta pausada', 'ativo' => false]);
        Promocao::create(['titulo' => 'Oferta futura', 'inicia_em' => $hoje->copy()->addDay()]);
        Promocao::create(['titulo' => 'Oferta vencida', 'termina_em' => $hoje->copy()->subDay()]);

        $this->get('/promocoes')
            ->assertOk()
            ->assertSee('Oferta no ar')
            ->assertSee('-25%')
            ->assertSee('Último dia')
            ->assertSee('R$ 75,00')
            ->assertDontSee('Oferta pausada')
            ->assertDontSee('Oferta futura')
            ->assertDontSee('Oferta vencida');
    }

    public function test_pagina_vazia_convida_para_o_whatsapp(): void
    {
        $this->get('/promocoes')
            ->assertOk()
            ->assertSee('Nenhuma promoção no ar agora');
    }

    public function test_admin_cadastra_promocao_com_imagem_e_produto(): void
    {
        Storage::fake('public');
        $categoria = Categoria::create(['nome' => 'Elétrica']);
        $produto = Produto::create(['nome' => 'Disjuntor C16', 'categoria_id' => $categoria->id, 'preco' => 30]);

        $this->actingAs($this->admin())
            ->post(route('admin.promocoes.store'), [
                'titulo' => 'Disjuntor C16 em oferta',
                'selo' => 'Queima de estoque',
                'produto_id' => $produto->id,
                'preco_de' => '30',
                'preco_por' => '19.90',
                'loja_taguatinga' => 1,
                'ativo' => 1,
                'destaque' => 1,
                'imagem' => UploadedFile::fake()->createWithContent('arte.png', base64_decode(
                    'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg=='
                )),
            ])
            ->assertRedirect(route('admin.promocoes.index'));

        $promocao = Promocao::firstOrFail();
        $this->assertTrue($promocao->destaque);
        $this->assertFalse($promocao->loja_aguas_claras);
        $this->assertSame(34, $promocao->desconto);
        Storage::disk('public')->assertExists('promocoes/' . $promocao->imagem);

        $this->get('/promocoes')
            ->assertOk()
            ->assertSee('Disjuntor C16 em oferta')
            ->assertSee('Queima de estoque')
            ->assertSee('Ofertas em destaque')
            ->assertSee('5561999318077')
            ->assertDontSee('5561996096296&amp;text=Ol%C3%A1%21%20Vi', false);
    }

    public function test_modo_so_imagem_publica_o_panfleto_sem_texto_nem_preco(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin())
            ->post(route('admin.promocoes.store'), [
                'modo' => 'imagem',
                'titulo' => '',
                'preco_de' => '50',
                'preco_por' => '60',
                'destaque' => 1,
                'loja_aguas_claras' => 1,
                'ativo' => 1,
                'imagem' => UploadedFile::fake()->createWithContent('panfleto.png', base64_decode(
                    'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg=='
                )),
            ])
            ->assertRedirect(route('admin.promocoes.index'));

        $panfleto = Promocao::firstOrFail();
        $this->assertTrue($panfleto->so_imagem);
        $this->assertStringStartsWith('Panfleto ', $panfleto->titulo);
        $this->assertNull($panfleto->preco_de);
        $this->assertNull($panfleto->preco_por);
        $this->assertFalse($panfleto->destaque);

        $this->get('/promocoes')
            ->assertOk()
            ->assertSee('Panfletos de ofertas')
            ->assertSee('Ampliar panfleto')
            ->assertSee('storage/promocoes/' . $panfleto->imagem)
            ->assertDontSee('Ofertas em destaque');
    }

    public function test_modo_so_imagem_exige_imagem(): void
    {
        $this->actingAs($this->admin())
            ->post(route('admin.promocoes.store'), [
                'modo' => 'imagem',
                'loja_aguas_claras' => 1,
            ])
            ->assertSessionHasErrors('imagem')
            ->assertSessionDoesntHaveErrors('titulo');
    }

    public function test_validacao_de_preco_e_lojas(): void
    {
        $this->actingAs($this->admin())
            ->post(route('admin.promocoes.store'), [
                'titulo' => 'Errada',
                'preco_de' => '50',
                'preco_por' => '60',
            ])
            ->assertSessionHasErrors(['preco_por', 'lojas']);

        $this->assertSame(0, Promocao::count());
    }

    public function test_termino_antes_do_inicio_e_recusado(): void
    {
        $this->actingAs($this->admin())
            ->post(route('admin.promocoes.store'), [
                'titulo' => 'Datas trocadas',
                'loja_aguas_claras' => 1,
                'inicia_em' => '2026-10-20',
                'termina_em' => '2026-10-10',
            ])
            ->assertSessionHasErrors('termina_em');
    }

    public function test_cliente_nao_acessa_o_painel(): void
    {
        $cliente = User::factory()->create(['perfil' => 'cliente']);

        $this->actingAs($cliente)->get(route('admin.promocoes.index'))->assertForbidden();
        $this->actingAs($cliente)->post(route('admin.promocoes.store'), ['titulo' => 'x'])->assertForbidden();
    }

    public function test_pausar_duplicar_e_excluir(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('promocoes/original.jpg', 'img');
        $promocao = Promocao::create(['titulo' => 'Furadeira', 'imagem' => 'original.jpg']);
        $admin = $this->admin();

        $this->actingAs($admin)->patch(route('admin.promocoes.toggle', $promocao));
        $this->assertFalse($promocao->fresh()->ativo);
        $this->assertSame('pausada', $promocao->fresh()->status);

        $this->actingAs($admin)->post(route('admin.promocoes.duplicate', $promocao));
        $copia = Promocao::where('id', '!=', $promocao->id)->firstOrFail();
        $this->assertSame('Furadeira (cópia)', $copia->titulo);
        $this->assertFalse($copia->ativo);
        $this->assertNotSame('original.jpg', $copia->imagem);
        Storage::disk('public')->assertExists('promocoes/' . $copia->imagem);

        $this->actingAs($admin)->delete(route('admin.promocoes.destroy', $promocao))
            ->assertRedirect(route('admin.promocoes.index'));
        $this->assertNull($promocao->fresh());
        Storage::disk('public')->assertMissing('promocoes/original.jpg');
        Storage::disk('public')->assertExists('promocoes/' . $copia->imagem);
    }

    public function test_painel_lista_e_filtra_por_situacao(): void
    {
        Promocao::create(['titulo' => 'Ativa agora']);
        Promocao::create(['titulo' => 'Parada', 'ativo' => false]);

        $this->actingAs($this->admin())
            ->get(route('admin.promocoes.index', ['status' => 'pausada']))
            ->assertOk()
            ->assertSee('Parada')
            ->assertDontSee('Ativa agora');
    }
}
