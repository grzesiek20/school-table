<?php
	
class div 
{
	private $id_diva;
	private $height;
	private $per_width;
	private $topm;
	private $per_left;
	private $bgcolor;
	private $fontsize;
	private $fontcolor;
	private $header;
	private $headercolor;
	private $headerfsize;
	private $headerfcolor;
	private $textalign;
	private $active;
	
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

	// public function __construct(){
	// 	require "connect.php";
		
	// 	//Tworzy uchwyt połączenia
	// 	$this->hDB = new mysqli($host,$db_user,$db_password, $db_nam);
	// 	mysqli_set_charset($this->hDB, "utf8");
	// 	//sprawdzamy polaczenie
	// 	if (mysqli_connect_errno()) {
	// 		printf("Connect failed: %s\n", mysqli_connect_error());
	// 		exit();
	// 	}
		
	// 	// if (!$this->hDB->select_db($db_name))
	// 	// 	echo "Nie udało się wybrać bazy danych";
		
	// 	// $this->hDB->select_db($db_name);
		
	// }
	
	function getDiv($divID){
		// $sql = "SELECT * FROM `divy` WHERE id_diva='".$divID."';";
		
		// $rs = $this->hDB->query($sql);
		
		// $data = $rs->fetch_array();
		// 	$this->id_diva = $divID;
		// 	$this->height = $data['height'];
		// 	$this->per_width = $data['per_width'];
		// 	$this->topm = $data['topm'];
		// 	$this->per_leftm = $data['per_leftm'];
		// 	$this->bgcolor = $data['bgcolor'];
		// 	$this->fontsize = $data['fontsize'];
		// 	$this->fontcolor = $data['fontcolor'];
		// 	$this->headertext = $data['header'];
		// 	$this->headercolor = $data['headercolor'];
		// 	$this->headerfsize = $data['headerfsize'];
		// 	$this->headerfcolor = $data['headerfcolor'];
		// 	$this->textalign = $data['textalign'];
		// 	$this->active = $data['active'];
		///////////////////////////////////////////////////

		$query = "SELECT * FROM `divy` WHERE id_diva=?;";

		$stmt = $this->hDB->prepare($query);

		$stmt->bind_param("i", $divID);

		/* Execute the statement */
		$stmt->execute();

		$stmt->bind_result($id_diva, $height, $per_width, $topm, $per_leftm, $bgcolor, $fontsize, $fontcolor, $headertext, $headercolor, $headerfsize, $headerfcolor, $textalign, $active);
		if($stmt->fetch()){
			$this->id_diva = $divID;
			$this->height = $height;
			$this->per_width = $per_width;
			$this->topm = $topm;
			$this->per_leftm = $per_leftm;
			$this->bgcolor = $bgcolor;
			$this->fontsize = $fontsize;
			$this->fontcolor = $fontcolor;
			$this->headertext = $headertext;
			$this->headercolor = $headercolor;
			$this->headerfsize = $headerfsize;
			$this->headerfcolor = $headerfcolor;
			$this->textalign = $textalign;
			$this->active = $active;
		}
		$stmt->close();
	}
	
	function getAll() {
		//$stmt = $this->hDB->prepare("SELECT * FROM `divy` WHERE active=1");
		$sql = "SELECT * FROM `divy` WHERE active=1";
		$info = array();
		//$stmt->execute();
		$rs = $this->hDB->query($sql);
		
		$i=0;
		
		while($data = $rs->fetch_array()){
			$info[$i]['id_diva'] = $data['id_diva'];
			$info[$i]['height'] = $data['height'];
			$info[$i]['per_width'] = $data['per_width'];
			$info[$i]['topm'] = $data['topm'];
			$info[$i]['per_leftm'] = $data['per_leftm'];
			$info[$i]['bgcolor'] = $data['bgcolor'];
			$info[$i]['fontsize'] = $data['fontsize'];
			$info[$i]['fontcolor'] = $data['fontcolor'];
			$info[$i]['headertext'] = $data['header'];
			$info[$i]['headercolor'] = $data['headercolor'];
			$info[$i]['headerfsize'] = $data['headerfsize'];
			$info[$i]['headerfcolor'] = $data['headerfcolor'];
			$info[$i]['textalign'] = $data['textalign'];
			$info[$i]['active'] = $data['active'];
			$i++;
		}
		
		return $info;
	}
	
	function addDiv()
    {
		/////////////////////escape string///////////////////////////////
		mysqli_escape_string($this->hDB, $this->getHeader());


		////////////////////HTML entities/////////////////////////////////
		$headerText = htmlentities($this->getHeader(), ENT_QUOTES, "UTF-8"); 

		
		$sql="INSERT INTO `divy` (`id_diva`,`header`,`headercolor`,`headerfcolor`,`headerfsize`,`bgcolor`,`fontsize`,`fontcolor`,`topm`,`height`,`per_width`) VALUES(NULL,'".mysqli_escape_string($this->hDB, $this->getHeader())."','".$this->headercolor."','".$this->headerfcolor."','".$this->headerfsize."','".$this->bgcolor."','".$this->fontsize."','".$this->fontcolor."','".$this->topm."','".$this->height."','".$this->per_width."') ;";

		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
		//$query = "INSERT INTO slider (id_slider, height) VALUES (?,?)";

		///////////////////////////parametrized query//////////////////////////////////////////////////
		// $query = "INSERT INTO `divy` (`header`,`headercolor`,`headerfcolor`,`headerfsize`,`bgcolor`,`fontsize`,`fontcolor`,`topm`,`height`,`per_width`)VALUES(?,?,?,?,?,?,?,?,?,?);";

		// $stmt = $this->hDB->prepare($query);

		// $stmt->bind_param("sssisisiii", $this->headertext, $this->headercolor, $this->headerfcolor, $this->headerfsize, $this->bgcolor, $this->fontsize, $this->fontcolor, $this->topm, $this->height, $this->per_width);

		// /* Execute the statement */
		// $stmt->execute();
		// $stmt->close();
    }
	
