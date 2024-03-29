<?php

class Festival{

	private $festivalID;

    function __construct(){

    }

    function __destruct(){

    }

    function getAllFestival($pdo){
        $idSelect = $pdo->prepare("SELECT festival_ID FROM Festival");
        $idSelect->execute();
        $results = $idSelect->fetchAll();
        $array;
        foreach ($results as $row) {
            $object = new Festival();
            if ($object->initExistingFestival($pdo, $row[0]) == -1) {
                echo "nenasli sme v datbazke dany row<br>";
            }
            $array[] = $object;
        }
        return $array;
    }

	/**
 	 *  @brief Funkcia pre priradenie instancie classy Festival k danemu rowu v databaze
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *	@param id ID daneho rowu v databaze
 	 *
 	 *	@return 0 ak sa ID najde, -1 ak sa ID nenajde
 	 */
    function initExistingFestival($pdo, $id){
    	$idSelect = $pdo->prepare("SELECT festival_ID FROM Festival WHERE festival_ID = ?");
    	$idSelect->execute([$id]);

    	if($idSelect->rowCount() == 1){
    		$this->festivalID = $idSelect->fetchColumn();
    		return 0;
    	}else{
    		return -1;
    	}
    }

    /**
     *  @brief Funkcia pre vytvorenie noveho rowu v databaze v tabulke Festival a priradenie daneho festivalu do instancie classy festival
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *  @param nazov, kapacita, datum_Od, datum_Do, cena, adresa Parametre reprezentujuce data vkladane do tabulky
     *
     *  @return ID vlozeneho rowu, alebo ID uz existujuceho rowu, -1 ak sa nepodarilo vlozit dany row
     */
    function createNewFestival($pdo, $nazov, $kapacita, $datum_Od, $datum_Do, $cena, $adresa){
        $testSelect = $pdo->prepare("SELECT festival_ID FROM Festival WHERE nazov = ? AND kapacita = ? AND datum_Od = ? AND datum_Do = ? AND cena = ? AND adresa = ?");
        $testSelect->execute([$nazov, $kapacita, $datum_Od, $datum_Do, $cena, $adresa]);

        if($testSelect->rowCount() == 1){
            return $testSelect->fetchColumn();
        }else{
            $insert = $pdo->prepare("INSERT INTO Festival(nazov, kapacita, datum_Od, datum_Do, cena, adresa) VALUES(?, ?, ?, ?, ?, ?)");
            $insert->execute([$nazov, $kapacita, $datum_Od, $datum_Do, $cena, $adresa]);

            $select = $pdo->prepare("SELECT festival_ID FROM Festival WHERE nazov = ? AND kapacita = ? AND datum_Od = ? AND datum_Do = ? AND cena = ? AND adresa = ?");
            $select->execute([$nazov, $kapacita, $datum_Od, $datum_Do, $cena, $adresa]);

            if($select->rowCount() == 1){
                $this->festivalID = $select->fetchColumn();
                return $this->festivalID;
            }else{
                return -1;
            }
        }
    }

    /**
     *  @brief Funkcia pre vymazanie rowu, ktoreho reprezentaciou je dana instancia classy Festival
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return 0 ak sa delete podaril, -1 ak nie
     */
    function deleteFestival($pdo){
        $delete = $pdo->prepare("DELETE FROM Festival WHERE festival_ID = ?");
        $delete->execute([$this->festivalID]);

        $select = $pdo->prepare("SELECT festival_ID FROM Festival WHERE festival_ID = ?");
        $select->execute([$this->festivalID]);
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
        return $this->festivalID;
    }

    function getNazov($pdo){
    	$select = $pdo->prepare("SELECT nazov FROM Festival WHERE festival_ID = ?");
    	$select->execute([$this->festivalID]);
    	return $select->fetchColumn();
    }

    function getKapacita($pdo){
    	$select = $pdo->prepare("SELECT kapacita FROM Festival WHERE festival_ID = ?");
    	$select->execute([$this->festivalID]);
    	return $select->fetchColumn();
    }

    function getDatum_Od($pdo){
    	$select = $pdo->prepare("SELECT datum_Od FROM Festival WHERE festival_ID = ?");
    	$select->execute([$this->festivalID]);
    	return $select->fetchColumn();
    }

    function getDatum_Do($pdo){
    	$select = $pdo->prepare("SELECT datum_Do FROM Festival WHERE festival_ID = ?");
    	$select->execute([$this->festivalID]);
    	return $select->fetchColumn();
    }

    function getCena($pdo){
        $select = $pdo->prepare("SELECT cena FROM Festival WHERE festival_ID = ?");
        $select->execute([$this->festivalID]);
        return $select->fetchColumn();
    }

    function getAdresa($pdo){
    	$select = $pdo->prepare("SELECT adresa FROM Festival WHERE festival_ID = ?");
    	$select->execute([$this->festivalID]);
    	return $select->fetchColumn();
    }

