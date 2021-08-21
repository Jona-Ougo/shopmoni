<?php

$name = "shopmoni";
$user = "root";
$pass = "root";
$host = "127.0.0.1";

return [
    'paths' => [
        'migrations' => __DIR__ . '/migrations',
        'seeds' => __DIR__ . '/migrations/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'local',
        'local' => [
            'adapter' => 'mysql',
            'host' => 'mysqldb',
            'name' => $name,
            'user' => $user,
            'pass' => $pass,
            'port' => 3306
        ]
    ]
];