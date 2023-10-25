<?php

function validSzig($param) {
    $pattern = "/[1-9]{1}[0-9]{5}[A-Za-z]{2}/";
    return preg_match($pattern, $param);
}

if (filter_input(INPUT_POST, "regisztraciosAdatok", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
    $error = false;
    $errormessage = "";
    $pass1 = filter_input(INPUT_POST, "InputPassword");
    $pass2 = filter_input(INPUT_POST, "InputPassword2");
    $username = htmlspecialchars(filter_input(INPUT_POST, "username"));
    $igazolvanyszam = filter_input(INPUT_POST, "szigszam");
    $felhasznalo_neve = htmlspecialchars(filter_input(INPUT_POST, "felhaszanlo_neve"));
    $emailcim = filter_input(INPUT_POST, "emailcim", FILTER_VALIDATE_EMAIL);
    if ($pass1 != $pass2) {
        $error = true;
        $errormessage .= '<p>Nem egyeznek a jelszavak!</p>';
    } else if ($username == null) {
        $error = true;
        $errormessage .= '<p>Nem megfelelő felhasználónév</p>';
    } else if (!$igazolvanyszam) {
        $error = true;
        $errormessage .= '<p>Az igazolványszám nem megfelelő formátumú</p>';
    }
    
    if ($error) {
        echo $errormessage;
    } else {
        //-- regisztrációs adatok kiírása
        $db->register($igazolvanyszam, $felhasznalo_neve, $emailcim, $username, $pass1);
        header("Location:index.php"); //-- átvált a nyitólapra
    }
}
?>
<div class="col-8 mt-4 mx-auto">
    <form action="#" method="post" class="row needs-validation" novalidate>
        <div class="mb-3">
            <label for="felhaszanlo_neve" class="form-label">Felhasználó teljes neve</label>
            <input type="text" class="form-control" id="felhaszanlo_neve" name="felhaszanlo_neve" minlength="3" maxlength="50" aria-describedby="felhaszanlo_neveHelp" required>
            <div id="felhasznalonevHelp" class="form-text">Ez szerepel majd az örökbefogadási szerződésen.</div>
            <div class="invalid-feedback">Kérem ellenőrízze a beírt nevet!</div>
        </div>
        <div class="row">
            <div class="mb-3 col-7 has-validation">
                <label for="emailcim" class="form-label">Email cím</label>
                <input type="email" class="form-control" id="emailcim" name="emailcim" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">Kapcsolattartási célból.</div>
                <div class="invalid-feedback">Email cím megadása nélkül nem tudjuk önnel felvenni a kapcsolatot!</div>
            </div>
            <div class="mb-3 col-auto">
                <label for="szigszam" class="form-label">Személyigazolvány száma:</label>
                <input type="text" class="form-control" id="szigszam" name="szigszam" pattern="[1-9]{1}[0-9]{5}[A-Za-z]{2}" aria-describedby="szigszamHelp" required>
                <div id="szigszamHelp" class="form-text">A pontos beazonosítás miatt.</div>
                <div class="invalid-feedback">Kérem ellenőrízze a beírt adatot! A személyigazolványszám helyes formátuma: 111111AA</div>
            </div>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Felhasználó név</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" required>
            <div id="usernameHelp" class="form-text">Bejelentkezéshez használt azonosító.</div>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="InputPassword" class="form-label">Jelszó</label>
                <input type="password" class="form-control" id="InputPassword" name="InputPassword" required>
            </div>
            <div class="mb-3 col-6">
                <label for="InputPassword2" class="form-label">Jelszó még egyszer</label>
                <input type="password" class="form-control" id="InputPassword2" name="InputPassword2" required>
            </div>
        </div>
        <button type="submit" class="col-2 mx-auto btn btn-outline-primary" name="regisztraciosAdatok" value="true">Regisztráció</button>
    </form>
</div>