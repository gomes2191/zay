<?php
namespace App\Core;
use Exception;
class Router
{
    /*
     * Matriz de rotas. Até agora só funciona para GET e POST, mas isso pode ser alterado.
     */
    public $routes = [

        'GET' => [],
        'POST' => []

    ];

    /*
     * Carrega as rotas de um arquivo. Neste quadro, as rotas são armazenadas em app/routes.php.
     */
    public static function load($file)
    {
        $router = new static;

        require $file;
        
        return $router;
    }
    
    /*
     * Recebe a rota GET com base no URI e passa-a para o controlador.
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /*
     * Recebe a rota POST com base no URI e passa-a para o controlador.
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /*
     * Roteamento de notação de matriz recebe as rotas GET. O PHP não suporta sobrecarga de função (também conhecida como sobrecarga de método em OOP),
     * portanto não podemos nomear essa função obter mesmo que tenha um número diferente de parâmetros
     * do que a função get usada para roteamento sem anotação de matriz.
     */
    public function getArray($routes) 
    {
        $this->routes['GET'] = $routes;
    }
    /*
     * Roteamento de notação de matriz recebe as rotas POST.
     * O PHP não suporta sobrecarga de função (também conhecida como sobrecarga de método em OOP),
     * portanto não podemos nomear este posto de função mesmo que tenha um número diferente da função post usada para roteamento sem anotação de matriz.
     */
    public function postArray($routes)
    {
        $this->routes['POST'] = $routes;
    }  

    /*
     * Direciona o usuário para a rota com base no tipo de solicitação.
     */
    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );
        }

        foreach ($this->routes[$requestType] as $key => $value) {
            $pattern = preg_replace('#\(/\)#', '/?', $key);
            $pattern = "@^" . preg_replace('/{([\w\-]+)}/', '(?<$1>[\w\-]+)', $pattern) . "$@D";
            preg_match($pattern, $uri, $matches);
            array_shift($matches);
            if ($matches) {
                $action = explode('@', $value);
                return $this->callAction($action[0], $action[1], $matches);
            }
        }

        throw new Exception('No route defined for this URI.');
    }
    /*
     * Chama o controlador para uma ação.
     */
    protected function callAction($controller, $action, $vars = [])
    {
        $controller = "App\\Controllers\\{$controller}";

        $controller = new $controller;

        if (!method_exists($controller, $action))
        {
            throw new Exception("{$controller} does not respond to the {$action} action.");
        }

        return $controller->$action($vars);
    }
}