<?php

class Vystupenie{

	private $vystupenieID;

    function __construct(){

    }

    function __destruct(){

    }

    function getAllVystupenia($pdo){
        $idSelect = $pdo->prepare("SELECT vystupenie_ID FROM Interpret_vystupuje_na_Podium");
        $idSelect->execute();
        $results = $idSelect->fetchAll();
        $array;
        foreach ($results as $row) {
            $object = new Vystupenie();
            if ($object->initExistingVystupenie($pdo, $row[0]) == -1) {
                echo "nenasli sme v datbazke dany row<br>";
            }
            $array[] = $object;
        }
        return $array;
    }

	/**
 	 *  @brief Funkcia pre priradenie instancie classy Vystupenie k danemu rowu v databaze
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *	@param id ID daneho rowu v databaze
 	 *
 	 *	@return 0 ak sa ID najde, -1 ak sa ID nenajde
 	 */
    function initExistingVystupenie($pdo, $id){
    	$idSelect = $pdo->prepare("SELECT vystupenie_ID FROM Interpret_vystupuje_na_Podium WHERE vystupenie_ID = ?");
    	$idSelect->execute([$id]);

    	if($idSelect->rowCount() == 1){
    		$this->vystupenieID = $idSelect->fetchColumn();
    		return 0;
    	}else{
    		return -1;
    	}
    }

    /**
     *  @brief Funkcia pre vytvorenie noveho rowu v databaze v tabulke Vystupenie a priradenie daneho Vystupenieu do instancie classy Vystupenie
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *  @param $intepretID, $festivalID, $cas_vystupenia Parametre reprezentujuce data vkladane do tabulky
     *
     *  @return ID vlozeneho rowu, alebo ID uz existujuceho rowu, -1 ak sa nepodarilo vlozit dany row
     */
    function createNewVystupenie($pdo, $intepretID, $festivalID, $cas_vystupenia){
        $testSelect = $pdo->prepare("SELECT vystupenie_ID FROM Interpret_vystupuje_na_Podium WHERE nazov = ?");
        $testSelect->execute([$nazov]);

        if($testSelect->rowCount() == 1){
            return $testSelect->fetchColumn();
        }else{
            $insert = $pdo->prepare("INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, festival_ID, cas_vystupenia) VALUES(?, ?, ?)");
            $insert->execute([$intepretID, $festivalID, $cas_vystupenia]);

            $select = $pdo->prepare("SELECT vystupenie_ID FROM Interpret_vystupuje_na_Podium WHERE nazov = ?");
            $select->execute([$intepretID, $festivalID, $cas_vystupenia]);

            if($select->rowCount() == 1){
                $this->vystupenieID = $select->fetchColumn();
                return $this->vystupenieID;
            }else{
                return -1;
            }
        }
    }

    /**
     *  @brief Funkcia pre vymazanie rowu, ktoreho reprezentaciou je dana instancia classy Vystupenie
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return 0 ak sa delete podaril, -1 ak nie
     */
    function deleteVystupenie($pdo){
        $delete = $pdo->prepare("DELETE FROM Interpret_vystupuje_na_Podium WHERE vystupenie_ID = ?");
        $delete->execute([$this->vystupenieID]);

        $select = $pdo->prepare("SELECT vystupenie_ID FROM Interpret_vystupuje_na_Podium WHERE vystupenie_ID = ?");
        $select->execute([$this->vystupenieID]);
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
        return $this->vystupenieID;
    }

    function getInterpret_ID($pdo){
        $select = $pdo->prepare("SELECT interpret_ID FROM Interpret_vystupuje_na_Podium WHERE vystupenie_ID = ?");
        $select->execute([$this->vystupenieID]);
        return $select->fetchColumn();
    }

    function getFestival_ID($pdo){
        $select = $pdo->prepare("SELECT festival_ID FROM Interpret_vystupuje_na_Podium WHERE vystupenie_ID = ?");
        $select->execute([$this->vystupenieID]);
        return $select->fetchColumn();
    }

    function getCas_vystupenia($pdo){
        $select = $pdo->prepare("SELECT cas_vystupenia FROM Interpret_vystupuje_na_Podium WHERE vystupenie_ID = ?");
        $select->execute([$this->vystupenieID]);
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
    function setInterpret_ID($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Interpret_vystupuje_na_Podium SET interpret_ID = ? WHERE vystupenie_ID = ?");
    		$select->execute([$data, $this->vystupenieID]);
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

    function setFestival_ID($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Interpret_vystupuje_na_Podium SET festival_ID = ? WHERE vystupenie_ID = ?");
            $select->execute([$data, $this->vystupenieID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    function setCas_vystupenia($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Interpret_vystupuje_na_Podium SET cas_vystupenia = ? WHERE vystupenie_ID = ?");
            $select->execute([$data, $this->vystupenieID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

}

?>