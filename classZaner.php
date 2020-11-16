<?php

class Zaner{

	private $zanerID;

    function __construct(){

    }

    function __destruct(){

    }

	/**
 	 *  @brief Funkcia pre priradenie instancie classy Zaner k danemu rowu v databaze
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *	@param id ID daneho rowu v databaze
 	 *
 	 *	@return 0 ak sa ID najde, -1 ak sa ID nenajde
 	 */
    function initExistingZaner($pdo, $id){
    	$idSelect = $pdo->prepare("SELECT zaner_ID FROM Zaner WHERE zaner_ID = ?");
    	$idSelect->execute([$id]);

    	if($idSelect->rowCount() == 1){
    		$this->zanerID = $idSelect->fetchColumn();
    		return 0;
    	}else{
    		return -1;
    	}
    }

    /**
     *  @brief Funkcia pre vytvorenie noveho rowu v databaze v tabulke Zaner a priradenie daneho Zaneru do instancie classy Zaner
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *  @param zaner_nazov Parametre reprezentujuce data vkladane do tabulky
     *
     *  @return ID vlozeneho rowu, alebo ID uz existujuceho rowu, -1 ak sa nepodarilo vlozit dany row
     */
    function createNewZaner($pdo, $zaner_nazov){
        $testSelect = $pdo->prepare("SELECT zaner_ID FROM Zaner WHERE zaner_nazov = ?");
        $testSelect->execute([$zaner_nazov]);

        if($testSelect->rowCount() == 1){
            return $testSelect->fetchColumn();
        }else{
            $insert = $pdo->prepare("INSERT INTO Zaner(zaner_nazov) VALUES(?)");
            $insert->execute([$zaner_nazov]);

            $select = $pdo->prepare("SELECT zaner_ID FROM Zaner WHERE zaner_nazov = ?");
            $select->execute([$zaner_nazov]);

            if($select->rowCount() == 1){
                $this->zanerID = $select->fetchColumn();
                return $this->zanerID;
            }else{
                return -1;
            }
        }
    }

    /**
     *  @brief Funkcia pre vymazanie rowu, ktoreho reprezentaciou je dana instancia classy Zaner
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return 0 ak sa delete podaril, -1 ak nie
     */
    function deleteZaner($pdo){
        $delete = $pdo->prepare("DELETE FROM Zaner WHERE zaner_ID = ?");
        $delete->execute([$this->zanerID]);

        $select = $pdo->prepare("SELECT zaner_ID FROM Zaner WHERE zaner_ID = ?");
        $select->execute([$this->zanerID]);
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
        return $this->zanerID;
    }

    function getZaner_nazov($pdo){
    	$select = $pdo->prepare("SELECT zaner_nazov FROM Zaner WHERE zaner_ID = ?");
    	$select->execute([$this->zanerID]);
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
    function setZaner_nazov($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Zaner SET zaner_nazov = ? WHERE zaner_ID = ?");
    		$select->execute([$data, $this->zanerID]);
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

}

?>