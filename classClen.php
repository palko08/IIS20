<?php

class Clen{

	private $clenID;

    function __construct(){

    }

    function __destruct(){

    }

	/**
 	 *  @brief Funkcia pre priradenie instancie classy Clen k danemu rowu v databaze
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *	@param id ID daneho rowu v databaze
 	 *
 	 *	@return 0 ak sa ID najde, -1 ak sa ID nenajde
 	 */
    function initExistingClen($pdo, $id){
    	$idSelect = $pdo->prepare("SELECT clen_ID FROM Clen WHERE clen_ID = ?");
    	$idSelect->execute([$id]);

    	if($idSelect->rowCount() == 1){
    		$this->clenID = $idSelect->fetchColumn();
    		return 0;
    	}else{
    		return -1;
    	}
    }

    /**
     *  @brief Funkcia pre vytvorenie noveho rowu v databaze v tabulke Clen a priradenie daneho Clenu do instancie classy Clen
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *  @param clovek_ID Parametre reprezentujuce data vkladane do tabulky
     *
     *  @return ID vlozeneho rowu, alebo ID uz existujuceho rowu, -1 ak sa nepodarilo vlozit dany row
     */
    function createNewClen($pdo, $clovek_ID){
        $testID = $pdo->prepare("SELECT clovek_ID FROM Clovek WHERE clovek_ID = ?");
        $testID->execute([$clovek_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $testSelect = $pdo->prepare("SELECT clen_ID FROM Clen WHERE clen_ID = ?");
        $testSelect->execute([$clovek_ID]);

        if($testSelect->rowCount() == 1){
            return $testSelect->fetchColumn();
        }else{
            $insert = $pdo->prepare("INSERT INTO Clen(clen_ID) VALUES(?)");
            $insert->execute([$clovek_ID]);

            $select = $pdo->prepare("SELECT clen_ID FROM Clen WHERE clen_ID = ?");
            $select->execute([$clovek_ID]);

            if($select->rowCount() == 1){
                $this->clenID = $select->fetchColumn();
                return $this->clenID;
            }else{
                return -1;
            }
        }
    }

    /**
     *  @brief Funkcia pre vymazanie rowu, ktoreho reprezentaciou je dana instancia classy Clen
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return 0 ak sa delete podaril, -1 ak nie
     */
    function deleteClen($pdo){
        $delete = $pdo->prepare("DELETE FROM Clen WHERE clen_ID = ?");
        $delete->execute([$this->clenID]);

        $select = $pdo->prepare("SELECT clen_ID FROM Clen WHERE clen_ID = ?");
        $select->execute([$this->clenID]);
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
        return $this->clenID;
    }

    function getFoto($pdo){
    	$select = $pdo->prepare("SELECT foto FROM Clen WHERE clen_ID = ?");
    	$select->execute([$this->clenID]);
    	return $select->fetchColumn();
    }

    /**
     *  @brief Funkcie pre vytahovanie dat z databazy
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return Array dat, pri nenajdeni by hodnota mala byt NULL
     */
    function getInterpretov($pdo){
        $select = $pdo->prepare("SELECT interpret_ID FROM Clen_je_v_Interpret WHERE clen_ID = ?");
        $select->execute([$this->clenID]);
        return $select->fetchAll();
    }

    /**
     *  @brief Funkcie pre zistenie, ci su dane IDs prepojene
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return 1 ak ano, 0 ak nie
     */
    function checkInterpret($pdo, $interpret_ID){
        $select = $pdo->prepare("SELECT interpret_ID FROM Clen_je_v_Interpret WHERE clen_ID = ? AND interpret_ID = ?");
        $select->execute([$this->clenID, $interpret_ID]);
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
    function setFoto($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Clen SET foto = ? WHERE clen_ID = ?");
    		$select->execute([$data, $this->clenID]);
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
     *  @param interpret_ID Data vkladane do databazy ako update
     *
     *  @return 0 ak sa update podari, -1 ak sa nepodari
     */
    function addInterpret($pdo, $interpret_ID){
        $testID = $pdo->prepare("SELECT interpret_ID FROM Interpret WHERE interpret_ID = ?");
        $testID->execute([$interpret_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $insert = $pdo->prepare("INSERT INTO Clen_je_v_Interpret(interpret_ID, clen_ID) VALUES(?, ?)");
        $insert->execute([$interpret_ID, $this->clenID]);
        return 0;
    }


    function deleteInterpret($pdo, $interpret_ID){
        $testID = $pdo->prepare("SELECT interpret_ID FROM Interpret WHERE interpret_ID = ?");
        $testID->execute([$interpret_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $delete = $pdo->prepare("DELETE FROM Clen_je_v_Interpret WHERE clen_ID = ? AND interpret_ID = ?");
        $delete->execute([$this->clenID, $interpret_ID]);
        
        $select = $pdo->prepare("SELECT clen_ID FROM Clen_je_v_Interpret WHERE clen_ID = ? AND interpret_ID = ?");
        $select->execute([$this->clenID, $interpret_ID]);
        if($select->rowCount() == 0){
            return 0;
        }else{
            return -1;
        }
    }

}

?>