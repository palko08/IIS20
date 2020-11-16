<?php

class Festival{

	private $festivalID;

	/**
 	 *  @brief Funkcia pre inicializaciu instancie classy Festival
 	 *
 	 *  @param pdo Nadviazane PDO spojenie s databazou
 	 *	@param id ID daneho rowu v databaze
 	 *
 	 *	@return 0 ak sa ID najde, 1 ak sa ID nenajde
 	 */
    function __construct($pdo, $id){
    	$idSelect = $pdo->prepare("SELECT festival_ID FROM Festival WHERE festival_ID = ?");
    	$idSelect->execute([$id]);

    	if($idSelect->rowCount() == 1){
    		$this->festivalID = $idSelect->fetchColumn();
    		return 0;
    	}else{
    		return 1;
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

    function getAdresa($pdo){
    	$select = $pdo->prepare("SELECT adresa FROM Festival WHERE festival_ID = ?");
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
    	}catch{
    		return 1;
    	}
    }

    function setKapacita($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Festival SET kapacita = ? WHERE festival_ID = ?");
    		$select->execute([$data, $this->festivalID]);
    		return 0;
    	}catch{
    		return 1;
    	}
    }

    function setDatum_Od($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Festival SET datum_Od = ? WHERE festival_ID = ?");
    		$select->execute([$data, $this->festivalID]);
    		return 0;
    	}catch{
    		return 1;
    	}
    }

    function setDatum_Do($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Festival SET datum_Do = ? WHERE festival_ID = ?");
    		$select->execute([$data, $this->festivalID]);
    		return 0;
    	}catch{
    		return 1;
    	}
    }

    function setAdresa($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Festival SET adresa = ? WHERE festival_ID = ?");
    		$select->execute([$data, $this->festivalID]);
    		return 0;
    	}catch{
    		return 1;
    	}
    }

    function setPopis($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Festival SET popis = ? WHERE festival_ID = ?");
    		$select->execute([$data, $this->festivalID]);
    		return 0;
    	}catch{
    		return 1;
    	}
    }

    function setObrazok($pdo, $data){
    	try{
    		$select = $pdo->prepare("UPDATE Festival SET obrazok = ? WHERE festival_ID = ?");
    		$select->execute([$data, $this->festivalID]);
    		return 0;
    	}catch{
    		return 1;
    	}
    }

}

?>