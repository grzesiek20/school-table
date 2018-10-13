<?php
require_once __DIR__."/class/userclass.php";
require_once __DIR__."/class/drawclass.php";
require_once __DIR__."/class/postclass.php";


$user = new user();
//$sdiv = new sdiv();
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
	// $sdiv->setContent($_POST['content']);
	// $sdiv->setBegdate($_POST['begdate']);
	// $sdiv->setEnddate($_POST['enddate']);
	// $sdiv->setVisible($_POST['visible']);
	// $sdiv->setActive(1);
	
	$post->setName($_POST['name']);
	$post->setSurname($_POST['surname']);
	$post->setHeader($_POST['header']);
	$post->setContent($_POST['content']);
	$post->setBegdate($_POST['begdate']);
	$post->setEnddate($_POST['enddate']);
	$post->setVisible($_POST['visible']);
	$post->setActive(1);

	
	// $wynik = $sdiv->searchSdivs();
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

			echo "<tr><td>".$wynik[$i]['content']."</td><td>".$wynik[$i]['begdate']."</td><td> ".$wynik[$i]['enddate']."</td><td> ".$wynik[$i]['name']." </td><td>".$wynik[$i]['surname']."</td><td> ".$wynik[$i]['header']."</td></tr>";
		}
echo '</table>';
	}else
		echo "Brak skojarzonych wyników";
		
}

if(isset($_POST['history']))
{
	$number->setNumber($_POST['number']);
	$number->setDrawn($_POST['drawn']);
	
	//$_POST['begdate']=$_POST['begdate']." 00:00:00";
	//$_POST['endate']=$_POST['enddate']." 00:00:00";
	
	$number->setBegdate($_POST['begdate']);
	$number->setEnddate($_POST['enddate']);
	
	$wynik = $number->searchNumbers();
	if(count($wynik)>0){
		for($i=0;$i<count($wynik);$i++){
			echo $wynik[$i]['number']." ".$wynik[$i]['date']."<br>";
		}
	}else
		echo "Brak skojarzonych wyników";
		
}

?>