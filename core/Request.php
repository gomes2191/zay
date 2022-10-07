<?php
namespace App\Core;
class Request
{
    /*
     * Retorna a URL requisitada.
     */
    public static function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }
    /*
     * Retorna os métodos (I.E. GET, POST, etc) da requisição.
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
