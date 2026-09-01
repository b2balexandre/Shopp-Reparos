<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function loginTest(Request $request)
    {
        $email = $request->get('email', 'teste@teste.com');
        $password = $request->get('password', '123456');
        $ok = Auth::attempt(['email' => $email, 'password' => $password]);
        if ($ok) {
            return 'SUCESSO! Usuário autenticado: ' . Auth::user()->name . ' (' . Auth::user()->email . ')';
        } else {
            return 'FALHA ao autenticar com: ' . $email . ' / ' . $password;
        }
    }
}
