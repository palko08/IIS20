<?php

class Clovek{

	private $clovekID;

    function __construct(){

    }

    function __destruct(){

    }

    function getAllClovek($pdo){
        $idSelect = $pdo->prepare("SELECT clovek_ID FROM Clovek");
        $idSelect->execute();
        $results = $idSelect->fetchAll();
        $array;
        foreach ($results as $row) {
            $object = new Clovek();
            if ($object->initExistingClovek($pdo, $row[0]) == -1) {
                echo "nenasli sme v datbazke dany row<br>";
            }
            $array[] = $object;
        }
        return $array;
    }

	/**
 	 *  @brief Funkcia pre priradenie instancie classy Clovek k danemu rowu v databaze
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *	@param id ID daneho rowu v databaze
 	 *
 	 *	@return 0 ak sa ID najde, -1 ak sa ID nenajde
 	 */
    function initExistingClovek($pdo, $id){
    	$idSelect = $pdo->prepare("SELECT clovek_ID FROM Clovek WHERE clovek_ID = ?");
    	$idSelect->execute($id);

    	if($idSelect->rowCount() == 1){
    		$this->clovekID = $idSelect->fetchColumn();
    		return 0;
    	}else{
    		return -1;
    	}
    }

    /**
     *  @brief Funkcia pre vytvorenie noveho rowu v databaze v tabulke Clovek a priradenie daneho Cloveku do instancie classy Clovek
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *  @param meno Parametre reprezentujuce data vkladane do tabulky
     *
     *  @return ID vlozeneho rowu, alebo ID uz existujuceho rowu, -1 ak sa nepodarilo vlozit dany row
     */
    function createNewClovek($pdo, $meno){
        $testSelect = $pdo->prepare("SELECT clovek_ID FROM Clovek WHERE meno = ?");
        $testSelect->execute($meno);

        if($testSelect->rowCount() == 1){
            return $testSelect->fetchColumn();
        }else{
            $insert = $pdo->prepare("INSERT INTO Clovek(meno) VALUES(?, ?)");
            $insert->execute($meno);

            $select = $pdo->prepare("SELECT clovek_ID FROM Clovek WHERE meno = ?");
            $select->execute($meno);

            if($select->rowCount() == 1){
                $this->clovekID = $select->fetchColumn();
                return $this->clovekID;
            }else{
                return -1;
            }
        }
    }

    /**
     *  @brief Funkcia pre vymazanie rowu, ktoreho reprezentaciou je dana instancia classy Clovek
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return 0 ak sa delete podaril, -1 ak nie
     */
    function deleteClovek($pdo){
        $delete = $pdo->prepare("DELETE FROM Clovek WHERE clovek_ID = ?");
        $delete->execute($this->clovekID);

        $select = $pdo->prepare("SELECT clovek_ID FROM Clovek WHERE clovek_ID = ?");
        $select->execute($this->clovekID);
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
        return $this->clovekID;
    }

    function getMeno($pdo){
    	$select = $pdo->prepare("SELECT meno FROM Clovek WHERE clovek_ID = ?");
    	$select->execute($this->clovekID);
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
    function setMeno($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Clovek SET meno = ? WHERE clovek_ID = ?");
    		$select->execute(array($data, $this->clovekID));
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

}

?>