<?php
/*
 * É aqui que as informações de configuração são armazenadas sobre a estrutura. Podemos adicionar opções extras, como o modo de erro PDO,
 * tempo limite de tempo do PDO ou quaisquer outros atributos que possam ser úteis.
 */
return [
    'database' => [
        'name' => 'people',
        'username' => 'root',
        'password' => 'password',
        'connection' => 'mysql:host=127.0.0.1',
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