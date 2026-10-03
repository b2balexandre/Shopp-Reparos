<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarcaTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_cadastra_marca_e_ela_aparece_no_produto(): void
    {
        $admin = User::factory()->create(['perfil' => 'admin']);
        $categoria = Categoria::create(['nome' => 'Elétrica']);

        $this->actingAs($admin)
            ->post(route('admin.marcas.store'), ['nome' => 'Lorenzetti'])
            ->assertRedirect(route('admin.marcas.index'));

        $marca = Marca::query()->where('nome', 'Lorenzetti')->first();
        $this->assertNotNull($marca);

        $this->actingAs($admin)
            ->post(route('admin.produtos.store'), [
                'nome' => 'Chuveiro',
                'categoria_id' => $categoria->id,
                'marca_id' => $marca->id,
                'loja_aguas_claras' => 1,
            ])
            ->assertRedirect(route('admin.produtos.index'));

        $produto = Produto::query()->where('nome', 'Chuveiro')->first();
        $this->assertSame('Lorenzetti', $produto->marca);
        $this->assertSame($marca->id, $produto->marca_id);

        $this->actingAs($admin)
            ->get(route('admin.produtos.index'))
            ->assertOk()
            ->assertSee('Lorenzetti');

        $this->get('/site/produtos')
            ->assertOk()
            ->assertSee('Lorenzetti')
            ->assertSee('Chuveiro');

        $this->actingAs($admin)
            ->get(route('admin.marcas.show', $marca))
            ->assertOk()
            ->assertSee('Chuveiro');
    }

    public function test_renomear_marca_atualiza_os_produtos(): void
    {
        $admin = User::factory()->create(['perfil' => 'admin']);
        $categoria = Categoria::create(['nome' => 'Elétrica']);
        $marca = Marca::create(['nome' => 'Steck']);
        $produto = Produto::create([
            'nome' => 'Tomada',
            'marca' => 'Steck',
            'marca_id' => $marca->id,
            'categoria_id' => $categoria->id,
        ]);

        $this->actingAs($admin)
            ->put(route('admin.marcas.update', $marca), ['nome' => 'Steck Plus'])
            ->assertRedirect(route('admin.marcas.index'));

        $produto->refresh();
        $this->assertSame('Steck Plus', $produto->marca);
    }
}
