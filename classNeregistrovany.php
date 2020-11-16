<?php

class Neregistrovany{

	private $neregistrovanyID;

    function __construct(){

    }

    function __destruct(){

    }

	/**
 	 *  @brief Funkcia pre priradenie instancie classy Neregistrovany k danemu rowu v databaze
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *	@param id ID daneho rowu v databaze
 	 *
 	 *	@return 0 ak sa ID najde, -1 ak sa ID nenajde
 	 */
    function initExistingNeregistrovany($pdo, $id){
    	$idSelect = $pdo->prepare("SELECT neregistrovany_ID FROM Neregistrovany WHERE neregistrovany_ID = ?");
    	$idSelect->execute([$id]);

    	if($idSelect->rowCount() == 1){
    		$this->neregistrovanyID = $idSelect->fetchColumn();
    		return 0;
    	}else{
    		return -1;
    	}
    }

    /**
     *  @brief Funkcia pre vytvorenie noveho rowu v databaze v tabulke Neregistrovany a priradenie daneho Neregistrovanyu do instancie classy Neregistrovany
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *  @param clovek_ID, email Parametre reprezentujuce data vkladane do tabulky
     *
     *  @return ID vlozeneho rowu, alebo ID uz existujuceho rowu, -1 ak sa nepodarilo vlozit dany row
     */
    function createNewNeregistrovany($pdo, $clovek_ID, $email){
        $testID = $pdo->prepare("SELECT clovek_ID FROM Clovek WHERE clovek_ID = ?");
        $testID->execute([$clovek_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $testSelect = $pdo->prepare("SELECT neregistrovany_ID FROM Neregistrovany WHERE neregistrovany_ID = ? AND email = ?");
        $testSelect->execute([$clovek_ID, $email]);

        if($testSelect->rowCount() == 1){
            return $testSelect->fetchColumn();
        }else{
            $insert = $pdo->prepare("INSERT INTO Neregistrovany(neregistrovany_ID, email) VALUES(?, ?)");
            $insert->execute([$clovek_ID, $email]);

            $select = $pdo->prepare("SELECT neregistrovany_ID FROM Neregistrovany WHERE neregistrovany_ID = ? AND email = ?");
            $select->execute([$clovek_ID, $email]);

            if($select->rowCount() == 1){
                $this->neregistrovanyID = $select->fetchColumn();
                return $this->neregistrovanyID;
            }else{
                return -1;
            }
        }
    }

    /**
     *  @brief Funkcia pre vymazanie rowu, ktoreho reprezentaciou je dana instancia classy Neregistrovany
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return 0 ak sa delete podaril, -1 ak nie
     */
    function deleteNeregistrovany($pdo){
        $delete = $pdo->prepare("DELETE FROM Neregistrovany WHERE neregistrovany_ID = ?");
        $delete->execute([$this->neregistrovanyID]);

        $select = $pdo->prepare("SELECT neregistrovany_ID FROM Neregistrovany WHERE neregistrovany_ID = ?");
        $select->execute([$this->neregistrovanyID]);
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
        return $this->neregistrovanyID;
    }

    function getEmail($pdo){
    	$select = $pdo->prepare("SELECT email FROM Neregistrovany WHERE neregistrovany_ID = ?");
    	$select->execute([$this->neregistrovanyID]);
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
    		$select = $pdo->prepare("UPDATE Neregistrovany SET email = ? WHERE neregistrovany_ID = ?");
    		$select->execute([$data, $this->neregistrovanyID]);
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

}

?>