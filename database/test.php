<?php
$mysqli = new mysqli("localhost", "root", "", "db2");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

//$mysqli->query("CREATE TABLE myCity LIKE City");

/* Prepare an insert statement */
$query = "INSERT INTO slider (id_slider, height) VALUES (?,?)";
$stmt = $mysqli->prepare($query);

$stmt->bind_param("ii", $val1, $val2);

$val1 = 30;
$val2 = 100;
//$val3 = 'Baden-Wuerttemberg';

/* Execute the statement */
$stmt->execute();

$val1 = 40;
$val2 = 200;

/* Execute the statement */
$stmt->execute();

/* close statement */
$stmt->close();

/* retrieve all rows from myCity */
$query = "SELECT id_slider, height FROM slider WHERE id_slider=;";
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_row()) {
        printf("%s (%s)\n", $row[0], $row[1]);
    }
    /* free result set */
    $result->close();
}

/* remove table */
//$mysqli->query("DROP TABLE myCity");

/* close connection */
$mysqli->close();
// $link = mysqli_connect('localhost', 'root', '', 'db2');

// /* check connection */
// if (!$link) {
//     printf("Connect failed: %s\n", mysqli_connect_error());
//     exit();
// }

// $stmt = mysqli_prepare($link, "INSERT INTO slider VALUES (?, ?)");
// mysqli_stmt_bind_param($stmt, 'ii', $code, $language);

// $code = 6;
// $language = 17;
// $official = "F";
// $percent = 11.2;

// /* execute prepared statement */
// mysqli_stmt_execute($stmt);

// //printf("%d Row inserted.\n", mysqli_stmt_affected_rows($stmt));

// /* close statement and connection */
// mysqli_stmt_close($stmt);

// /* Clean up table CountryLanguage */
// //$idSlider = ";update slider set height = 20;";
// //$height = 16;
// //mysqli_query($link, "DELETE FROM slider WHERE height=".$height." and id_slider=".$idSlider);
// //printf("%d Row deleted.\n", mysqli_affected_rows($link));

// $stmt2 = mysqli_prepare($link, "SELECT * FROM `slider` WHERE height= ?;");
// mysqli_stmt_bind_param($stmt2, 'i', $height);
// $height = 341;
// $id2=1;
// $bool = mysqli_stmt_execute($stmt2);
// $result = mysqli_stmt_fetch($stmt2);
// //$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
// //printf ("%s (%s)\n",$row["Lastname"],$row["Age"]);


// echo $bool;
// /* close connection */
// mysqli_close($link);
?>