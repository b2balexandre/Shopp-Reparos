<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ResponsavelController extends Controller
{
    public function index()
    {
        $responsaveis = User::orderBy('name')->get();
        return view('responsaveis.index', compact('responsaveis'));
    }

    public function create()
    {
        return view('responsaveis.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'foto' => 'nullable|image|max:2048',
            'telefone' => 'nullable',
            'valor_hora' => 'nullable|numeric',
        ]);
        $data['password'] = Hash::make($data['password']);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('responsaveis', 'public');
        }
        $user = User::create($data);
        return redirect()->route('admin.responsaveis.index')->with('success', 'Responsável cadastrado!');
    }
}
