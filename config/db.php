<?php

return [
    'class' => 'yii\db\Connection',
    // Cambiamos "mysql" por "pgsql" y apuntamos al host "db" (el nombre del servicio en Docker)
    'dsn' => 'pgsql:host=db;port=5432;dbname=yii_database',
    'username' => 'admin',
    'password' => 'password',
    'charset' => 'utf8',

    // Opciones para entorno de desarrollo
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
