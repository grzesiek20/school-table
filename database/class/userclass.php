<?php  error_reporting(E_ALL); ini_set('display_errors', 1);

class user
{
	private $id_user;
	private $name;
	private $surmane;
	private $login;
	private $password;
	
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
	
	function getUser($userID){
		$sql = "SELECT name, surname FROM `user` WHERE id_user='".$userID."';";
		
		$rs = $this->hDB->query($sql);
		
		$data = $rs->fetch_array();
			$this->id_user = $userID;
			$this->name = $data['name'];
			$this->surname = $data['surname'];
	}
	
	
	function checkUser(){
////////////////////NOT SECURE///////////////////////////
		// $sql = "SELECT id_user, name, surname FROM `user` WHERE login='".$this->login."' AND password=".$this->password.";";
		
		// $rs = $this->hDB->query($sql);
		// $ile = $rs->num_rows;
		// if($ile<0 || $ile >=0)
		// {
		// $data = $rs->fetch_array();
		// 	$_SESSION['id_user']= $data['id_user'];
		// 	$_SESSION['name'] = $data['name'];
		// 	$_SESSION['surname'] = $data['surname'];
		// 	$_SESSION['zalogowany'] = true;
		// 	 unset($_SESSION['blad']);
		// 	 header('Location: ../index.php');
		// 	 exit();
		// }
		// else {
		// 	 $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
		// 	 header('Location: ../view/login.php');
		// 	 exit();
		// }
//////////////////////////////////////////////////////////////////////
////////////////////////Parametrized//////////////////////////////////

$query = "SELECT id_user, name, surname FROM `user` WHERE login=? AND password=?;";
$stmt = $this->hDB->prepare($query);
$stmt->bind_param("ss", $this->login, $this->password);
$stmt->execute();
$ile = $stmt->num_rows;
$result = $stmt->get_result();

		if($stmt->num_rows == 0 )
		{
		$data = $result->fetch_array();
			$_SESSION['id_user']= $data['id_user'];
			$_SESSION['name'] = $data['name'];
			$_SESSION['surname'] = $data['surname'];
			$_SESSION['zalogowany'] = true;
			 unset($_SESSION['blad']);
			 header('Location: ../index.php');
			 exit;
		}
		else {
			 $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
			 header('Location: ../view/login.php');
			 exit;
		}
		$stmt->close();
////////////////////////////////Escape string/////////////////////////////////////////////////////
		

// $sql = "SELECT id_user, name, surname FROM `user` WHERE login='".mysqli_escape_string($this->hDB, $this->login)."' AND password=".mysqli_escape_string($this->hDB, $this->password).";";
		
// 		$rs = $this->hDB->query($sql);
// 		$ile = $rs->num_rows;
// 		if($ile>0)
// 		{
// 		$data = $rs->fetch_array();
// 			$_SESSION['id_user']= $data['id_user'];
// 			$_SESSION['name'] = $data['name'];
// 			$_SESSION['surname'] = $data['surname'];
// 			$_SESSION['zalogowany'] = true;
// 			unset($_SESSION['blad']);
// 			header('Location: ../index.php');
// 			exit;
// 		}
// 		else {
// 			$_SESSION['blad'] = '<span style="color:red">'.$someWord.'</span>';
// 			header('Location: ../view/login.php');
// 			exit;
// 		}
	}
	
	function getAll() {
		
		$sql = "SELECT id_user, name, surname FROM `user`;";
		$info = array();
		$rs = $this->hDB->query($sql);
		
		$i=0;
		
		while($data = $rs->fetch_array()){
			$info[$i]['id_user'] = $data['id_user'];
			$info[$i]['name'] = $data['name'];
			$info[$i]['surname'] = $data['surname'];
			
			$i++;
		}
		
		return $info;
	}
	
	function getIdUser() {
		return $this->id_user;
	}
	
	function getLogin() {
		return $this->login;
	}
	
	function getPassword() {
		return $this->password;
	}
	
	function getName() {
		return $this->name;
	}
	
	function getSurname() {
		return $this->surname;
	}
	
	
	
	function setIdUser($userID) {
		$this->id_user=$userID;
	}
	
	function setLogin($login) {
		$this->login=$login;
	}
	
	function setPassword($password) {
		$this->password=$password;
	}
	
	function setName($name) {
		$this->name=$name;
	}
	
	function setSurname($surname) {
		$this->surname=$surname;
	}
//--------------------------------------------- wyszukiwanie-------------------------------------------------------
	function getUserName(){
		$sql = "SELECT id_user ,name, surname FROM `user` WHERE name LIKE ('%".$this->name."%') AND surname LIKE ('%".$this->surname."%')";
		
		$rs = $this->hDB->query($sql);
		$ile = $rs->num_rows;
		if($ile>0)
		{
			$i=0;
		while($data = $rs->fetch_array()){
			$info[$i]['id_user'] = $data['id_user'];
			$info[$i]['name'] = $data['name'];
			$info[$i]['surname'] = $data['surname'];
			
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