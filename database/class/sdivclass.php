<?php

class message
{
	private $id_message;
	private $id_panel;
	private $id_user;
	private $content;
	private $begin_date;
	private $end_date;
	private $visible;
	private $active;
	
	private $hDB;
	
	
	public function __construct(){
	require __DIR__. "/../connect.php";
	//require "connect.php";
	
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
		function getAllDESC($panelID) {
			$query = "SELECT * FROM `message` WHERE id_panel=? AND active=1 ORDER BY id_message DESC;";

			$stmt = $this->hDB->prepare($query);
	
			$stmt->bind_param("i", $panelID);
			
			/* Execute the statement */
			$stmt->execute();
			$info = array();
			$stmt->bind_result($id_message, $id_panel, $id_user, $content, $begin_date, $end_date, $visible, $active);
			$i=0;
		
			while($stmt->fetch()){
				$info[$i]['id_message'] = $id_message;
				$info[$i]['id_panel'] = $id_panel;
				$info[$i]['id_user'] = $id_user;
				$info[$i]['content'] = $content;
				$info[$i]['begin_date'] = $begin_date;
				$info[$i]['end_date'] = $end_date;
				$info[$i]['visible'] = $visible;
				$info[$i]['active'] = $active;
				$i++;
			}
			$stmt->close();
		
		return $info;
	}
	
	function getAllVisibleDESC($panelID) {
		$query = "SELECT * FROM `message` WHERE id_panel=? AND active=1 AND visible=1 ORDER BY id_message DESC;";

		$stmt = $this->hDB->prepare($query);

		$stmt->bind_param("i", $panelID);
		
		/* Execute the statement */
		$stmt->execute();
		$info = array();
		$stmt->bind_result($id_message, $id_panel, $id_user, $content, $begin_date, $end_date, $visible, $active);
		$i=0;
	
		while($stmt->fetch()){
			$info[$i]['id_message'] = $id_message;
			$info[$i]['id_panel'] = $id_panel;
			$info[$i]['id_user'] = $id_user;
			$info[$i]['content'] = $content;
			$info[$i]['begin_date'] = $begin_date;
			$info[$i]['end_date'] = $end_date;
			$info[$i]['visible'] = $visible;
			$info[$i]['active'] = $active;
			$i++;
		}
		$stmt->close();
		
		return $info;
	}
	
	function getSdiv($messageID) {
		$query = "SELECT * FROM `message` WHERE id_message=?;";

		$stmt = $this->hDB->prepare($query);

		$stmt->bind_param("i", $messageID);

		/* Execute the statement */
		$stmt->execute();

		$stmt->bind_result($id_message, $id_panel, $id_user, $content, $begin_date, $end_date, $visible, $active);
		if($stmt->fetch()){
			$this->id_message = $id_message;
			$this->id_panel = $id_panel;
			$this->id_user = $id_user;
			$this->content = $content;
			$this->begin_date = $begin_date;
			$this->end_date = $end_date;
			$this->visible = $visible;
			$this->active = $active;
		}
		$stmt->close();

	}
	
	function updateSdiv(){
		$query = "UPDATE `message` SET content = ?, begin_date = ?, end_date = ?, visible = ? WHERE id_message = ?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("sssii", $this->content, $this->begin_date, $this->end_date, $this->visible, $this->id_message);
		$stmt->execute();
		$stmt->close();

	}
	
	function insertSdiv(){
		$query = "INSERT INTO `message` (`id_panel`, `id_user`, `content`, `begin_date`, `end_date`) VALUES ";
		$query .= "(?, 1, ?, ?, ?);";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("isss", $this->id_panel, $this->content, $this->begin_date, $this->end_date);
		if($stmt->execute()) {
			Logger::wh_log(__METHOD__,"Success","Komunikat dodany poprawnie!\n".$this->writeData());
		} else {
			Logger::wh_log(__METHOD__,"Error","Komunikat nie został dodany!\n".$this->writeData());
		}

		$stmt->close();
	}
	
	function deleteSdiv($messageID){
		$query = "UPDATE `message` SET `active` = 0 WHERE id_message=?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("i", $messageID);
		if($stmt->execute()) {
			Logger::wh_log(__METHOD__,"Success","Komunikat usunięty!\n ID: ".$messageID);
		} else {
			Logger::wh_log(__METHOD__,"Error","Komunikat nie został usunięty!\n ID: ".$messageID);
		}
		$stmt->close();
	}
	
	function setVisibility($messageID,$set){
		$query = "UPDATE `message` SET `visible` =? where id_message=?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("ii", $set, $messageID);
		$stmt->execute();
		$stmt->close();
	}
	
	function getPlan($end_hour){
		$query = "SELECT `description`, end_hour FROM `plan` WHERE begin_hour<=? AND end_hour>?;";

		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("ss", $end_hour, $end_hour);

		/* Execute the statement */
		$stmt->execute();

		$stmt->bind_result($nazwa, $end_hour);
		if($stmt->fetch()){
			return $nazwa."-".$end_hour;
		}
		$stmt->close();
	}
	
	function getPosts(){
		$sql= "UPDATE `message` SET `visible` = 0 WHERE end_date<CURRENT_DATE() AND end_date<>'0000-00-00'";
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
		$sql = "SELECT id_panel FROM `panel` WHERE `block_type` = 'multipleblock';";
		$data = $this->hDB->query($sql);
			if ($data->num_rows==1) {
				$result=$data->fetch_array();
				$sql = "SELECT * FROM `message` WHERE id_panel=".$result['id_panel']." AND active=1 AND visible=1 AND ((begin_date<=CURRENT_DATE() AND end_date>=CURRENT_DATE()) OR (begin_date='0000-00-00' AND end_date='0000-00-00')) ORDER BY id_message DESC;";
		
				if($data = $this->hDB->query($sql))
					$ile_wierszy = $data->num_rows;
			
				$post=$data->fetch_array();
				$news=$post['content'];
				while($post=$data->fetch_array()){
					$news=$news.";;".$post['content'];
				}
				
				return $news."~".$ile_wierszy;
			}
	}
	
	
	function getIdSdiv() {
		return $this->id_message;
	}
	
	function getIdDiv() {
		return $this->id_panel;
	}

	function getIdUser() {
		return $this->id_user;
	}
	
	function getContent() {
		return $this->content;
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
	
	function setIdSdiv($messageID) {
		$this->id_message = $messageID;;
	}
	
	function setIdDiv($panelID) {
		$this->id_panel = $panelID;
	}

	function setIdUser($idUser) {
		$this->id_user = $idUser;
	}
	
	function setContent($content) {
		$this->content = $content;
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
	
	function writeData() {
		$object = "Obiekt: Komunikat\nid_panel: ".$this->id_panel."\nid_user: ".$this->id_user."\nTreść: ".$this->content."\n";
		$object .= "Data początkowa: ".$this->begin_date."\nData końcowa: ".$this->end_date;
		return $object;
	}
//---------------------------------wyszukiwanie---------------------------------------------
function searchSdivs(){
	if($this->visible==2 )
	{
		$sql = "SELECT content, begin_date, end_date FROM `message` WHERE content LIKE ('%".$this->content."%') AND active='".$this->active."' AND id_panel=11;";
	}
	elseif($this->visible==2 && $this->begin_date!='' && $this->end_date!='')
	{
		$sql = "SELECT content ,begin_date, end_date FROM `message` WHERE content LIKE ('%".$this->content."%') AND begin_date >= '".$this->begin_date."' AND end_date <= '".$this->end_date."' AND active='".$this->active."' AND id_panel=11;";
	}
	
	elseif($this->visible==1 && $this->begin_date=='' && $this->end_date=='')
	{
		$sql = "SELECT content ,begin_date, end_date FROM `message` WHERE content LIKE ('%".$this->content."%') AND active='".$this->active."' AND visible='".$this->visible."' AND id_panel=11;";
	}
	elseif($this->visible==1 && $this->begin_date!='' && $this->end_date!='')
	{
		$sql = "SELECT content ,begin_date, end_date FROM `message` WHERE content LIKE ('%".$this->content."%') AND begin_date >= '".$this->begin_date."' AND end_date <= '".$this->end_date."' AND  active='".$this->active."' AND visible='".$this->visible."' AND id_panel=11;";
	}
	
	else{
		$sql = "SELECT content ,begin_date, end_date FROM `message` WHERE content LIKE ('%".$this->content."%') AND begin_date >= '".$this->begin_date."' AND end_date <= '".$this->end_date."' AND active='".$this->active."' AND visible='".$this->visible."' AND id_panel=11;";
	}
		
		$rs = $this->hDB->query($sql);
		$ile = $rs->num_rows;
		if($ile>0)
		{
			$i=0;
		while($data = $rs->fetch_array()){
			$info[$i]['content'] = $data['content'];
			$info[$i]['begin_date'] = $data['begin_date'];
			$info[$i]['end_date'] = $data['end_date'];
			
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