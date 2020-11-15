<?php

    function connect_db()
    {
        $dsn = 'mysql:host=localhost;port=3306;dbname=IIS2020';
        $username = 'dasa';
        $password = "Mandarinka";
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        $pdo = new PDO($dsn, $username, $password, $options);

        return $pdo;
    }