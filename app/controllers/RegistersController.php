<?php

namespace App\Controllers;

use App\Models\Register;

class RegistersController
{
    /*
     *  Seleciona todos os usuários no BD, em seguida, retorna a visualização na view.
     */
    public function index($vars = [])
    {
        $user = new Register();
        $count = $user->count();
        $limit = 5;
        $page = $vars['page'] ?? 1;
        $offset = ($page - 1) * $limit;
        $users = $user->where([['id', '>', '0']], $limit, $offset)->get();
        return view('/register/register', compact('users', 'count', 'page', 'limit'));
    }

    /*
     *  Insere um novo usuário em nosso banco de dados usando a notação de array.
     */
    public function store()
    {
        $model = new Register();
        $model->add([
            'name' => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS),
            'email' => filter_input(INPUT_POST , 'email', FILTER_SANITIZE_EMAIL),
            'password' => filter_input(INPUT_POST, 'password')
        ]);


        return redirect('register');
    }

    protected function user_exist(){

    }

}