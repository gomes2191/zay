<?php

/*
 *  Controlador de usuários. Ele adiciona e retorna a lista de usuários dessa estrutura.
 */

namespace App\Controllers;

use App\Core\App;
use App\Models\User;

class UsersController
{
    /*
     *  Seleciona todos os usuários no BD, em seguida, retorna a visualização na view.
     */
    public function index($vars = [])
    {
        $user = new User();
        $count = $user->count();
        $limit = 5;
        $page = $vars['page'] ?? 1;
        $offset = ($page - 1) * $limit;
        $users = $user->where([['user_id', '>', '0']], $limit, $offset)->get();
        return view('users', compact('users', 'count', 'page', 'limit'));
    }

    /*
     *  Seleciona um usuário no BD, em seguida, retorna a visualização na view.
     */
    public function show($vars)
    {
        //Aqui usamos o Query Builder para obter o usuário:
        /*$user = App::DB()->selectAllWhere('users', [
        ['user_id', '=', $vars['id']],
        ]);
         */

        //Aqui usamos o ORM para obter o usuário:
        $user = new User();
        $foundUser = $user->find($vars['id']);
        $user = $foundUser ? $foundUser->get() : [];

        if (empty($user)) {
            redirect('users');
        }
        return view('user', compact('user'));
    }

    /*
     *  Insere um novo usuário em nosso banco de dados usando a notação de array.
     */
    public function store()
    {
        App::DB()->insert('users', [
            'name' => $_POST['name'],
        ]);
        return redirect('users');
    }

    /*
     *  Atualiza um usuário do nosso banco de dados usando a notação de array.
     */
    public function update($vars)
    {
        App::DB()->updateWhere('users', [
            'name' => $_POST['name'],
        ], [
            ['user_id', '=', $vars['id']],
        ]);
        return redirect('user/' . $vars['id']);
    }

    /*
     *  Exclui um usuário do nosso banco de dados.
     */
    public function delete($vars)
    {
        App::DB()->deleteWhere('users', [
            ['user_id', '=', $vars['id']],
        ]);
        return redirect('users');
    }
}
