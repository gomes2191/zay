<?php
/*
 * É aqui que as informações de configuração são armazenadas sobre a estrutura. Podemos adicionar opções extras, como o modo de erro PDO,
 * tempo limite de tempo do PDO ou quaisquer outros atributos que possam ser úteis.
 */

return [
    'database' => [
        'username' => 'user_dev',
        'password' => 'pass_dev',
        'connection' => 'mysql:host=mysql_host;dbname=bd_dev;charset=utf8mb4;port=3306',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        ]
    ],
    'options' => [
        'debug' => true,
        'production' => false,
        'array_routing' => false
    ]
    ];