    function getHodnotenie($pdo){
        $select = $pdo->prepare("SELECT hodnotenie FROM Festival WHERE festival_ID = ?");
        $select->execute([$this->festivalID]);
        return $select->fetchColumn();
    }

    function getPopis($pdo){
    	$select = $pdo->prepare("SELECT popis FROM Festival WHERE festival_ID = ?");
    	$select->execute([$this->festivalID]);
    	return $select->fetchColumn();
    }

    function getObrazok($pdo){
    	$select = $pdo->prepare("SELECT obrazok FROM Festival WHERE festival_ID = ?");
    	$select->execute([$this->festivalID]);
    	return $select->fetchColumn();
    }

    function getPodia($pdo){
        $select = $pdo->prepare("SELECT podium_ID FROM Podium WHERE festival_ID = ?");
        $select->execute([$this->festivalID]);
        return $select->fetchAll();
    }

    function getVystupenia($pdo, $podium){
        $select = $pdo->prepare("SELECT interpret_ID FROM Interpret_vystupuje_na_Podium WHERE podium_ID = ?");
        $select->execute([$podium]);
        return $select->fetchAll();
    }

    /**
     *  @brief Funkcie pre vytahovanie dat z databazy
     *
     *  @param pdo Nadviazane PDO spojenie s databazou
     *
     *  @return Array dat, pri nenajdeni by hodnota mala byt NULL
     */
    function getZanre($pdo){
        $select = $pdo->prepare("SELECT zaner_ID FROM Festival_patri_do_Zaner WHERE festival_ID = ?");
        $select->execute([$this->festivalID]);
        return $select->fetchAll();
    }

    function getVstupenky($pdo){
        $select = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka WHERE festival_ID = ?");
        $select->execute([$this->festivalID]);
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
        $select = $pdo->prepare("SELECT zaner_ID FROM Festival_patri_do_Zaner WHERE festival_ID = ? AND zaner_ID = ?");
        $select->execute([$this->festivalID, $zaner_ID]);
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
    		$select = $pdo->prepare("UPDATE Festival SET nazov = ? WHERE festival_ID = ?");
    		$select->execute([$data, $this->festivalID]);
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

    function setKapacita($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Festival SET kapacita = ? WHERE festival_ID = ?");
    		$select->execute([$data, $this->festivalID]);
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

    function setDatum_Od($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Festival SET datum_Od = ? WHERE festival_ID = ?");
    		$select->execute([$data, $this->festivalID]);
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

    function setDatum_Do($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Festival SET datum_Do = ? WHERE festival_ID = ?");
    		$select->execute([$data, $this->festivalID]);
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

    function setCena($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Festival SET cena = ? WHERE festival_ID = ?");
            $select->execute([$data, $this->festivalID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    function setAdresa($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Festival SET adresa = ? WHERE festival_ID = ?");
    		$select->execute([$data, $this->festivalID]);
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

    function setHodnotenie($pdo, $data){
        try{
            $select = $pdo->prepare("UPDATE Festival SET hodnotenie = ? WHERE festival_ID = ?");
            $select->execute([$data, $this->festivalID]);
            return 0;
        }catch(PDOException $e){
            echo $e->getMessage() . "<br>";
            return 1;
        }
    }

    function setPopis($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Festival SET popis = ? WHERE festival_ID = ?");
    		$select->execute([$data, $this->festivalID]);
    		return 0;
    	}catch(PDOException $e){
    		echo $e->getMessage() . "<br>";
    		return 1;
    	}
    }

    function setObrazok($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Festival SET obrazok = ? WHERE festival_ID = ?");
    		$select->execute([$data, $this->festivalID]);
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
     *  @param zaner_ID Data vkladane do databazy ako update
     *
     *  @return 0 ak sa update podari, -1 ak sa nepodari
     */
    function addZaner($pdo, $zaner_ID){
        $testID = $pdo->prepare("SELECT zaner_ID FROM Zaner WHERE zaner_ID = ?");
        $testID->execute([$zaner_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $insert = $pdo->prepare("INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID) VALUES(?, ?)");
        $insert->execute([$zaner_ID, $this->festivalID]);
        return 0;
    }


    function deleteZaner($pdo, $zaner_ID){
        $testID = $pdo->prepare("SELECT zaner_ID FROM Zaner WHERE zaner_ID = ?");
        $testID->execute([$zaner_ID]);
        if($testID->rowCount() == 0){
            return -1;
        }

        $delete = $pdo->prepare("DELETE FROM Festival_patri_do_Zaner WHERE festival_ID = ? AND zaner_ID = ?");
        $delete->execute([$this->festivalID, $zaner_ID]);
        
        $select = $pdo->prepare("SELECT festival_ID FROM Festival_patri_do_Zaner WHERE festival_ID = ? AND zaner_ID = ?");
        $select->execute([$this->festivalID, $zaner_ID]);
        if($select->rowCount() == 0){
            return 0;
        }else{
            return -1;
        }
    }

}

?>