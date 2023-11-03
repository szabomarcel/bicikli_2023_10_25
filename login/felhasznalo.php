<h1>Megvásárolt bicikli</h1>
<?php
var_dump($_SESSION);
/*$userid = $_SESSION['users']['userid'];
$bicikli_id = filter_input(INPUT_GET, "bicikli_id");
//$allat = $db->getKivalaszt_idottkerekpar($bicikli_id);
if (filter_input(INPUT_POST, "kerékpár", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
    $bicikli_id = filter_input(INPUT_POST, "bicikli_id", FILTER_VALIDATE_INT);
    $userid = $_SESSION['users']['userid'];
    echo 'rögzités';
    if ($db->setOrokbefogadas($bicikli_id, $userid)) {
        header("Location: index.php?menu=home");
    } else {
        echo 'Sikertelen rögzítés!';
    }
}*/
//var_dump($allat);
//echo '<p>Valóban szeretné a ' . $allat['markanev'] . ' nevű kerékpárt?</p>';
//INSERT INTO `biciklivetel` (`bicikli_tid`, `userid`) VALUES ('3', '1');
if (isset($_SESSION['users']) && isset($_SESSION['users']['userid'])) {
    $userid = $_SESSION['users']['userid'];
    
    // Further code...

    if (filter_input(INPUT_POST, "biciklivetel", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
        // Your processing code...
        $bicikli_id = filter_input(INPUT_POST, "bicikli_id", FILTER_VALIDATE_INT);
        $userid = $_SESSION['users']['userid'];
        echo 'rögzités';
        
        // Assuming $db represents your database object
        if ($db->setOrokbefogadas($bicikli_id, $userid)) {
            header("Location: index.php?menu=home");
        } else {
            echo 'Sikertelen rögzítés!';
        }
    }else{
        // Handle the situation if 'users' or 'userid' is not set in the session
        // For example, redirect to the login page
        header("Location: login.php");
        exit(); // Stop script execution
    }
}
?>
<form method="POST" action="index.php">
    <input type="hidden" name="userid" value="<?php echo $_SESSION['users']['userid'] ?? ''; ?>">
    <input type="hidden" name="bicikli_id" value="<?php echo $bicikli_id ?? ''; ?>">
    <button type="submit" class="btn btn-danger" name="biciklivetel" value="1">Igen</button>
    <a href="index.php" class="btn btn-light">Mégse</a>
</form>