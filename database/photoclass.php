<?php

class photo
{
	private $id_photo;
	private $id_panel;
	private $name;
	private $begin_date;
	private $end_date;
	private $visible;
	private $active;
	
	private $hDB;
	
	
	public function __construct(){
	require "connect.php";
	
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
	
	// function getAllDESC($panelID) {
		
		// $sql = "SELECT * FROM sdiv WHERE id_panel=".$panelID." AND active=1 ORDER BY id_message DESC;";
		// $info = array();
		// $rs = $this->hDB->query($sql);
		
		// $i=0;
		
		// while($data = $rs->fetch_array()){
			// $info[$i]['id_message'] = $data['id_message'];
			// $info[$i]['id_panel'] = $data['id_panel'];
			// $info[$i]['id_user'] = $data['id_user'];
			// $info[$i]['content'] = $data['content'];
			// $info[$i]['begin_date'] = $data['begin_date'];
			// $info[$i]['end_date'] = $data['end_date'];
			// $info[$i]['visible'] = $data['visible'];
			// $info[$i]['active'] = $data['active'];
			// $i++;
		// }
		
		// return $info;
	// }
	
		function getAll() {
		
		$sql = "SELECT * FROM photo WHERE active=1;";
		$info = array();
		$rs = $this->hDB->query($sql);
		
		$i=0;
		
		while($data = $rs->fetch_array()){
			$info[$i]['id_photo'] = $data['id_photo'];
			$info[$i]['id_panel'] = $data['id_panel'];
			$info[$i]['name'] = $data['name'];
			$info[$i]['begin_date'] = $data['begin_date'];
			$info[$i]['end_date'] = $data['end_date'];
			$info[$i]['visible'] = $data['visible'];
			$info[$i]['active'] = $data['active'];
			$i++;
		}
		
		return $info;
	}
	
	function getAllVisible() {
		
		$sql = "SELECT * FROM photo WHERE active=1 AND visible=1;";
		$info = array();
		$rs = $this->hDB->query($sql);
		
		$i=0;
		
		while($data = $rs->fetch_array()){
			$info[$i]['id_photo'] = $data['id_photo'];
			$info[$i]['id_panel'] = $data['id_panel'];
			$info[$i]['name'] = $data['name'];
			$info[$i]['begin_date'] = $data['begin_date'];
			$info[$i]['end_date'] = $data['end_date'];
			$info[$i]['visible'] = $data['visible'];
			$info[$i]['active'] = $data['active'];
			$i++;
		}
		
		return $info;
	}
	
	function getSdiv($photoID) {
		
		$sql = "SELECT * FROM photo WHERE id_photo='".$photoID."';";
		$rs = $this->hDB->query($sql);

		
		$data = $rs->fetch_array();
			$this->id_photo = $data['id_photo'];
			$this->id_panel = $data['id_panel'];
			$this->name = $data['name'];
			$this->begin_date = $data['begin_date'];
			$this->end_date = $data['end_date'];
			$this->visible = $data['visible'];
			$this->active = $data['active'];
	}
	
	function updatePhoto(){
		$sql = "UPDATE `photo` SET name = '". $this->hDB->escape_string($this->name)."', ";
		$sql .= "begin_date = '" . $this->begin_date . "', ";
		$sql .= "end_date = '" . $this->end_date . "', ";
		$sql .= "visible = '" . $this->visible . "' ";
		$sql .= "WHERE id_photo = " . $this->id_photo ."; ";
		
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
	}
	
	function insertSdiv(){
		
		$sql = "INSERT INTO `message` (`id_message`, `id_panel`, `content`, `begin_date`, `end_date`) VALUES ";
		$sql .= "(NULL, '" . $this->id_panel . "', '" . $this->content . "', '" . $this->begin_date. "',";
		$sql .= "end_date = '" . $this->end_date . "');";
		
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
	}
	
	function deletePhoto($photoID){
		$sql = "UPDATE `photo` SET `active` = 0 WHERE id_photo='".$photoID."';";
		
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
	}
	
	function setVisibility($photoID,$set){
		$sql = "UPDATE `photo` SET `visible` =".$set." where id_photo='".$photoID."';";
		
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
	}
	
	// function getPosts(){
		// $sql= "UPDATE `message` SET `visible` = 0 WHERE end_date<CURRENT_DATE() AND end_date<>'0000-00-00'";
		// $rs = $this->hDB->query($sql) or die ($this->hDB->error());
		
		// $sql = "SELECT * FROM `message` WHERE id_panel=11 AND active=1 AND visible=1 AND ((begin_date<=CURRENT_DATE() AND end_date>=CURRENT_DATE()) OR (begin_date='0000-00-00' AND end_date='0000-00-00')) ORDER BY id_message DESC;";
		
		 // if($data = $this->hDB->query($sql))
			 // $ile_wierszy = $data->num_rows;
		
		 // $post=$data->fetch_array();
		 // $news=$post['content'];
		 // while($post=$data->fetch_array()){
			 // $news=$news.";;".$post['content'];
		 // }
		
		// return $news."~".$ile_wierszy;
		
	// }
	
	
	function getIdPhoto() {
		return $this->id_photo;
	}
	
	function getIdDiv() {
		return $this->id_panel;
	}

	
	function getLink() {
		return $this->name;
	}
	
	function getBegdate() {
		return $this->begin_date;
	}
	
	function getEnddate() {
		return $this->end_date;
	}
	
	function getVisible() {
		return $this->visible;
	}
	
	function getActive() {
		return $this->active;
	}
	
	
	//set
	
	function setIdPhoto($photoID) {
		$this->id_photo = $photoID;;
	}
	
	function setIdDiv($panelID) {
		$this->id_panel = $panelID;
	}

	
	function setName($name) {
		$this->name = $name;
	}
	
	function setBegdate($begin_date) {
		$this->begin_date = $begin_date;
	}
	
	function setEnddate($end_date) {
		$this->end_date = $end_date;
	}
	
	function setVisible($visible) {
		$this->visible = $visible;
	}
	
	function setActive($active) {
		$this->active = $active;
	}
	
	public function __destruct() {
		
		//Koniec operacji na bazie danych. Zamknięcie połączenia.
		$this->hDB->close();
		}
	
}
?>