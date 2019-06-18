<?php

class randomize 
{
	private $id_number;
	private $id_message;
	private $number;
	private $active;
	private $drawn;
	
	private $hDB;
	
	
	public function __construct(){
		require __DIR__. "/../connect.php";
		//Tworzy uchwyt połączenia
		$this->hDB = new mysqli($host,$db_user,$db_password);
		mysqli_set_charset($this->hDB, "utf8");
		//sprawdzamy polaczenie
		if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
		}
		
		if (!$this->hDB->select_db($db_name))
		echo "Nie udało się wybrać bazy danych";
		
		$this->hDB->select_db($db_name);
		
		}
	
	function setDrawnNumber($number){
		$sql= "SELECT id FROM `randomize` WHERE number = '".$number."';";
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
		$data = $rs->fetch_array();
			
		$sql="UPDATE `randomize` SET `drawn` = 1 WHERE number='".$number."';";
		$sql.="UPDATE `message` SET `content` ='".$number."' WHERE id_message=7;";
		$sql.="INSERT INTO `history` (id_history, id_number) VALUES (NULL,'".$data['id_number']."');";
		$rs = $this->hDB->multi_query($sql) or die ($this->hDB->error());
		}
	
	function setMax($number)
    {
		$sql="UPDATE `randomize` SET `active` = 0 WHERE number>'".$number."';";
		$sql.="UPDATE `randomize` SET `active` = 1 WHERE number<='".$number."';";
		$rs = $this->hDB->multi_query($sql) or die ($this->hDB->error());
    }
	
	function resetLos()
    {
		$sql="UPDATE `randomize` SET `drawn` = 0;";
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
    }

	function getNumberScope()
	{
		$sql="SELECT count(number) as numbers FROM randomize WHERE active=1;";
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
		$data = $rs->fetch_array();
		return $data['numbers'];
	}
	
	function getUndrawn()
	{
		$sql="SELECT * FROM `randomize` WHERE active=1 AND drawn=0";
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
		$ile_wierszy = $rs->num_rows;
		if($ile_wierszy==0)
		{
			$rs = $this->hDB->query("UPDATE `randomize` SET `drawn` = 0;") or die ($this->hDB->error());
			$rs = $this->hDB->query($sql) or die ($this->hDB->error());
			
		}
		$data = $rs->fetch_array();
		$numbers=$data['number'];
		while($data=$rs->fetch_array()){
			$numbers=$numbers."-".$data['number'];
		}
		
		return $numbers;
	}
	
	function getIdNumber() {
		return $this->id_number;
	}
	
	function getIdSdiv() {
		return $this->id_message;
	}
	
	function getNumber() {
		return $this->number;
	}
	
	function getActive() {
		return $this->active;
	}
	
	function getDrawn() {
		return $this->drawn;
	}
	
	
	function setIdNumber() {
		return $this->id_number;
	}
	
	function setIdSdiv() {
		return $this->id_message;
	}
	
	function setNumber() {
		return $this->number;
	}
	
	function setActive() {
		return $this->active;
	}
	
	function setDrawn() {
		return $this->drawn;
	}
	
	public function __destruct() {

	//Koniec operacji na bazie danych. Zamknięcie połączenia.
	$this->hDB->close();
	}

}
?>