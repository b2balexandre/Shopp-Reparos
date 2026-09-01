<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Listar todos os usuários
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'perfil' => 'required|in:admin,tecnico,cliente',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'perfil' => $request->perfil,
        ]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuário criado com sucesso!');
    }

    // Exibir detalhes de um usuário
    public function show(User $user)
    {
        return view('usuarios.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('usuarios.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'perfil' => 'required|in:admin,tecnico,cliente',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'perfil' => $request->perfil,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuário excluído com sucesso!');
    }

    // Atualizar nível de acesso
    public function atualizarNivel(Request $request, User $user)
    {
        $request->validate([
            'perfil' => 'required|in:admin,tecnico,cliente',
        ]);
        $user->perfil = $request->perfil;
        $user->save();
        return redirect()->route('admin.usuarios.show', $user)->with('success', 'Nível de acesso atualizado com sucesso!');
    }
}
