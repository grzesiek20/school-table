<?php

class sdiv
{
	private $id_sdiv;
	private $id_diva;
	private $id_user;
	private $content;
	private $begdate;
	private $enddate;
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
	
	// function getAllDESC($divID) {
		
		// $sql = "SELECT * FROM sdiv WHERE id_diva='".$divID."' AND active=1 ORDER BY id_sdiv DESC;";
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
	
		function getAllDESC($divID) {
			$query = "SELECT * FROM `body` WHERE id_diva=? AND active=1 ORDER BY id_sdiv DESC;";

			$stmt = $this->hDB->prepare($query);
	
			$stmt->bind_param("i", $divID);
			
			/* Execute the statement */
			$stmt->execute();
			$info = array();
			$stmt->bind_result($id_sdiv, $id_diva, $id_user, $content, $begdate, $enddate, $visible, $active);
			$i=0;
		
			while($stmt->fetch()){
				$info[$i]['id_sdiv'] = $id_sdiv;
				$info[$i]['id_diva'] = $id_diva;
				$info[$i]['id_user'] = $id_user;
				$info[$i]['content'] = $content;
				$info[$i]['begdate'] = $begdate;
				$info[$i]['enddate'] = $enddate;
				$info[$i]['visible'] = $visible;
				$info[$i]['active'] = $active;
				$i++;
			}
			$stmt->close();
		// $sql = "SELECT * FROM `body` WHERE id_diva='".$divID."' AND active=1 ORDER BY id_sdiv DESC;";
		// $info = array();
		// $rs = $this->hDB->query($sql);
		
		// $i=0;
		
		// while($data = $rs->fetch_array()){
		// 	$info[$i]['id_sdiv'] = $data['id_sdiv'];
		// 	$info[$i]['id_diva'] = $data['id_diva'];
		// 	$info[$i]['content'] = $data['content'];
		// 	$info[$i]['begdate'] = $data['begdate'];
		// 	$info[$i]['enddate'] = $data['enddate'];
		// 	$info[$i]['visible'] = $data['visible'];
		// 	$info[$i]['active'] = $data['active'];
		// 	$i++;
		// }
		
		return $info;
	}
	
	function getAllVisibleDESC($divID) {
		$query = "SELECT * FROM `body` WHERE id_diva=? AND active=1 AND visible=1 ORDER BY id_sdiv DESC;";

		$stmt = $this->hDB->prepare($query);

		$stmt->bind_param("i", $divID);
		
		/* Execute the statement */
		$stmt->execute();
		$info = array();
		$stmt->bind_result($id_sdiv, $id_diva, $id_user, $content, $begdate, $enddate, $visible, $active);
		$i=0;
	
		while($stmt->fetch()){
			$info[$i]['id_sdiv'] = $id_sdiv;
			$info[$i]['id_diva'] = $id_diva;
			$info[$i]['id_user'] = $id_user;
			$info[$i]['content'] = $content;
			$info[$i]['begdate'] = $begdate;
			$info[$i]['enddate'] = $enddate;
			$info[$i]['visible'] = $visible;
			$info[$i]['active'] = $active;
			$i++;
		}
		$stmt->close();
		// $sql = "SELECT * FROM `body` WHERE id_diva='".$divID."' AND active=1 AND visible=1 ORDER BY id_sdiv DESC;";
		// $info = array();
		// $rs = $this->hDB->query($sql);
		
		// $i=0;
		
		// while($data = $rs->fetch_array()){
		// 	$info[$i]['id_sdiv'] = $data['id_sdiv'];
		// 	$info[$i]['id_diva'] = $data['id_diva'];
		// 	$info[$i]['content'] = $data['content'];
		// 	$info[$i]['begdate'] = $data['begdate'];
		// 	$info[$i]['enddate'] = $data['enddate'];
		// 	$info[$i]['visible'] = $data['visible'];
		// 	$info[$i]['active'] = $data['active'];
		// 	$i++;
		// }
		
		return $info;
	}
	
