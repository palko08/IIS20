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
    		$this->InterpretID = $idSelect->fetchColumn();
    		return 0;
    	}else{
    		return -1;
    	}
    }

    /**
     *  @brief Funkcia pre vytvorenie noveho rowu v databaze v tabulke Interpret a priradenie daneho Interpretu do instancie classy Interpret
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *  @param nazov, kapacita, datum_Od, datum_Do, adresa Parametre reprezentujuce data vkladane do tabulky
     *
     *  @return ID vlozeneho rowu, alebo ID uz existujuceho rowu, -1 ak sa nepodarilo vlozit dany row
     */
    function createNewInterpret($pdo, $nazov, $kapacita, $datum_Od, $datum_Do, $adresa){
        $testSelect = $pdo->prepare("SELECT interpret_ID FROM Interpret WHERE nazov = ? AND kapacita = ? AND datum_Od = ? AND datum_Do = ? AND adresa = ?");
        $testSelect->execute([$nazov, $kapacita, $datum_Od, $datum_Do, $adresa]);

        if($testSelect->rowCount() == 1){
            return $testSelect->fetchColumn();
        }else{
            $insert = $pdo->prepare("INSERT INTO Interpret(nazov, kapacita, datum_Od, datum_Do, adresa) VALUES(?, ?, ?, ?, ?)");
            $insert->execute([$nazov, $kapacita, $datum_Od, $datum_Do, $adresa]);

            $select = $pdo->prepare("SELECT interpret_ID FROM Interpret WHERE nazov = ? AND kapacita = ? AND datum_Od = ? AND datum_Do = ? AND adresa = ?");
            $select->execute([$nazov, $kapacita, $datum_Od, $datum_Do, $adresa]);

            if($select->rowCount() == 1){
                $this->InterpretID = $select->fetchColumn();
                return $this->InterpretID;
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
        $delete->execute([$this->InterpretID]);

        $select = $pdo->prepare("SELECT interpret_ID FROM Interpret WHERE interpret_ID = ?");
        $select->execute([$this->InterpretID]);
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
    function getNazov($pdo){
    	$select = $pdo->prepare("SELECT nazov FROM Interpret WHERE interpret_ID = ?");
    	$select->execute([$this->InterpretID]);
    	return $select->fetchColumn();
    }

    function getHodnotenie($pdo){
        $select = $pdo->prepare("SELECT hodnotenie FROM Interpret WHERE interpret_ID = ?");
        $select->execute([$this->InterpretID]);
        return $select->fetchColumn();
    }

    function getLogo($pdo){
        $select = $pdo->prepare("SELECT logo FROM Interpret WHERE interpret_ID = ?");
        $select->execute([$this->InterpretID]);
        return $select->fetchColumn();
    }

    function getZanre(){
        
    }

    function checkZaner(){

    }

    function getClenov(){
        
    }

    function checkClen(){

    }

    function getVystupenia(){
        
    }

    function checkVystupenie(){

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
    		$select->execute([$data, $this->InterpretID]);
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

    function setHodnotenie($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Interpret SET hodnotenie = ? WHERE interpret_ID = ?");
            $select->execute([$data, $this->InterpretID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    function setLogo($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Interpret SET logo = ? WHERE interpret_ID = ?");
            $select->execute([$data, $this->InterpretID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    function addZaner(){

    }

    function deleteZaner(){

    }

    function addClen(){

    }

    function deleteClen(){

    }

    function addVystupenie(){

    }

    function deleteVystupenie(){

    }

}

?>