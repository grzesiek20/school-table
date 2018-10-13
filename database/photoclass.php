<?php

class photo
{
	private $id_photo;
	private $id_diva;
	private $name;
	private $begdate;
	private $enddate;
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
	
	// function getAllDESC($divID) {
		
		// $sql = "SELECT * FROM sdiv WHERE id_diva=".$divID." AND active=1 ORDER BY id_sdiv DESC;";
		// $info = array();
		// $rs = $this->hDB->query($sql);
		
		// $i=0;
		
		// while($data = $rs->fetch_array()){
			// $info[$i]['id_sdiv'] = $data['id_sdiv'];
			// $info[$i]['id_diva'] = $data['id_diva'];
			// $info[$i]['id_user'] = $data['id_user'];
			// $info[$i]['content'] = $data['content'];
			// $info[$i]['begdate'] = $data['begdate'];
			// $info[$i]['enddate'] = $data['enddate'];
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
			$info[$i]['id_diva'] = $data['id_diva'];
			$info[$i]['name'] = $data['name'];
			$info[$i]['begdate'] = $data['begdate'];
			$info[$i]['enddate'] = $data['enddate'];
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
			$info[$i]['id_diva'] = $data['id_diva'];
			$info[$i]['name'] = $data['name'];
			$info[$i]['begdate'] = $data['begdate'];
			$info[$i]['enddate'] = $data['enddate'];
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
			$this->id_diva = $data['id_diva'];
			$this->name = $data['name'];
			$this->begdate = $data['begdate'];
			$this->enddate = $data['enddate'];
			$this->visible = $data['visible'];
			$this->active = $data['active'];
	}
	
	function updatePhoto(){
		$sql = "UPDATE `photo` SET name = '". $this->hDB->escape_string($this->name)."', ";
		$sql .= "begdate = '" . $this->begdate . "', ";
		$sql .= "enddate = '" . $this->enddate . "', ";
		$sql .= "visible = '" . $this->visible . "' ";
		$sql .= "WHERE id_photo = " . $this->id_photo ."; ";
		
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
	}
	
	function insertSdiv(){
		
		$sql = "INSERT INTO `sdiv` (`id_sdiv`, `id_diva`, `content`, `begdate`, `enddate`) VALUES ";
		$sql .= "(NULL, '" . $this->id_diva . "', '" . $this->content . "', '" . $this->begdate. "',";
		$sql .= "enddate = '" . $this->enddate . "');";
		
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
		// $sql= "UPDATE `sdiv` SET `visible` = 0 WHERE enddate<CURRENT_DATE() AND enddate<>'0000-00-00'";
		// $rs = $this->hDB->query($sql) or die ($this->hDB->error());
		
		// $sql = "SELECT * FROM `sdiv` WHERE id_diva=11 AND active=1 AND visible=1 AND ((begdate<=CURRENT_DATE() AND enddate>=CURRENT_DATE()) OR (begdate='0000-00-00' AND enddate='0000-00-00')) ORDER BY id_sdiv DESC;";
		
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
		return $this->id_diva;
	}

	
	function getLink() {
		return $this->name;
	}
	
	function getBegdate() {
		return $this->begdate;
	}
	
	function getEnddate() {
		return $this->enddate;
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
	
	function setIdDiv($divID) {
		$this->id_diva = $divID;
	}

	
	function setName($name) {
		$this->name = $name;
	}
	
	function setBegdate($begdate) {
		$this->begdate = $begdate;
	}
	
	function setEnddate($enddate) {
		$this->enddate = $enddate;
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