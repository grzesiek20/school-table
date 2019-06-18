<?php
 error_reporting(E_ALL); ini_set('display_errors', 1);
 require_once __DIR__."/loggerclass.php";
 require_once __DIR__."/validator.php";
 
class user
{
	private $id_user;
	private $name;
	private $surmane;
	private $role;
	private $login;
	private $password;
	
	private $hDB;
	
	function writeData() {
		$object = "Obiekt: User\nid_user: ".$this->id_user."\nname: ".$this->name."\nsurname: ".$this->surname."\n";
		$object .= "role: ".$this->role."\nlogin: ".$this->login."\npassword: ".$this->password."\n";
		return $object;
	}

	public function __construct(){
		require __DIR__. "/../connect.php";

		
		if (session_status() == PHP_SESSION_NONE) 
		{
			//$logger = new Logger();
			session_start();
			Logger::wh_log(__METHOD__,"Info","Zainicjalizowano sesję");
		}		
		//Tworzy uchwyt połączenia
		$this->hDB = new mysqli($host,$db_user,$db_password);
		mysqli_set_charset($this->hDB, "utf8");
		//sprawdzamy polaczenie
		if (mysqli_connect_errno()) {
			Logger::wh_log(__METHOD__,"Error",printf("Connect failed: %s\n", mysqli_connect_error()));
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		if (!$this->hDB->select_db($db_name)) {
			echo "Nie udało się wybrać bazy danych";
			// $logger = new Logger();
			Logger::wh_log(__METHOD__,"Error","Nie udało się wybrać bazy danych! Sprawdź parametry połączenia");
			$error = $this->hDB->errno . ' ' . $this->hDB->error;
			Logger::wh_log(__METHOD__,"Error", $error);
		}
		
		$this->hDB->select_db($db_name);
		
	}
	
	function getUser($userID){

		$query = "SELECT name, surname FROM `user` WHERE id_user=?";

		$stmt = $this->hDB->prepare($query);

		$stmt->bind_param("i", $userID);

		/* Execute the statement */
		$stmt->execute();

		$stmt->bind_result( $name, $surname);
		if($stmt->fetch()){
			$this->id_user = $userID;
			$this->name = $name;
			$this->surname = $surname;
		}
		$stmt->close();
	}
	
	
	function checkUser(){
		$logger = new Logger();
		unset($_SESSION['blad']);
		if (!isset($_SESSION['wronglogins'])) {
			$_SESSION['wronglogins'] = 0;
		}

////////////////////////Parametrized//////////////////////////////////
$query="SELECT `salt`, `active` FROM `user` WHERE `login`=?;";
$stmt = $this->hDB->prepare($query);
$stmt->bind_param("s", $this->login);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows == 1) {
	$row = $result->fetch_array();
	if($row['active'] ==1) {
		Logger::wh_log(__METHOD__,"Info", "Pobrano sól dla użytkownika\nlogin: ".$this->login);
		$password = md5($_POST['password'].$row['salt']);

		$query = "SELECT `id_user`, `name`, `surname`, `id_role` FROM `user` WHERE `login`=? AND `password`=?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("ss", $this->login, $password);
		$stmt->execute();
		$result = $stmt->get_result();
		
				if($result && $result->num_rows == 1)
				{
				$data = $result->fetch_array();
					$salt = substr(md5(rand()), 0, 7);
					$_SESSION['id_user']= $data['id_user'];
					$_SESSION['username'] = $data['name'];
					$_SESSION['usersurname'] = $data['surname'];
					$_SESSION['role'] = $data['id_role'];
					$_SESSION['login'] = $this->login;
					$_SESSION['zalogowany'] = md5($this->login.$salt);
					setcookie('user', md5($this->login.$salt),time() + (86400 * 30),'/');
		
					unset($_SESSION['blad']);
					unset($_SESSION['wronglogins']);
					Logger::wh_log(__METHOD__,"Success","login: ".$this->login." poprawne logowanie!");
					header('Location: ../index.php');
					exit;
					
				}
				else {
					$_SESSION['wronglogins'] +=1;
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					Logger::wh_log(__METHOD__,"Error","login: ".$this->login." niepoprawna autentykacja!");
					$error = $this->hDB->errno . ' ' . $this->hDB->error;
					Logger::wh_log(__METHOD__,"Error", $error);
					header('Location: ../view/login.php');
					exit;
				}
	} else {
		$_SESSION['blad'] = '<span style="color:red">Błąd autentykacji!</span>';
		$logger->wh_log(__METHOD__,"Error","Użytkownik: ".$this->login." jest zablokowany!");
		header('Location: ../view/login.php');
		exit;
	}
} else {
	$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
	$_SESSION['wronglogins'] +=1;
	Logger::wh_log(__METHOD__,"Error","login: ".$this->login." nie istnieje w bazie danych!");
	$error = $this->hDB->errno . ' ' . $this->hDB->error;
	Logger::wh_log(__METHOD__,"Error", $error);
		header('Location: ../view/login.php');
		exit;
}

$stmt->close();
	}

