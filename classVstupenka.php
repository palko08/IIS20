<?php

class Vstupenka{

	private $vstupenkaID;

    function __construct(){

    }

    function __destruct(){

    }

    function getAllVstupenka($pdo){
        $idSelect = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka");
        $idSelect->execute();
        $results = $idSelect->fetchAll();
        $array;
        foreach ($results as $row) {
            $object = new Vstupenka();
            if ($object->initExistingVstupenka($pdo, $row[0]) == -1) {
                echo "nenasli sme v datbazke dany row<br>";
            }
            $array[] = $object;
        }
        return $array;
    }

	/**
 	 *  @brief Funkcia pre priradenie instancie classy Vstupenka k danemu rowu v databaze
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *	@param id ID daneho rowu v databaze
 	 *
 	 *	@return 0 ak sa ID najde, -1 ak sa ID nenajde
 	 */
    function initExistingVstupenka($pdo, $id){
    	$idSelect = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka WHERE vstupenka_ID = ?");
    	$idSelect->execute([$id]);

    	if($idSelect->rowCount() == 1){
    		$this->vstupenkaID = $idSelect->fetchColumn();
    		return 0;
    	}else{
    		return -1;
    	}
    }

    /**
     *  @brief Funkcia pre vytvorenie noveho rowu v databaze v tabulke Vstupenka a priradenie daneho Vstupenkau do instancie classy Vstupenka
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *  @param festival_ID Parametre reprezentujuce data vkladane do tabulky
     *  @param registrovany_ID, neregistrovany_ID jeden z tychto bude neplatny, do neplatneho vlozte hodnotu -1
     *
     *  @return ID vlozeneho rowu, alebo ID uz existujuceho rowu, -1 ak sa nepodarilo vlozit dany row
     */
    function createNewVstupenka($pdo, $festival_ID, $registrovany_ID, $neregistrovany_ID){
        $testID = $pdo->prepare("SELECT festival_ID FROM Festival WHERE festival_ID = ?");
        $testID->execute([$festival_ID]);
        if($testID->rowCount() == 0){
            throw new Exception("Nedokazalo pridat vstupenku");
            return -1;
        }

        if($registrovany_ID != -1 && $neregistrovany_ID == -1){

            $testID2 = $pdo->prepare("SELECT registrovany_ID FROM Registrovany WHERE registrovany_ID = ?");
            $testID2->execute([$registrovany_ID]);
            if($testID2->rowCount() == 0){
                throw new Exception("Nedokazalo pridat vstupenku");
                return -1;
            }

            $insert = $pdo->prepare("INSERT INTO Vstupenka(festival_ID, registrovany_ID, stav) VALUES(?, ?, ?)");
            $insert->execute([$festival_ID, $registrovany_ID, "rezervovana"]);
    
            $select = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka WHERE festival_ID = ? AND registrovany_ID = ?");
            $select->execute([$festival_ID, $registrovany_ID]);
    
            if($select->rowCount() >= 1){
                $results = $select->fetchAll();

                $length = $select->rowCount();

                $this->vstupenkaID = $results[$length-1][0];
                return $this->vstupenkaID;
            }else{
                throw new Exception("Nedokazalo pridat vstupenku");
                return -1;
            }

        }else if($registrovany_ID == -1 && $neregistrovany_ID != -1){

            $testID3 = $pdo->prepare("SELECT neregistrovany_ID FROM Neregistrovany WHERE neregistrovany_ID = ?");
            $testID3->execute([$neregistrovany_ID]);
            if($testID3->rowCount() == 0){
                return -1;
            }

            $insert = $pdo->prepare("INSERT INTO Vstupenka(festival_ID, neregistrovany_ID, stav) VALUES(?, ?, ?)");
            $insert->execute([$festival_ID, $neregistrovany_ID, "rezervovana"]);
    
            $select = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka WHERE festival_ID = ? AND neregistrovany_ID = ?");
            $select->execute([$festival_ID, $neregistrovany_ID]);
    
            if($select->rowCount() >= 1){
                $results = $select->fetchAll();

                $length = $select->rowCount();

                $this->vstupenkaID = $results[$length-1][0];
                return $this->vstupenkaID;
            }else{
                throw new Exception("Nedokazalo pridat vstupenku");
                return -1;
            }

        }else{
            throw new Exception("Nedokazalo pridat vstupenku");
            return -1;
        }    
    }

    /**
     *  @brief Funkcia pre vymazanie rowu, ktoreho reprezentaciou je dana instancia classy Vstupenka
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return 0 ak sa delete podaril, -1 ak nie
     */
    function deleteVstupenka($pdo){
        $delete = $pdo->prepare("DELETE FROM Vstupenka WHERE vstupenka_ID = ?");
        $delete->execute([$this->vstupenkaID]);

        $select = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka WHERE vstupenka_ID = ?");
        $select->execute([$this->vstupenkaID]);
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
        return $this->vstupenkaID;
    }

    function getFestival_ID($pdo){
        $select = $pdo->prepare("SELECT festival_ID FROM Vstupenka WHERE vstupenka_ID = ?");
        $select->execute([$this->vstupenkaID]);
        return $select->fetchColumn();
    }

    function getRegistrovany_ID($pdo){
        $select = $pdo->prepare("SELECT registrovany_ID FROM Vstupenka WHERE vstupenka_ID = ?");
        $select->execute([$this->vstupenkaID]);
        return $select->fetchColumn();
    }

    function getNeregistrovany_ID($pdo){
        $select = $pdo->prepare("SELECT neregistrovany_ID FROM Vstupenka WHERE vstupenka_ID = ?");
        $select->execute([$this->vstupenkaID]);
        return $select->fetchColumn();
    }

    function getStav($pdo){
        $select = $pdo->prepare("SELECT stav FROM Vstupenka WHERE vstupenka_ID = ?");
        $select->execute([$this->vstupenkaID]);
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
            $select = $pdo->prepare("UPDATE Vstupenka SET festival_ID = ? WHERE vstupenka_ID = ?");
            $select->execute([$data, $this->vstupenkaID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    function setRegistrovany_ID($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Vstupenka SET registrovany_ID = ? WHERE vstupenka_ID = ?");
            $select->execute([$data, $this->vstupenkaID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    function setNeregistrovany_ID($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Vstupenka SET neregistrovany_ID = ? WHERE vstupenka_ID = ?");
            $select->execute([$data, $this->vstupenkaID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    function setStav($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Vstupenka SET stav = ? WHERE vstupenka_ID = ?");
            $select->execute([$data, $this->vstupenkaID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

}

?>