	function getSdiv($sdivID) {
		$query = "SELECT * FROM `body` WHERE id_sdiv=?;";

		$stmt = $this->hDB->prepare($query);

		$stmt->bind_param("i", $sdivID);

		/* Execute the statement */
		$stmt->execute();

		$stmt->bind_result($id_sdiv, $id_diva, $id_user, $content, $begdate, $enddate, $visible, $active);
		if($stmt->fetch()){
			$this->id_sdiv = $id_sdiv;
			$this->id_diva = $id_diva;
			$this->id_user = $id_user;
			$this->content = $content;
			$this->begdate = $begdate;
			$this->enddate = $enddate;
			$this->visible = $visible;
			$this->active = $active;
		}
		$stmt->close();


		// $sql = "SELECT * FROM `body` WHERE id_sdiv='".$sdivID."';";
		// $rs = $this->hDB->query($sql);

		
		// $data = $rs->fetch_array();
		// 	$this->id_sdiv = $data['id_sdiv'];
		// 	$this->id_diva = $data['id_diva'];
		// 	$this->content = $data['content'];
		// 	$this->begdate = $data['begdate'];
		// 	$this->enddate = $data['enddate'];
		// 	$this->visible = $data['visible'];
		// 	$this->active = $data['active'];
	}
	
	function updateSdiv(){
		// $query = "UPDATE `body` SET content = ?, begdate = ?, enddate = ?, visible = ? WHERE id_sdiv = ?;";
		// $stmt = $this->hDB->prepare($query);
		// $stmt->bind_param("sssii", $this->content, $this->begdate, $this->enddate, $this->visible, $this->id_sdiv);
		// $stmt->execute();
		// $stmt->close();
		$sql = "UPDATE `body` SET content = '". $this->hDB->escape_string($this->content)."', ";
		$sql .= "begdate = '" . $this->begdate . "', ";
		$sql .= "enddate = '" . $this->enddate . "', ";
		$sql .= "visible = '" . $this->visible . "' ";
		$sql .= "WHERE id_sdiv = '" . $this->id_sdiv ."'; ";
		
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
	}
	
	function insertSdiv(){
		$query = "INSERT INTO `body` (`id_diva`,`id_user`, `content`, `begdate`, `enddate`) VALUES ";
		$query .= "(?, 1, ?, ?, ?);";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("isss", $this->id_diva, $this->content, $this->begdate, $this->enddate);
		$stmt->execute();
		$stmt->close();
		// $sql = "INSERT INTO `body` (`id_diva`,`id_user`, `content`, `begdate`, `enddate`) VALUES ";
		// $sql .= "('" . $this->id_diva . "', 1, '" . $this->content . "', '" . $this->begdate. "',";
		// $sql .= "enddate = '" . $this->enddate . "');";
		
		// $rs = $this->hDB->query($sql) or die ($this->hDB->error());

	}
	
	function deleteSdiv($sdivID){
		$query = "UPDATE `body` SET `active` = 0 WHERE id_sdiv=?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("i", $sdivID);
		$stmt->execute();
		$stmt->close();
		// $sql = "UPDATE `body` SET `active` = 0 WHERE id_sdiv='".$sdivID."';";
		
		// $rs = $this->hDB->query($sql) or die ($this->hDB->error());
	}
	
	function setVisibility($sdivID,$set){
		$query = "UPDATE `body` SET `visible` =? where id_sdiv=?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("ii", $set, $sdivID);
		$stmt->execute();
		$stmt->close();
		// $sql = "UPDATE `body` SET `visible` ='".$set."' where id_sdiv='".$sdivID."';";
		
		// $rs = $this->hDB->query($sql) or die ($this->hDB->error());
	}
	
