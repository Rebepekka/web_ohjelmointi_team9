<?php
// Aloitetaan sessio
session_start();
// Jos ei ole kirjautunus, ohjataan kirjautumissivulle
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
include ("./connect.php"); // Linkki: luodaan yhteys.
// $initials=parse_ini_file("./.ht.settings.ini");
// Muodostetaan yhteys.
// $con=mysqli_connect($initials["host"], $initials["user"], $initials["pass"], $initials["name"]);
// if (mysqli_connect_errno()) {
// 	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
// }
// Haetaan käyttäjän tiedot tietokannasta.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// Haetaan tiedot id:llä
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link href="css/profilestyle.css" rel="stylesheet" type="text/css">
		<title>Profile Page</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body>
	<header></header>
			<div class="headline">
				<h1>Profile Page</h1>
			</div>
                <!-- Linkit uloskirjautumiseen ja etusivulle -->
<div class="container">
          <nav class="navbar navbar-expand-xl navbar-dark bg-black">        
            <div class="container-fluid">
              <ul class="navbar-nav mr-auto">  
                <li class="nav-item active">
                  <a class="nav-link" href="home.php" style="font-size: 19px; filter: brightness(95%);">HOME</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="otherusers.php" style="font-size: 19px; filter: brightness(95%);">OTHER USERS</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="logout.php" style="font-size: 19px; filter: brightness(85%); color: gold;">LOG OUT</a>
                </li>
              </ul>
            </div>
          </nav>

				<!--  Näytä Manage Users linkki vaan jos kirjautunut sisään pääkäyttäjällä Heta-->

					<?php // if (isAdmin()): ?> 

            <!-- <a href="manage_accounts.php"><i class="fas fa-user-cog"></i>Manage Users</a>   -->
			
                <?php // endif; ?> 

				<!-- <a href="home.php"><i class="fas fa-user-circle"></i>Home</a> -->
			
		

		<div class="content">
			<h2>Your account</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table><br>
				<div>
                    <!-- Päivitetään tiedot update_form.html -tiedostossa -->
				<a href="update_form.html"><i class="fas fa-user-edit"></i><strong>Update information</strong></a> 
				</div>
			</div>
		</div>
		</div>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
	</body>
</html>