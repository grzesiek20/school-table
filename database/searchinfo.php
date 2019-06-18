<?php
require_once __DIR__."/class/userclass.php";
require_once __DIR__."/class/drawclass.php";
require_once __DIR__."/class/postclass.php";


$user = new user();
//$message = new message();
$post = new search();
$number = new draw();
if(isset($_POST['search']))
{
	$user->setName($_POST['name']);
	$user->setSurname($_POST['surname']);
	
	$wynik = $user->getUserName();
	if(count($wynik)>0){
		for($i=0;$i<count($wynik);$i++){
			echo $wynik[$i]['name']." ".$wynik[$i]['surname']."<br>";
		}
	}else
		echo "Brak skojarzonych wyników";
		
}

if(isset($_POST['searchsdivs']))
{
	// $message->setContent($_POST['content']);
	// $message->setBegdate($_POST['begin_date']);
	// $message->setEnddate($_POST['end_date']);
	// $message->setVisible($_POST['visible']);
	// $message->setActive(1);
	
	$post->setName($_POST['name']);
	$post->setSurname($_POST['surname']);
	$post->setHeader($_POST['header']);
	$post->setContent($_POST['content']);
	$post->setBegdate($_POST['begin_date']);
	$post->setEnddate($_POST['end_date']);
	$post->setVisible($_POST['visible']);
	$post->setActive(1);

	
	// $wynik = $message->searchSdivs();
	 $wynik = $post->searchSdivs();
	if(count($wynik)>0){
		echo '<table class="table">';
		echo '<tr>';
		echo    '<th>Treść</th>';
		echo    '<th>Data początkowa</th>';
		echo    '<th>Data końcowa</th>';
		echo    '<th>Imię</th>';
		echo    '<th>Nazwisko</th>';
		echo    '<th>Nagłówek bloku</th>';
		echo  '</tr>';
		for($i=0;$i<count($wynik);$i++){

			echo "<tr><td>".$wynik[$i]['content']."</td><td>".$wynik[$i]['begin_date']."</td><td> ".$wynik[$i]['end_date']."</td><td> ".$wynik[$i]['name']." </td><td>".$wynik[$i]['surname']."</td><td> ".$wynik[$i]['header']."</td></tr>";
		}
echo '</table>';
	}else
		echo "Brak skojarzonych wyników";
		
}

if(isset($_POST['history']))
{
	$number->setNumber($_POST['number']);
	$number->setDrawn($_POST['drawn']);
	
	//$_POST['begin_date']=$_POST['begin_date']." 00:00:00";
	//$_POST['endate']=$_POST['end_date']." 00:00:00";
	
	$number->setBegdate($_POST['begin_date']);
	$number->setEnddate($_POST['end_date']);
	
	$wynik = $number->searchNumbers();
	if(count($wynik)>0){
		for($i=0;$i<count($wynik);$i++){
			echo $wynik[$i]['number']." ".$wynik[$i]['date']."<br>";
		}
	}else
		echo "Brak skojarzonych wyników";
		
}

?>