<?php

class Interpret{

	private $interpretID;

    function __construct(){

    }

    function __destruct(){

    }

	/**
 	 *  @brief Funkcia pre priradenie instancie classy Interpret k danemu rowu v databaze
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *	@param id ID daneho rowu v databaze
 	 *
 	 *	@return 0 ak sa ID najde, -1 ak sa ID nenajde
 	 */
    function initExistingInterpret($pdo, $id){
    	$idSelect = $pdo->prepare("SELECT interpret_ID FROM Interpret WHERE interpret_ID = ?");
    	$idSelect->execute([$id]);

    	if($idSelect->rowCount() == 1){
    		$this->interpretID = $idSelect->fetchColumn();
    		return 0;
    	}else{
    		return -1;
    	}
    }

    /**
     *  @brief Funkcia pre vytvorenie noveho rowu v databaze v tabulke Interpret a priradenie daneho Interpretu do instancie classy Interpret
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *  @param nazov Parametre reprezentujuce data vkladane do tabulky
     *
     *  @return ID vlozeneho rowu, alebo ID uz existujuceho rowu, -1 ak sa nepodarilo vlozit dany row
     */
    function createNewInterpret($pdo, $nazov){
        $testSelect = $pdo->prepare("SELECT interpret_ID FROM Interpret WHERE nazov = ?");
        $testSelect->execute([$nazov]);

        if($testSelect->rowCount() == 1){
            return $testSelect->fetchColumn();
        }else{
            $insert = $pdo->prepare("INSERT INTO Interpret(nazov) VALUES(?)");
            $insert->execute([$nazov, $kapacita, $datum_Od, $datum_Do, $adresa]);

            $select = $pdo->prepare("SELECT interpret_ID FROM Interpret WHERE nazov = ?");
            $select->execute([$nazov]);

            if($select->rowCount() == 1){
                $this->interpretID = $select->fetchColumn();
                return $this->interpretID;
            }else{
                return -1;
            }
        }
    }

    /**
     *  @brief Funkcia pre vymazanie rowu, ktoreho reprezentaciou je dana instancia classy Interpret
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return 0 ak sa delete podaril, -1 ak nie
     */
    function deleteInterpret($pdo){
        $delete = $pdo->prepare("DELETE FROM Interpret WHERE interpret_ID = ?");
        $delete->execute([$this->interpretID]);

        $select = $pdo->prepare("SELECT interpret_ID FROM Interpret WHERE interpret_ID = ?");
        $select->execute([$this->interpretID]);
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
        return $this->interpretID;
    }

    function getNazov($pdo){
    	$select = $pdo->prepare("SELECT nazov FROM Interpret WHERE interpret_ID = ?");
    	$select->execute([$this->interpretID]);
    	return $select->fetchColumn();
    }

    function getHodnotenie($pdo){
        $select = $pdo->prepare("SELECT hodnotenie FROM Interpret WHERE interpret_ID = ?");
        $select->execute([$this->interpretID]);
        return $select->fetchColumn();
    }

    function getLogo($pdo){
        $select = $pdo->prepare("SELECT logo FROM Interpret WHERE interpret_ID = ?");
        $select->execute([$this->interpretID]);
        return $select->fetchColumn();
    }

    function getCas_vystupenia($pdo, $podium_ID){
        $select = $pdo->prepare("SELECT cas_vystupenia FROM Interpret_vystupuje_na_Podium WHERE podium_ID = ? AND interpret_ID = ?");
        $select->execute([$podium_ID, $this->interpretID]);
        return $select->fetchColumn();
    }

    /**
     *  @brief Funkcie pre vytahovanie dat z databazy
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return Array dat, pri nenajdeni by hodnota mala byt NULL
     */
    function getZanre(){
        $select = $pdo->prepare("SELECT zaner_ID FROM Interpret_patri_do_Zaner WHERE interpret_ID = ?");
        $select->execute([$this->interpretID]);
        return $select->fetchAll();
    }

    function getClenov($pdo){
        $select = $pdo->prepare("SELECT clen_ID FROM Clen_je_v_Interpret WHERE interpret_ID = ?");
        $select->execute([$this->interpretID]);
        return $select->fetchAll();
    }

    function getVystupenia($pdo){
        $select = $pdo->prepare("SELECT podium_ID AND cas_vystupenia FROM Interpret_vystupuje_na_Podium WHERE interpret_ID = ?");
        $select->execute([$this->interpretID]);
        return $select->fetchAll();
    }

    /**
     *  @brief Funkcie pre zistenie, ci su dane IDs prepojene
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return 1 ak ano, 0 ak nie
     */
    function checkZaner($pdo, $zaner_ID){
        $select = $pdo->prepare("SELECT zaner_ID FROM Interpret_patri_do_Zaner WHERE zaner_ID = ? AND interpret_ID = ?");
        $select->execute([$zaner_ID, $this->interpretID]);
        if($select->rowCount() == 0){
            return 1;
        }else{
            return 0;
        }
    }

