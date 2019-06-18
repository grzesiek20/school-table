<?php
	
class panel 
{
	private $id_panel;
	private $height;
	private $percent_width;
	private $top_margin;
	private $percent_left;
	private $background_color;
	private $font_size;
	private $font_color;
	private $header;
	private $header_color;
	private $header_font_size;
	private $header_font_color;
	private $text_align;
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
	
	function getDiv($panelID){
		$sql = "SELECT * FROM `panel` WHERE id_panel='".$panelID."';";
		
		$rs = $this->hDB->query($sql);
		
		$data = $rs->fetch_array();
			$this->id_panel = $panelID;
			$this->height = $data['height'];
			$this->percent_width = $data['percent_width'];
			$this->top_margin = $data['top_margin'];
			$this->percent_left_margin = $data['percent_left_margin'];
			$this->background_color = $data['background_color'];
			$this->font_size = $data['font_size'];
			$this->font_color = $data['font_color'];
			$this->headertext = $data['header'];
			$this->header_color = $data['header_color'];
			$this->header_font_size = $data['header_font_size'];
			$this->header_font_color = $data['header_font_color'];
			$this->text_align = $data['text_align'];
			$this->active = $data['active'];
	}

	// function getDiv($panelID){
	// 	$stmt = $this->hDB->prepare("SELECT * FROM `panel` WHERE id_panel=?");
	// 	$stmt->bind_param("i", $panelID);
	// 	$stmt->execute();
	// 	//$rs = $this->hDB->query($sql);
		
	// 	$data = $stmt->fetch_array(MYSQLI_ASSOC);
	// 		$this->id_panel = $panelID;
	// 		$this->height = $data['height'];
	// 		$this->percent_width = $data['percent_width'];
	// 		$this->top_margin = $data['top_margin'];
	// 		$this->percent_left_margin = $data['percent_left_margin'];
	// 		$this->background_color = $data['background_color'];
	// 		$this->font_size = $data['font_size'];
	// 		$this->font_color = $data['font_color'];
	// 		$this->headertext = $data['header'];
	// 		$this->header_color = $data['header_color'];
	// 		$this->header_font_size = $data['header_font_size'];
	// 		$this->header_font_color = $data['header_font_color'];
	// 		$this->text_align = $data['text_align'];
	// 		$this->active = $data['active'];
	// }

	
	function getAll() {
		//$stmt = $this->hDB->prepare("SELECT * FROM `panel` WHERE active=1");
		$sql = "SELECT * FROM `panel` WHERE active=1";
		$info = array();
		//$stmt->execute();
		$rs = $this->hDB->query($sql);
		
		$i=0;
		
		while($data = $rs->fetch_array()){
			$info[$i]['id_panel'] = $data['id_panel'];
			$info[$i]['height'] = $data['height'];
			$info[$i]['percent_width'] = $data['percent_width'];
			$info[$i]['top_margin'] = $data['top_margin'];
			$info[$i]['percent_left_margin'] = $data['percent_left_margin'];
			$info[$i]['background_color'] = $data['background_color'];
			$info[$i]['font_size'] = $data['font_size'];
			$info[$i]['font_color'] = $data['font_color'];
			$info[$i]['headertext'] = $data['header'];
			$info[$i]['header_color'] = $data['header_color'];
			$info[$i]['header_font_size'] = $data['header_font_size'];
			$info[$i]['header_font_color'] = $data['header_font_color'];
			$info[$i]['text_align'] = $data['text_align'];
			$info[$i]['active'] = $data['active'];
			$i++;
		}
		
		return $info;
	}
	
	function addDiv()
    {
		$sql="INSERT INTO `panel` (`id_panel`,`header`,`header_color`,`header_font_color`,`header_font_size`,`background_color`,`font_size`,`font_color`,`top_margin`,`height`,`percent_width`) VALUES(NULL,'".$this->headertext."','".$this->header_color."','".$this->header_font_color."','".$this->header_font_size."','".$this->background_color."','".$this->font_size."','".$this->font_color."','".$this->top_margin."','".$this->height."','".$this->percent_width."') ;";

		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
    }
	
	function updatePanel()
    {
		$sql="UPDATE `panel` SET `header` = '".$this->headertext."', `header_color` = '".$this->header_color."', `header_font_color` = '".$this->header_font_color."', `header_font_size` = '".$this->header_font_size."', `background_color` = '".$this->background_color."', `font_size` = '".$this->font_size."', `font_color` = '".$this->font_color."', `text_align` = '".$this->text_align."' WHERE id_panel ='".$this->id_panel."';";

		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
    }
	
	function updatePanelLocation()
    {
		$sql="UPDATE `location` SET `percent_width` = '".$this->percent_width."', `height` = '".$this->height."', `percent_left_margin` = '".$this->percent_left_margin."', `top_margin` = '".$this->top_margin."' WHERE `id_panel` ='".$this->id_panel."';";

		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
    }
	
	
	function deletePanel($panelID){
		$sql = "UPDATE `panel` SET `active` = 0 WHERE id_panel='".$panelID."';";
		
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
	}
	
	function updateSliderheight($sliderheight){
		$sql="UPDATE `slider` SET `height`='".$sliderheight."';";
		
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
	}
	
	function getSliderheight(){
		$sql="SELECT `height` FROM slider;";
		
		$rs = $this->hDB->query($sql) or die ($this->hDB->error());
		$data = $rs->fetch_array();
		return $data['height'];
	}
	
	function getIdDiv() {
		return $this->id_panel;
	}
	
	function getHeight() {
		return $this->height;
	}
	
	function getPer_width() {
		return $this->percent_width;
	}
	
	function getTopm() {
		return $this->top_margin;
	}
	
	function getPer_leftm() {
		return $this->percent_left_margin;
	}
	
	function getBgcolor() {
		return $this->background_color;
	}
	
	function getFontsize() {
		return $this->font_size;
	}
	
	function getFontcolor() {
		return $this->font_color;
	}
	
	function getHeader() {
		return $this->headertext;
	}
	
	function getHeadercolor() {
		return $this->header_color;
	}
	
	function getHeaderfsize() {
		return $this->header_font_size;
	}
	
	function getHeaderfcolor() {
		return $this->header_font_color;
	}
	
	function getTextalign() {
		return $this->text_align;
	}
	
	function getActive() {
		return $this->active;
	}
	
	
	
	function setIdDiv($DivID) {
		$this->id_panel = $DivID;
	}
	
	function setHeight($height) {
		$this->height = $height;
	}
	
	function setPer_width($percent_width) {
		$this->percent_width = $percent_width;
	}
	
	function setTopm($top_margin) {
		$this->top_margin = $top_margin;
	}
	
	function setPer_leftm($percent_left_margin) {
		$this->percent_left_margin = $percent_left_margin;
	}
	
	function setBgcolor($background_color) {
		$this->background_color = $background_color;
	}
	
	function setFontsize($font_size) {
		$this->font_size = $font_size;
	}
	
	function setFontcolor($font_color) {
		$this->font_color = $font_color;
	}
	
	function setHeader($header) {
		$this->headertext = $header;
	}
	
	function setHeadercolor($header_color) {
		$this->header_color = $header_color;
	}
	
	function setHeaderfsize($header_font_size) {
		$this->header_font_size = $header_font_size;
	}
	
	function setHeaderfcolor($header_font_color) {
		$this->header_font_color = $header_font_color;
	}
	
	function setTextalign($text_align) {
		$this->text_align = $text_align;
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