	function addUser() {
		$validator = new validator();
		$logger = new Logger();
		$query = "SELECT id_role FROM `role` WHERE role_name =?";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("s", $this->role);
		if($stmt->execute()) {
			$result = $stmt->get_result();
			$row = $result->fetch_array();
			$this->role = $row['id_role'];
			$logger->wh_log(__METHOD__, "Info", "Pobrano id roli: ".$row['id_role']);
		} else {
			$logger->wh_log(__METHOD__, "Info", "Wybrana rola nie istnieje w bazie: ".$this->role);
		}
		if ($validator->checkNumber($this->role)) {
			$salt = substr(md5(rand()), 0, 7);
			$password = md5($this->password.$salt);
			$query = "INSERT INTO `user`(`name`, `surname`,`id_role`, `login`, `password`, `salt`) VALUES (?,?,?,?,?,?)";
			$stmt = $this->hDB->prepare($query);
			$stmt->bind_param("ssisss", $this->name, $this->surname, $this->role, $this->login, $password, $salt);
			if($stmt->execute()) {
				$message = "Użytkownik ".$this->login." utworzony pomyślnie!\n";
				$message .= "Login: ".$this->login."\nImię: ".$this->name."\nNazwisko: ".$this->surname."\n";
				$message .= "Rola: ".$this->role;
				$message_type = "Success";
			} else {
				$message = "Użytkownik ".$this->login." nie został utworzony\n";
				$message .= "Login: ".$this->login."\nImię: ".$this->name."\nNazwisko: ".$this->surname."\n";
				$message .= "Rola: ".$this->role;
				$message_type = "Error";
				$error = $this->hDB->errno . ' ' . $this->hDB->error;
				Logger::wh_log(__METHOD__,"Error", $error);
			}
			Logger::wh_log(__METHOD__,$message_type,$message);
			$result = $stmt->get_result();
			unset($_SESSION['blad']);
		}
	}

	function updateLoggedUser() {
		$validator = new validator();
		$logger = new Logger();

		$query="SELECT `id_user` FROM `user` WHERE `login`=?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("s", $this->login);
		if($stmt->execute()) {
			$result = $stmt->get_result();
			if ($result && $result->num_rows == 1) {
				$row = $result->fetch_array();
				$this->setIdUser($row['id_user']);
				$query="UPDATE `user` SET `name` = ?, `surname`=? WHERE `id_user`=? AND `login`=?;";
				$stmt = $this->hDB->prepare($query);
				$stmt->bind_param("ssis", $this->name, $this->surname, $this->id_user, $this->login);
				if($stmt->execute()) {
					$_SESSION['username'] = $this->name;
					$_SESSION['usersurname'] = $this->surname;

				} else {
					$error = $this->hDB->errno . ' ' . $this->hDB->error;
					$logger->wh_log(__METHOD__,"Error", $error);
				}
			}
		}

	}
	
	function checkOldPassword($password){
		$query="SELECT `password`, `salt` FROM `user` WHERE `login`=?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("s", $this->login);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result && $result->num_rows == 1) {
			$row = $result->fetch_array();
			if (md5($password.$row['salt'])==$row['password']){
				return true;
			} else {
				return false;
			}

		}
	}

	function changePassword() {
		$logger = new Logger();
		$salt = substr(md5(rand()), 0, 7);
		$logger->wh_log(__METHOD__, "Info", $salt." ".$this->password);
		$newPassword = md5($this->password.$salt);

		$query="UPDATE `user` SET `password`=?, `salt`=? WHERE `login`=?;";
		$stmt = $this->hDB->prepare($query);
		$stmt->bind_param("sss", $newPassword, $salt, $this->login);
		if($stmt->execute()) {
			$logger->wh_log(__METHOD__,"Success","Hasło zostało zmienione!");
		} else {
			$logger->wh_log(__METHOD__,"Error","Hasło nie zostało zmienione!");
			$error = $this->hDB->errno . ' ' . $this->hDB->error;
			$logger->wh_log(__METHOD__,"Error", $error);
		}


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

	function getRole() {
		return $this->role;
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

	function setRole($role) {
		$this->role=$role;
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

	function cryptPassword($data, $key, $decrypt = false) {
		$td = mycrypt_module_open('tripledes', '','ecb','');
		$iv = mycrypt_create_iv(mycrypt_enc_get_iv_size($td), MCRYPT_RAND);
		mcrypt_generic_init($td, $key, $iv);
		if($decrypt) {
			$output = mdecrypt_generic($td, base64_decode($data));
		} else {
			$output = base64_encode(mcrypt_generic($td, $data));
		}
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		return $output;
	}
 }
?>