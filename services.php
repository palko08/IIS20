<?php

require_once 'connect_db.php';

class AccountService
{
	private $pdo;
	private $lastError;

	function __construct()
	{
		$this->pdo = connect_db();
		$this->lastError = NULL;
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
		if ($stmt->execute([$id, $email ,$login, $pwd, "divák"]))
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

	function getAccounts(){
        $stmt = $this->pdo->query('SELECT * FROM Registrovany',MYSQLI_USE_RESULT);

        return $stmt;
    }

    function deleteAccount($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM Clovek WHERE clovek_ID = ?');

        if ($stmt->execute([$id]))
        {
            return TRUE;
        }
        else
        {
            $this->lastError = $stmt->errorInfo();
            return FALSE;
        }
    }

    function update($login,$email,$level_opravnenia, $id){
        try{
            $select = $this->pdo->prepare("UPDATE Registrovany SET login = ?, SET email = ?, SET level_opravnenia = ?  WHERE registrovany_ID = ?");
            $select->execute([$login,$email, $level_opravnenia, $id]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
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