	function updateDiv()
    {
		//$sql="UPDATE `divy` SET `header` = '".$this->headertext."', `headercolor` = '".$this->headercolor."', `headerfcolor` = '".$this->headerfcolor."', `headerfsize` = '".$this->headerfsize."', `bgcolor` = '".$this->bgcolor."', `fontsize` = '".$this->fontsize."', `fontcolor` = '".$this->fontcolor."', `textalign` = '".$this->textalign."' WHERE id_diva ='".$this->id_diva."';";
		$query = "UPDATE `divy` SET `header` = ?, `headercolor` = ?, `headerfcolor` = ?, `headerfsize` = ?, `bgcolor` = ?, `fontsize` = ?, `fontcolor` = ?, `textalign` = ? WHERE id_diva =?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("sssisissi", $this->headertext, $this->headercolor, $this->headerfcolor, $this->headerfsize, $this->bgcolor, $this->fontsize, $this->fontcolor, $this->textalign, $this->id_diva);
		$stmt->execute();
		$stmt->close();
		//$query->close();
		//$rs = $this->hDB->query($sql) or die ($this->hDB->error());
    }
	
	function updateDivLocation()
    {
		//$sql="UPDATE `divy` SET `per_width` = '".$this->per_width."', `height` = '".$this->height."', `per_leftm` = '".$this->per_leftm."', `topm` = '".$this->topm."' WHERE `id_diva` ='".$this->id_diva."';";
		$query="UPDATE `divy` SET `per_width` = ?, `height` = ?, `per_leftm` = ?, `topm` = ? WHERE `id_diva` =?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("iiiii", $this->per_width, $this->height, $this->per_leftm, $this->topm, $this->id_diva);
		$stmt->execute();
		$stmt->close();		
		//$rs = $this->hDB->query($sql) or die ($this->hDB->error());
    }
	
	
	function deleteDiv($divID){
		// $sql = "UPDATE `divy` SET `active` = 0 WHERE id_diva='".$divID."';";
		$query = "UPDATE `divy` SET `active` = 0 WHERE id_diva=?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("i", $divID);
		$stmt->execute();
		$stmt->close();
		// $rs = $this->hDB->query($sql) or die ($this->hDB->error());
	}
	
	function updateSliderheight($sliderheight){
		//$sql="UPDATE `slider` SET `height`='".$sliderheight."';";
		
		$query = "UPDATE `slider` SET `height`=?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("i", $sliderheight);
		$stmt->execute();
		$stmt->close();

		//$rs = $this->hDB->query($sql) or die ($this->hDB->error());
	}
	
	function getSliderheight(){
		$sql="SELECT `height` FROM slider;";
		
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
		$data = $rs->fetch_array();
		return $data['height'];
	}
	
	function getIdDiv() {
		return $this->id_diva;
	}
	
	function getHeight() {
		return $this->height;
	}
	
	function getPer_width() {
		return $this->per_width;
	}
	
	function getTopm() {
		return $this->topm;
	}
	
	function getPer_leftm() {
		return $this->per_leftm;
	}
	
	function getBgcolor() {
		return $this->bgcolor;
	}
	
	function getFontsize() {
		return $this->fontsize;
	}
	
	function getFontcolor() {
		return $this->fontcolor;
	}
	
	function getHeader() {
		return $this->headertext;
	}
	
	function getHeadercolor() {
		return $this->headercolor;
	}
	
	function getHeaderfsize() {
		return $this->headerfsize;
	}
	
	function getHeaderfcolor() {
		return $this->headerfcolor;
	}
	
	function getTextalign() {
		return $this->textalign;
	}
	
	function getActive() {
		return $this->active;
	}
	
	
	
	function setIdDiv($DivID) {
		$this->id_diva = $DivID;
	}
	
	function setHeight($height) {
		$this->height = $height;
	}
	
	function setPer_width($per_width) {
		$this->per_width = $per_width;
	}
	
	function setTopm($topm) {
		$this->topm = $topm;
	}
	
	function setPer_leftm($per_leftm) {
		$this->per_leftm = $per_leftm;
	}
	
	function setBgcolor($bgcolor) {
		$this->bgcolor = $bgcolor;
	}
	
	function setFontsize($fontsize) {
		$this->fontsize = $fontsize;
	}
	
	function setFontcolor($fontcolor) {
		$this->fontcolor = $fontcolor;
	}
	
	function setHeader($header) {
		$this->headertext = $header;
	}
	
	function setHeadercolor($headercolor) {
		$this->headercolor = $headercolor;
	}
	
	function setHeaderfsize($headerfsize) {
		$this->headerfsize = $headerfsize;
	}
	
	function setHeaderfcolor($headerfcolor) {
		$this->headerfcolor = $headerfcolor;
	}
	
	function setTextalign($textalign) {
		$this->textalign = $textalign;
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