<?php

/*
 * Redireciona o usuário para uma página.
 */
function redirect($path)
{
    header("Location: /{$path}");
}

/*
 * Retorna a view requisitada.
 */
function view($name, $data = [])
{
    extract($data);
    return require "../app/views/{$name}.view.php";
}
/*
 * Define o (dark mode) ou (light mode),
 * retorna o (dark mode) class string
 * ou (light mode) class string.
 */
function theme($class, $secondClass) {
    if (isset($_SESSION['darkmode']) && $_SESSION['darkmode'] == true) {
        return $class;
    }
    return $secondClass;
}

/*
 * Imprimi o valor passado, usado para debugar.
 */
function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

/*
 * Gera os links da páginação.
 */
function paginate($table, $page, $limit, $count)
{
    $offset = ($page - 1) * $limit;
    $output = "<span class='". theme('text-white-75', 'text-dark')  ."'>";
    if ($page > 1) {
        $prev = $page - 1;
        $output .= "<a href='/{$table}/{$prev}' class='".  theme('text-light', 'text-primary') ."'>Prev</a>";
    }
    $output .= " Page $page ";
    if ($count > ($offset + $limit)) {
        $next = $page + 1;
        $output .= "<a href='/{$table}/{$next}' class='".  theme('text-light', 'text-primary')  ."'>Next</a>";
    }
    $output .= "</span>";
    return $output;
}

/*
 * Exibe o valor de uma variável de sessão se ela existir.
*/
function session($name) {
    return $_SESSION[$name] ?? "";
}

/*
 * Exibe o valor de uma variável de sessão e a defini se existir.
 */
function session_once($name) {
    if (isset($_SESSION[$name])) {
        $value = $_SESSION[$name];
        unset($_SESSION[$name]);
        return $value;
    }
    return "";
}

/*
 * Apresenta os erros no navegador.
 */
function display_errors()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
