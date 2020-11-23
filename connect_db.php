<?php

    function connect_db()
    {
    	try {
			$pdo = new PDO("mysql:host=localhost;dbname=xpalko08;port=/var/run/mysql/mysql.sock", 'xpalko08', '6refegin');
    	} catch (PDOException $e) {
			echo "Connection error: ".$e->getMessage();
			die();
    	}

        return $pdo;
    }