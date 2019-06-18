<?php

class draw
{
	private $id_history;
	private $id_number;
	private $drawdate;
	private $id_message;
	private $number;
	private $drawn;
	private $active;
	
	private $begin_date;
	private $end_date;
	
	private $hDB;
	
	
	public function __construct(){
	require __DIR__. "/../connect.php";
	
	if (session_status() == PHP_SESSION_NONE) 
		{
			session_start();			
		}		
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
	
	
	function getIdSdiv() {
		return $this->id_message;
	}
	
	function getIdNumber() {
		return $this->id_number;
	}

	function getNumber() {
		return $this->number;
	}
	
	function getIdHistory() {
		return $this->id_history;
	}
	
	function getDrawDate() {
		return $this->drawdate;
	}
	
	function getDrawn() {
		return $this->drawn;
	}

	function getActive() {
		return $this->active;
	}
	
	
	
	//set
	
	function setIdSdiv($messageID) {
		$this->id_message = $messageID;
	}
	
	function setIdNumber($id_number) {
		$this->id_number = $id_number;
	}

	function setNumber($number) {
		$this->number= $number;
	}
	
	function setIdHistory($id_history) {
		$this->id_history = $id_history;
	}
	
	function setDrawDate($drawdate) {
		$this->drawdate= $drawdate;
	}

	function setDrawn($drawn) {
		$this->drawn = $drawn;
	}
	
	function setActive($active) {
		$this->active = $active;
	}
	
	function setBegdate($begin_date) {
		$this->begin_date = $begin_date;
	}	
	
	function setEnddate($end_date) {
		$this->end_date = $end_date;
	}	
	
//---------------------------------wyszukiwanie---------------------------------------------
function searchNumbers(){
	if($this->drawn==2 && $this->begin_date=='' && $this->end_date=='')
	{
		$sql = "SELECT number FROM `randomize` WHERE active =1;";
	}
	elseif($this->drawn==2 && $this->begin_date!='' && $this->end_date!='')
	{
		$sql = "SELECT id_number, date FROM `history` WHERE `date` >= '".$this->begin_date."' AND `date` <= '".$this->end_date."';";
	}
	
	elseif($this->drawn==1 && $this->begin_date=='' && $this->end_date=='')
	{
		$sql = "SELECT number FROM `randomize` WHERE active =1 AND drawn=1;";
	}
	elseif($this->drawn==1 && $this->begin_date!='' && $this->end_date!='')
	{
		$sql = "SELECT id_number, date FROM `history` WHERE id_number= '".$this->number."' AND date >= '".$this->begin_date."' AND end_date <= '".$this->end_date."';";
	}
	
	else{
		$sql = "SELECT number,'' date FROM `randomize` WHERE active =1 AND drawn=0;";
	}
		
		$rs = $this->hDB->query($sql);
		$ile = $rs->num_rows;
		if($ile>0)
		{
			$i=0;
		while($data = $rs->fetch_array()){
			if(($this->drawn==2 || $this->drawn==1) && $this->begin_date!='' && $this->end_date!=''){
			$info[$i]['number'] = $data['id_number'];
			$info[$i]['date'] = $data['date'];
			}else{
				$info[$i]['number'] = $data['number'];
			}
			
			$i++;
		}
			
			return $info;
		}
	}
	
	
	public function __destruct() {
		
		//Koniec operacji na bazie danych. Zamknięcie połączenia.
		$this->hDB->close();
		}
	
}
?>