<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Publiczna Szkoła Podstawowa</title>
	
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<link rel="stylesheet" href="../css/style.php">
	<link rel="stylesheet" href="../css/slider.css">
	<link rel="stylesheet" href="../css/fontello.css">
	<link rel="stylesheet" href="../css/material_design.min.css">
	
    <!--<link rel="stylesheet" href="https://cdn.rawgit.com/FezVrasta/bootstrap-material-design/4aad2fe4/dist/css/ripples.min.css">-->
	<!-- resizable-->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	

	<link href='http://fonts.googleapis.com/css?family=Lato|Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>					
					
</head>

<body>
	<div id="container" class="container">	
		<div class="col-md-8 col-md-offset-2">
			<div class="row">
				<div class="welcome panel panel-primary">	
					<div class="panel-heading">
							<h3>Wyszukiwarka użytkowników</h3>
					</div>		
							
				<div class="panel-body">	
				<div class="col-md-12">
					<div class="row">
							<form action="database/searchinfo.php" method="POST">
						<div class="col-md-5">
							<label for="name" class="control-label">Imię</label>
							<input type="text" class="form-control" name="name">
						</div>
						<div class="col-md-5">
							<label for="surname" class="control-label">Nazwisko</label>
							<input type="text" class="form-control" name="surname">
						</div>
						<div class="col-md-2">
							<input type="submit" class="btn" name="search" value="Szukaj">
						</div>
							</form>
					</div>
				</div>
				</div>	
				</div>
			</div>
			
			
			
			<div class="row">
				<div class="welcome panel panel-primary">	
					<div class="panel-heading">
							<h3>Wyszukiwarka wpisów</h3>
					</div>		
							
				<div class="panel-body">	
				<div class="col-md-12">
					<form action="database/searchinfo.php" method="POST">
					<div class="row">
						<div class="col-md-4">
							<label for="header" class="control-label">Nagłówek bloku</label>
							<input type="text" class="form-control" name="header">
						</div>
						<div class="col-md-4">
							<label for="name" class="control-label">Imię</label>
							<input type="text" class="form-control" name="name">
						</div>
						<div class="col-md-4">
							<label for="surname" class="control-label">Nazwisko</label>
							<input type="text" class="form-control" name="surname">
						</div>
					</div>
						<div class="row">
							<div class="col-md-7">
								<label for="content" class="control-label">Treść</label>
								<input type="text" class="form-control" name="content">
							</div>
						<div class="col-md-5">
							<div class="row">
								<div class="col-md-4">
									<input type="radio" value="1" class="form-control" id="visible" name="visible"><h6 class="section text-center">Wyświetlane</h6>
								</div>
								<div class="col-md-4">
									<input type="radio" value="0" class="form-control" id="invisible" name="visible"><h6 class="section text-center">Niewyświetlane</h6>
								</div>
								<div class="col-md-4">
									<input type="radio" value="2" class="form-control" id="active" name="visible" checked><h6 class="section text-center">Wszystkie</h6>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label for="begdate" class="control-label">Data rozpoczęcia wyświetlania</label>
							<input type="date" class="form-control" name="begdate">
						</div>
						<div class="col-md-4">
							<label for="enddate" class="control-label">Data zakończenia wyświetlania</label>
							<input type="date" class="form-control" name="enddate">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 pull-right">
							<input type="submit" class="btn" name="searchsdivs" value="Szukaj">
						</div>
					</div>
				</form>
					
				</div>
				</div>	
				</div>
			</div>


			<div class="row">
				<div class="welcome panel panel-primary">	
					<div class="panel-heading">
							<h3>Historia losowania</h3>
					</div>		
							
				<div class="panel-body">	
				<div class="col-md-12">
					<form action="database/searchinfo.php" method="POST">
						<div class="row">
							<div class="col-md-7">
								<label for="number" class="control-label">Liczba</label>
								<input type="number" class="form-control" name="number">
							</div>
						<div class="col-md-5">
							<div class="row">
								<div class="col-md-4">
									<input type="radio" value="1" class="form-control" id="drawn" name="drawn"><h6 class="section text-center">Wylosowane</h6>
								</div>
								<div class="col-md-4">
									<input type="radio" value="0" class="form-control" id="undrawn" name="drawn"><h6 class="section text-center">Niewylosowane</h6>
								</div>
								<div class="col-md-4">
									<input type="radio" value="2" class="form-control" id="active" name="drawn" checked><h6 class="section text-center">Wszystkie</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-7">
								<div class="col-md-6">
									<label for="begdate" class="control-label">Wylosowane w okresie</label>
									<input type="date" class="form-control" name="begdate">
									<span class="separator"> </span>
								</div>
								<div class="col-md-6">
								<label for="begdate" class="control-label">&ensp;</label>
									<input type="date" class="form-control" name="enddate">
									<span class="separator"> </span>
								</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 pull-right">
							<input type="submit" class="btn" name="history" value="Szukaj">
						</div>
					</div>
				</div>
				</form>
					</div>
				</div>	
			</div>
		</div>
	</div>
					
</body>
</html>