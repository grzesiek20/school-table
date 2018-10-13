<?php

class search
{
	private $id_sdiv;
	private $headertext;
	private $name;
	private $surname;
	private $content;
	private $begdate;
	private $enddate;
	private $visible;
	private $active;
	
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
		return $this->id_sdiv;
	}
	
	function getHeader() {
		return $this->headertext;
	}

	function getName() {
		return $this->name;
	}
	
	function getSurname() {
		return $this->surname;
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
	
	function setHeader($header) {
		$this->headertext = $header;
	}

	function setName($name) {
		$this->name = $name;
	}

	function setSurname($surname) {
		$this->surname = $surname;
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
	if($this->visible==2 && $this->begdate=='' && $this->enddate=='')
	{
		$sql = "SELECT content ,begdate, enddate, name, surname, header FROM `posts` WHERE header LIKE ('%".$this->headertext."%') AND name LIKE ('%".$this->name."%') AND surname LIKE ('%".$this->surname."%') AND content LIKE ('%".$this->content."%');";
	}
	elseif($this->visible==2 && $this->begdate!='' && $this->enddate!='')
	{
		$sql = "SELECT content ,begdate, enddate, name, surname, header FROM `posts` WHERE header LIKE ('%".$this->headertext."%') AND name LIKE ('%".$this->name."%') AND surname LIKE ('%".$this->surname."%') AND content LIKE ('%".$this->content."%') AND begdate >= '".$this->begdate."' AND enddate <= '".$this->enddate."';";
	}
	
	elseif($this->visible==1 && $this->begdate=='' && $this->enddate=='')
	{
		$sql = "SELECT content ,begdate, enddate, name, surname, header FROM `posts` WHERE header LIKE ('%".$this->headertext."%') AND name LIKE ('%".$this->name."%') AND surname LIKE ('%".$this->surname."%') AND content LIKE ('%".$this->content."%') AND visible='".$this->visible."';";
	}
	elseif($this->visible==1 && $this->begdate!='' && $this->enddate!='')
	{
		$sql = "SELECT content ,begdate, enddate, name, surname, header FROM `posts` WHERE header LIKE ('%".$this->headertext."%') AND name LIKE ('%".$this->name."%') AND surname LIKE ('%".$this->surname."%') AND content LIKE ('%".$this->content."%') AND begdate >= '".$this->begdate."' AND enddate <= '".$this->enddate."' AND visible='".$this->visible."';";
	}
	
	else{
		$sql = "SELECT content ,begdate, enddate, name, surname, header FROM `posts` WHERE header LIKE ('%".$this->headertext."%') AND name LIKE ('%".$this->name."%') AND surname LIKE ('%".$this->surname."%') AND content LIKE ('%".$this->content."%') AND begdate >= '".$this->begdate."' AND enddate <= '".$this->enddate."' AND visible='".$this->visible."';";
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
			$info[$i]['name'] = $data['name'];
			$info[$i]['surname'] = $data['surname'];
			$info[$i]['header'] = $data['header'];
			
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