<?php

/*
 *  Este é o controlador de página. Ele retorna uma visualização para páginas na estrutura,
 *  é onde você adiciona uma view para quaisquer páginas adicionais que possam ser adicionadas posteriormente.
 */

namespace App\Controllers;

class PagesController
{
    /*
     *  Retorna a view inicial.
     */
    public function home()
    {
        return view('index');
    }

    /*
     *  Retorna a view about e passa a variável para que possa ser extraída pela view.
     */
    public function about()
    {
        $link = "#";
        return view('about', compact('link'));
    }

    /*
     *  Retorna a view contato.
     */
    public function contact()
    {
        $title = "Meu Contato";
        $email = "gomes.tisystem@gmail.com";
        $website = "#";
        return view('contact', compact('title', 'email', 'website'));
    }
}
