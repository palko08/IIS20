<?php

class Podium{

	private $podiumID;

    function __construct(){

    }

    function __destruct(){

    }

	/**
 	 *  @brief Funkcia pre priradenie instancie classy Podium k danemu rowu v databaze
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *	@param id ID daneho rowu v databaze
 	 *
 	 *	@return 0 ak sa ID najde, -1 ak sa ID nenajde
 	 */
    function initExistingPodium($pdo, $id){
    	$idSelect = $pdo->prepare("SELECT podium_ID FROM Podium WHERE podium_ID = ?");
    	$idSelect->execute([$id]);

    	if($idSelect->rowCount() == 1){
    		$this->podiumID = $idSelect->fetchColumn();
    		return 0;
    	}else{
    		return -1;
    	}
    }

    /**
     *  @brief Funkcia pre vytvorenie noveho rowu v databaze v tabulke Podium a priradenie daneho Podiumu do instancie classy Podium
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *  @param festival_ID, nazov Parametre reprezentujuce data vkladane do tabulky
     *
     *  @return ID vlozeneho rowu, alebo ID uz existujuceho rowu, -1 ak sa nepodarilo vlozit dany row
     */
    function createNewPodium($pdo, $festival_ID, $nazov){
        $testID = $pdo->prepare("SELECT festival_ID FROM Festival WHERE festival_ID = ?");
        $testID->execute([$festival_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $testSelect = $pdo->prepare("SELECT podium_ID FROM Podium WHERE festival_ID = ? AND nazov = ?");
        $testSelect->execute([$festival_ID, $nazov]);

        if($testSelect->rowCount() == 1){
            return $testSelect->fetchColumn();
        }else{
            $insert = $pdo->prepare("INSERT INTO Podium(festival_ID, nazov) VALUES(?, ?)");
            $insert->execute([$festival_ID, $nazov]);

            $select = $pdo->prepare("SELECT podium_ID FROM Podium WHERE festival_ID = ? AND nazov = ?");
            $select->execute([$festival_ID, $nazov]);

            if($select->rowCount() == 1){
                $this->podiumID = $select->fetchColumn();
                return $this->podiumID;
            }else{
                return -1;
            }
        }
    }

    /**
     *  @brief Funkcia pre vymazanie rowu, ktoreho reprezentaciou je dana instancia classy Podium
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return 0 ak sa delete podaril, -1 ak nie
     */
    function deletePodium($pdo){
        $delete = $pdo->prepare("DELETE FROM Podium WHERE podium_ID = ?");
        $delete->execute([$this->podiumID]);

        $select = $pdo->prepare("SELECT podium_ID FROM Podium WHERE podium_ID = ?");
        $select->execute([$this->podiumID]);
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
        return $this->podiumID;
    }

    function getFestival_ID($pdo){
        $select = $pdo->prepare("SELECT festival_ID FROM Podium WHERE podium_ID = ?");
        $select->execute([$this->podiumID]);
        return $select->fetchColumn();
    }

    function getNazov($pdo){
    	$select = $pdo->prepare("SELECT nazov FROM Podium WHERE podium_ID = ?");
    	$select->execute([$this->podiumID]);
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
    function setFestival_ID($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Podium SET festival_ID = ? WHERE podium_ID = ?");
            $select->execute([$data, $this->podiumID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    function setNazov($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Podium SET nazov = ? WHERE podium_ID = ?");
    		$select->execute([$data, $this->podiumID]);
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

}

?>