<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require_once __DIR__."/loggerclass.php";
class panel 
{
	private $id_panel;
	private $block_type;
	private $height;
	private $percent_width;
	private $top_margin;
	private $percent_left;
	private $background_color;
	private $font_size;
	private $font_color;
	private $header_text;
	private $header_color;
	private $header_font_size;
	private $header_font_color;
	private $text_align;
	private $active;
	
	private $hDB;
	
	function writeData() {
		$object = "Obiekt: Panel\nblock_type: ".$this->block_type."\nheight: ".$this->height;
		$object .= "\npercent_width: ".$this->percent_width."\n";
		$object .= "top_margin: ".$this->top_margin."\npercent_left: ".$this->percent_left."\nbackground_color: ".$this->background_color."\n";
		$object .= "font_size: ".$this->font_size."\nfont_color: ".$this->font_color."\nheader_text: ".$this->header_text."\n";
		$object .= "header_color: ".$this->header_color."\nheader_font_size: ".$this->header_font_size."\nheader_font_color: ".$this->header_font_color."\n";
		$object .= "text_align: ".$this->text_align."\nactive: ".$this->active;
		return $object;
	}
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
	
	function getDiv($panelID){
		$query = "SELECT * FROM `panel` WHERE id_panel=?;";

		$stmt = $this->hDB->prepare($query);

		$stmt->bind_param("i", $panelID);

		/* Execute the statement */
		$stmt->execute();

		$stmt->bind_result($id_panel, $block_type, $background_color, $font_size, $font_color, $header_text, $header_color, $header_font_size, $header_font_color, $text_align, $active);
		if($stmt->fetch()){
			$this->id_panel = $panelID;
			$this->block_type = $block_type;
			$this->background_color = $background_color;
			$this->font_size = $font_size;
			$this->font_color = $font_color;
			$this->header_text = $header_text;
			$this->header_color = $header_color;
			$this->header_font_size = $header_font_size;
			$this->header_font_color = $header_font_color;
			$this->text_align = $text_align;
			$this->active = $active;
		}
		$stmt->close();
	}
	
	function getAll() {
		$sql = "SELECT * FROM `panel` NATURAL JOIN `location` WHERE active=1";
		$info = array();
		//$stmt->execute();
		$rs = $this->hDB->query($sql);
		
		$i=0;
		
		while($data = $rs->fetch_array()){
			$info[$i]['id_panel'] = $data['id_panel'];
			$info[$i]['block_type'] = $data['block_type'];
			$info[$i]['height'] = $data['height'];
			$info[$i]['percent_width'] = $data['percent_width'];
			$info[$i]['top_margin'] = $data['top_margin'];
			$info[$i]['percent_left_margin'] = $data['percent_left_margin'];
			$info[$i]['background_color'] = $data['background_color'];
			$info[$i]['font_size'] = $data['font_size'];
			$info[$i]['font_color'] = $data['font_color'];
			$info[$i]['header_text'] = $data['header_text'];
			$info[$i]['header_color'] = $data['header_color'];
			$info[$i]['header_font_size'] = $data['header_font_size'];
			$info[$i]['header_font_color'] = $data['header_font_color'];
			$info[$i]['text_align'] = $data['text_align'];
			$info[$i]['active'] = $data['active'];
			$i++;
		}
		
		return $info;
	}

	function getCSSProperties() {
		$sql = "SELECT id_panel, block_type, height, percent_width, top_margin, percent_left, header_color, header_font_size, header_font_color, text_align, background_color, font_size, font_color, FROM `panel` NATURAL JOIN `location` WHERE active=1";
		$info = array();

		$rs = $this->hDB->query($sql);
		
		$i=0;
		
		while($data = $rs->fetch_array()){
			$info[$i]['id_panel'] = $data['id_panel'];
			$info[$i]['block_type'] = $data['block_type'];
			$info[$i]['height'] = $data['height'];
			$info[$i]['percent_width'] = $data['percent_width'];
			$info[$i]['top_margin'] = $data['top_margin'];
			$info[$i]['percent_left_margin'] = $data['percent_left_margin'];
			$info[$i]['background_color'] = $data['background_color'];
			$info[$i]['font_size'] = $data['font_size'];
			$info[$i]['font_color'] = $data['font_color'];
			$info[$i]['header_text'] = $data['header_text'];
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

		$query = "INSERT INTO `panel` (`block_type`, `header_text`,`header_color`,`header_font_color`,`header_font_size`,`background_color`,`font_size`,`font_color`) VALUES (?,?,?,?,?,?,?,?);";
		
		if($stmt = $this->hDB->prepare($query)) { // assuming $mysqli is the connection
			$stmt->bind_param("ssssisis", $this->block_type, $this->header_text, $this->header_color, $this->header_font_color, $this->header_font_size, $this->background_color, $this->font_size, $this->font_color);
			if($stmt->execute()) {
				Logger::wh_log(__METHOD__,"Success", "Poprawnie dodano panel:\n".$this->writeData());
			} else {
				Logger::wh_log(__METHOD__,"Error", "Panel nie został dodany:\n".$this->writeData());
				$error = $this->hDB->errno . ' ' . $this->hDB->error;
				Logger::wh_log(__METHOD__,"Error", $error);
				
			}
			// any additional code you need would go here.
		} else {
			$error = $this->hDB->errno . ' ' . $this->hDB->error;
			Logger::wh_log(__METHOD__,"Error", $error);
		}
		
		$stmt->close();
    }
	
	function updatePanel()
    {
		$query = "UPDATE `panel` SET `header_text` = ?, `header_color` = ?, `header_font_color` = ?, `header_font_size` = ?, `background_color` = ?, `font_size` = ?, `font_color` = ?, `text_align` = ? WHERE id_panel =?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("sssisissi", $this->header_text, $this->header_color, $this->header_font_color, $this->header_font_size, $this->background_color, $this->font_size, $this->font_color, $this->text_align, $this->id_panel);
		if($stmt->execute()) {
			Logger::wh_log(__METHOD__,"Success", "Poprawnie zaktualizowano panel:\n".$this->writeData());
		} else {
			Logger::wh_log(__METHOD__,"Error", "Panel nie został zaktualizowany:\n".$this->writeData());
			$error = $this->hDB->errno . ' ' . $this->hDB->error;
			Logger::wh_log(__METHOD__,"Error", $error);
			
		}
		$stmt->close();
    }
	
	function updatePanelLocation()
    {
		$query="UPDATE `location` SET `percent_width` = ?, `height` = ?, `percent_left_margin` = ?, `top_margin` = ? WHERE `id_panel` =?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("iiiii", $this->percent_width, $this->height, $this->percent_left_margin, $this->top_margin, $this->id_panel);
		$stmt->execute();
		$stmt->close();
    }
	
	
	function deletePanel($panelID){
		$query = "UPDATE `panel` SET `active` = 0 WHERE id_panel=?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("i", $panelID);
		$stmt->execute();
		$stmt->close();
	}
	
	function updateSliderheight($sliderheight){
		
		$query = "UPDATE `slider` SET `height`=?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("i", $sliderheight);
		$stmt->execute();
		$stmt->close();

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

	function getBlockType() {
		return $this->block_type;
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
		return $this->header_text;
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

	function setBlocktype($block_type) {
		$this->block_type = $block_type;
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
	
	function setHeader($header_text) {
		$this->header_text = $header_text;
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