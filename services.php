<?php

class AccountService
{
	private $pdo;
	private $lastError;

	function __construct()
	{
		$this->pdo = $this->connect_db();
		$this->lastError = NULL;
	}

	function connect_db()
	{
		$dsn = 'mysql:host=localhost;port=3306;dbname=IIS2020';
		$username = 'xsubap00';
		$password = "SekierZ00*";
		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

		$pdo = new PDO($dsn, $username, $password, $options);

		return $pdo;
	}

	function getErrorMessage()
	{
		if ($this->lastError === NULL)
		{
			return '';
		}
		else 
		{
			return $this->lastError[2];	
		}
	}

	function addAccount($data)
	{
		$stmt = $this->pdo->prepare('INSERT INTO Clovek (meno) VALUES (?)');
		$meno = $data['meno'];
		if ($stmt->execute([$meno]))
		{
			$id = $this->pdo->lastInsertId();
		}
		else 
		{
			$this->lastError = $stmt->errorInfo();
			return FALSE;	
		}


		$stmt = $this->pdo->prepare('INSERT INTO Registrovany (registrovany_ID ,email ,login, heslo, level_opravnenia) VALUES (?,?,?,?,?)');
		$email = $data['email'];
		$login = $data['login'];
		$pwd = password_hash($data['heslo'], PASSWORD_DEFAULT);
		if ($stmt->execute([$id, $email ,$login, $pwd, "divak"]))
		{
			$newid = $this->pdo->lastInsertId();
			$data['id'] = $newid;
			return $data;	
		}
		else 
		{
			$this->lastError = $stmt->errorInfo();
			$stmt = $this->pdo->prepare('DELETE FROM Clovek WHERE meno = ?');
			$stmt->execute([$meno]);
			return FALSE;
		}
	}

	function getAccount($login)
	{
		$stmt = $this->pdo->prepare('SELECT registrovany_ID, email, login, heslo, level_opravnenia FROM Registrovany WHERE login = ?');
		$stmt->execute([$login]);
		return $stmt->fetch();
	}

	function isValidAccount($login, $password)
	{
		$data = $this->getAccount($login);
		return password_verify($password, $data['heslo']);
	}

	function getName($login)
	{
		$person = $this->getAccount($login);
		$stmt = $this->pdo->prepare('SELECT meno FROM Clovek WHERE clovek_ID = ?');
		$stmt->execute([$person['registrovany_ID']]);
		$person = $stmt->fetch();
		return $person['meno'];
	}
}