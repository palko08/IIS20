<?php

    function connect_db()
    {
        try {
			$pdo = new PDO("mysql:host=localhost;dbname=IIS2020;port=/var/run/mysql/mysql.sock", 'xsubap00', 'SekierZ00*');
    	} catch (PDOException $e) {
			echo "Connection error: ".$e->getMessage();
			die();
    	}

        return $pdo;
    }