	function getPlan($gkoniec){
		$query = "SELECT nazwa, gkoniec FROM `plan` WHERE gpoczatek<=? AND gkoniec>?;";

		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("ss", $gkoniec, $gkoniec);

		/* Execute the statement */
		$stmt->execute();

		$stmt->bind_result($nazwa, $gkoniec);
		if($stmt->fetch()){
			return $nazwa."-".$gkoniec;
		}
		$stmt->close();
		// $sql = "SELECT nazwa, gkoniec FROM `plan` WHERE gpoczatek<='".$gkoniec."' AND gkoniec>'".$gkoniec."';";
		// $rs = $this->hDB->query($sql) or die ($this->hDB->error());

		// $data=$rs->fetch_array();
		
		//return $data['nazwa']."-".$data['gkoniec'];
	}
	
	function getPosts(){
		$sql= "UPDATE `body` SET `visible` = 0 WHERE enddate<CURRENT_DATE() AND enddate<>'0000-00-00'";
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
		
		$sql = "SELECT * FROM `body` WHERE id_diva=11 AND active=1 AND visible=1 AND ((begdate<=CURRENT_DATE() AND enddate>=CURRENT_DATE()) OR (begdate='0000-00-00' AND enddate='0000-00-00')) ORDER BY id_sdiv DESC;";
		
		 if($data = $this->hDB->query($sql))
			 $ile_wierszy = $data->num_rows;
		
		 $post=$data->fetch_array();
		 $news=$post['content'];
		 while($post=$data->fetch_array()){
			 $news=$news.";;".$post['content'];
		 }
		
		return $news."~".$ile_wierszy;
		
	}
	
	
	function getIdSdiv() {
		return $this->id_sdiv;
	}
	
	function getIdDiv() {
		return $this->id_diva;
	}

	function getIdUser() {
		return $this->id_user;
	}
	
	function getContent() {
		return $this->content;
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
	
	function setIdSdiv($sdivID) {
		$this->id_sdiv = $sdivID;;
	}
	
	function setIdDiv($divID) {
		$this->id_diva = $divID;
	}

	function setIdUser($idUser) {
		$this->id_user = $idUser;
	}
	
	function setContent($content) {
		$this->content = $content;
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
	
//---------------------------------wyszukiwanie---------------------------------------------
function searchSdivs(){
	if($this->visible==2 )
	{
		$sql = "SELECT content, begdate, enddate FROM `sdiv` WHERE content LIKE ('%".$this->content."%') AND active='".$this->active."' AND id_diva=11;";
	}
	elseif($this->visible==2 && $this->begdate!='' && $this->enddate!='')
	{
		$sql = "SELECT content ,begdate, enddate FROM `sdiv` WHERE content LIKE ('%".$this->content."%') AND begdate >= '".$this->begdate."' AND enddate <= '".$this->enddate."' AND active='".$this->active."' AND id_diva=11;";
	}
	
	elseif($this->visible==1 && $this->begdate=='' && $this->enddate=='')
	{
		$sql = "SELECT content ,begdate, enddate FROM `sdiv` WHERE content LIKE ('%".$this->content."%') AND active='".$this->active."' AND visible='".$this->visible."' AND id_diva=11;";
	}
	elseif($this->visible==1 && $this->begdate!='' && $this->enddate!='')
	{
		$sql = "SELECT content ,begdate, enddate FROM `sdiv` WHERE content LIKE ('%".$this->content."%') AND begdate >= '".$this->begdate."' AND enddate <= '".$this->enddate."' AND  active='".$this->active."' AND visible='".$this->visible."' AND id_diva=11;";
	}
	
	else{
		$sql = "SELECT content ,begdate, enddate FROM `sdiv` WHERE content LIKE ('%".$this->content."%') AND begdate >= '".$this->begdate."' AND enddate <= '".$this->enddate."' AND active='".$this->active."' AND visible='".$this->visible."' AND id_diva=11;";
	}
		
		$rs = $this->hDB->query($sql);
		$ile = $rs->num_rows;
		if($ile>0)
		{
			$i=0;
		while($data = $rs->fetch_array()){
			$info[$i]['content'] = $data['content'];
			$info[$i]['begdate'] = $data['begdate'];
			$info[$i]['enddate'] = $data['enddate'];
			
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