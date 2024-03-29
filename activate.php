<?php
session_start();
include ("./connect.php"); // Linkki: luodaan yhteys.
// Tarkistetaan, onko sähköposti ja koodi olemassa
if (isset($_GET['email'], $_GET['code'])) {
	if ($stmt = $con->prepare('SELECT * FROM accounts WHERE email = ? AND activation_code = ?')) {
		$stmt->bind_param('ss', $_GET['email'], $_GET['code']);
		$stmt->execute();
        // Tallennetaan tulos (store_result), jotta voimme tarkistaa, onko tili tietokannassa.
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
            // Tili on olemassa pyydetyllä sähköpostiosoitteella ja koodilla.
            if ($stmt = $con->prepare('UPDATE accounts SET activation_code = ? WHERE email = ? AND activation_code = ?')) {
                // Aseta uudeksi aktivointikoodiksi "activated", näin voimme tarkistaa, onko käyttäjä aktivoinut tilinsä.
                $newcode = 'activated';
				$stmt->bind_param('sss', $newcode, $_GET['email'], $_GET['code']);
				$stmt->execute();
				echo 'Your account is now activated! You can now <a href="login.html">login</a>!';
			}
		} else {
			echo 'The account is already activated or doesn\'t exist!';
		}
	}
}  
// En tiiä tarviiko näitä
// Jos haluamme tarkistaa, onko käyttäjä aktivoinut tilinsä, voimme lisätä seuraavan koodin sivuille, joilla haluamme rajoittaa aktivoimattomia käyttäjiä:
if ($account['activation_code'] == 'activated') {

} else {

}
?>   