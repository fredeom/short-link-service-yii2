<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=127.0.0.1;dbname=short_link_db',
    'username' => 'alex',
    'password' => 'Qwerty123',
    'charset' => 'utf8',
    'schemaMap' => [
        'mysql' => SamIT\Yii2\MariaDb\Schema::class,
    ],
    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
