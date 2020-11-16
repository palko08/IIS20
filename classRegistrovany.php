<?php

class Registrovany{

	private $registrovanyID;

    function __construct(){

    }

    function __destruct(){

    }

	/**
 	 *  @brief Funkcia pre priradenie instancie classy Registrovany k danemu rowu v databaze
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *	@param id ID daneho rowu v databaze
 	 *
 	 *	@return 0 ak sa ID najde, -1 ak sa ID nenajde
 	 */
    function initExistingRegistrovany($pdo, $id){
    	$idSelect = $pdo->prepare("SELECT registrovany_ID FROM Registrovany WHERE registrovany_ID = ?");
    	$idSelect->execute([$id]);

    	if($idSelect->rowCount() == 1){
    		$this->registrovanyID = $idSelect->fetchColumn();
    		return 0;
    	}else{
    		return -1;
    	}
    }

    /**
     *  @brief Funkcia pre vytvorenie noveho rowu v databaze v tabulke Registrovany a priradenie daneho Registrovanyu do instancie classy Registrovany
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *  @param clovek_ID, email, login, heslo, level_opravnenia Parametre reprezentujuce data vkladane do tabulky
     *
     *  @return ID vlozeneho rowu, alebo ID uz existujuceho rowu, -1 ak sa nepodarilo vlozit dany row
     */
    function createNewRegistrovany($pdo, $clovek_ID, $email, $login, $heslo, $level_opravnenia){
        $testID = $pdo->prepare("SELECT clovek_ID FROM Clovek WHERE clovek_ID = ?");
        $testID->execute([$clovek_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $testSelect = $pdo->prepare("SELECT registrovany_ID FROM Registrovany WHERE registrovany_ID = ? AND email = ? AND login = ? AND heslo = ? AND level_opravnenia = ?");
        $testSelect->execute([$clovek_ID, $email, $login, $heslo, $level_opravnenia]);

        if($testSelect->rowCount() == 1){
            return $testSelect->fetchColumn();
        }else{
            $insert = $pdo->prepare("INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia) VALUES(?, ?, ?, ?, ?)");
            $insert->execute([$clovek_ID, $email, $login, $heslo, $level_opravnenia]);

            $select = $pdo->prepare("SELECT registrovany_ID FROM Registrovany WHERE registrovany_ID = ? AND email = ? AND login = ? AND heslo = ? AND level_opravnenia = ?");
            $select->execute([$clovek_ID, $email, $login, $heslo, $level_opravnenia]);

            if($select->rowCount() == 1){
                $this->registrovanyID = $select->fetchColumn();
                return $this->registrovanyID;
            }else{
                return -1;
            }
        }
    }

    /**
     *  @brief Funkcia pre vymazanie rowu, ktoreho reprezentaciou je dana instancia classy Registrovany
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return 0 ak sa delete podaril, -1 ak nie
     */
    function deleteRegistrovany($pdo){
        $delete = $pdo->prepare("DELETE FROM Registrovany WHERE registrovany_ID = ?");
        $delete->execute([$this->registrovanyID]);

        $select = $pdo->prepare("SELECT registrovany_ID FROM Registrovany WHERE registrovany_ID = ?");
        $select->execute([$this->registrovanyID]);
        if($select->rowCount() == 0){
            return 0;
        }else{
            return -1;
        }
    }

    /**
 	 *  @brief Funkcie pre vytahovanie dat z databazy
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *
 	 *	@return Najdene data, pri nenajdeni by hodnota mala byt NULL
 	 */
    function getID(){
        return $this->registrovanyID;
    }

    function getEmail($pdo){
    	$select = $pdo->prepare("SELECT email FROM Registrovany WHERE registrovany_ID = ?");
    	$select->execute([$this->registrovanyID]);
    	return $select->fetchColumn();
    }

    function getLogin($pdo){
        $select = $pdo->prepare("SELECT login FROM Registrovany WHERE registrovany_ID = ?");
        $select->execute([$this->registrovanyID]);
        return $select->fetchColumn();
    }

    function getHeslo($pdo){
        $select = $pdo->prepare("SELECT heslo FROM Registrovany WHERE registrovany_ID = ?");
        $select->execute([$this->registrovanyID]);
        return $select->fetchColumn();
    }

    function getLevel_opravnenia($pdo){
        $select = $pdo->prepare("SELECT level_opravnenia FROM Registrovany WHERE registrovany_ID = ?");
        $select->execute([$this->registrovanyID]);
        return $select->fetchColumn();
    }

    function getFoto($pdo){
        $select = $pdo->prepare("SELECT foto FROM Registrovany WHERE registrovany_ID = ?");
        $select->execute([$this->registrovanyID]);
        return $select->fetchColumn();
    }

    /**
 	 *  @brief Funkcie pre updatovanie dat v databaze
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *  @param data Data vkladane do databazy ako update
 	 *
 	 *	@return 0 ak sa update podari, 1 ak sa nepodari
 	 */
    function setEmail($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Registrovany SET email = ? WHERE registrovany_ID = ?");
    		$select->execute([$data, $this->registrovanyID]);
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

    function setLogin($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Registrovany SET login = ? WHERE registrovany_ID = ?");
            $select->execute([$data, $this->registrovanyID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    function setHeslo($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Registrovany SET heslo = ? WHERE registrovany_ID = ?");
            $select->execute([$data, $this->registrovanyID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    function setLevel_opravnenia($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Registrovany SET level_opravnenia = ? WHERE registrovany_ID = ?");
            $select->execute([$data, $this->registrovanyID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    function setFoto($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Registrovany SET foto = ? WHERE registrovany_ID = ?");
            $select->execute([$data, $this->registrovanyID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

}

?>