    function checkClen($pdo, $clen_ID){
        $select = $pdo->prepare("SELECT clen_ID FROM Clen_je_v_Interpret WHERE clen_ID = ? AND interpret_ID = ?");
        $select->execute([$clen_ID, $this->interpretID]);
        if($select->rowCount() == 0){
            return 1;
        }else{
            return 0;
        }
    }

    function checkVystupenie($pdo, $podium_ID){
        $select = $pdo->prepare("SELECT podium_ID FROM Interpret_vystupuje_na_Podium WHERE interpret_ID = ? AND podium_ID = ?");
        $select->execute([$this->interpretID, $podium_ID]);
        if($select->rowCount() == 0){
            return 1;
        }else{
            return 0;
        }
    }

    /**
 	 *  @brief Funkcie pre updatovanie dat v databaze
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *  @param data Data vkladane do databazy ako update
 	 *
 	 *	@return 0 ak sa update podari, 1 ak sa nepodari
 	 */
    function setNazov($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Interpret SET nazov = ? WHERE interpret_ID = ?");
    		$select->execute([$data, $this->interpretID]);
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

    function setHodnotenie($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Interpret SET hodnotenie = ? WHERE interpret_ID = ?");
            $select->execute([$data, $this->interpretID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    function setLogo($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Interpret SET logo = ? WHERE interpret_ID = ?");
            $select->execute([$data, $this->interpretID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    /**
     *  @brief Funkcie pre updatovanie dat v databaze
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *  @param podium_ID, cas_vystupenia Data vkladane do databazy ako update
     *
     *  @return 0 ak sa update podari, -1 ak sa nepodari
     */
    function addZaner($pdo, $zaner_ID)){
        $testID = $pdo->prepare("SELECT zaner_ID FROM Zaner WHERE zaner_ID = ?");
        $testID->execute([$zaner_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $insert = $pdo->prepare("INSERT INTO Interpret_patri_do_Zaner(interpret_ID, zaner_ID) VALUES(?, ?)");
        $insert->execute([$this->interpretID, $zaner_ID]);
        return 0;
    }

    function deleteZaner($pdo, $zaner_ID)){
        $testID = $pdo->prepare("SELECT zaner_ID FROM Zaner WHERE zaner_ID = ?");
        $testID->execute([$zaner_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $delete = $pdo->prepare("DELETE FROM Interpret_patri_do_Zaner WHERE zaner_ID = ? AND interpret_ID = ?");
        $delete->execute([$zaner_ID, $this->interpretID]);
        
        $select = $pdo->prepare("SELECT interpret_ID FROM Interpret_patri_do_Zaner WHERE zaner_ID = ? AND interpret_ID = ?");
        $select->execute([$zaner_ID, $this->interpretID]);
        if($select->rowCount() == 0){
            return 0;
        }else{
            return -1;
        }
    }

    function addClen($pdo, $clen_ID){
        $testID = $pdo->prepare("SELECT clen_ID FROM Clen WHERE clen_ID = ?");
        $testID->execute([$clen_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $insert = $pdo->prepare("INSERT INTO Clen_je_v_Interpret(interpret_ID, clen_ID) VALUES(?, ?)");
        $insert->execute([$this->interpretID, $clen_ID]);
        return 0;
    }

    function deleteClen($pdo, $clen_ID){
        $testID = $pdo->prepare("SELECT clen_ID FROM Clen WHERE clen_ID = ?");
        $testID->execute([$clen_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $delete = $pdo->prepare("DELETE FROM Clen_je_v_Interpret WHERE clen_ID = ? AND interpret_ID = ?");
        $delete->execute([$clen_ID, $this->interpretID]);
        
        $select = $pdo->prepare("SELECT interpret_ID FROM Clen_je_v_Interpret WHERE clen_ID = ? AND interpret_ID = ?");
        $select->execute([$clen_ID, $this->interpretID]);
        if($select->rowCount() == 0){
            return 0;
        }else{
            return -1;
        }
    }

    function addVystupenie($pdo, $podium_ID, $cas_vystupenia){
        $testID = $pdo->prepare("SELECT podium_ID FROM Podium WHERE podium_ID = ?");
        $testID->execute([$podium_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $insert = $pdo->prepare("INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia) VALUES(?, ?, ?)");
        $insert->execute([$this->interpretID, $podium_ID, $cas_vystupenia]);
        return 0;
    }

    function deleteVystupenie($pdo, $interpret_ID){
        $testID = $pdo->prepare("SELECT podium_ID FROM Podium WHERE podium_ID = ?");
        $testID->execute([$podium_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $delete = $pdo->prepare("DELETE FROM Interpret_vystupuje_na_Podium WHERE podium_ID = ? AND interpret_ID = ?");
        $delete->execute([$podium_ID, $this->interpretID]);
        
        $select = $pdo->prepare("SELECT interpret_ID FROM Interpret_vystupuje_na_Podium WHERE podium_ID = ? AND interpret_ID = ?");
        $select->execute([$podium_ID, $this->interpretID]);
        if($select->rowCount() == 0){
            return 0;
        }else{
            return -1;
        }
    }

}

?>