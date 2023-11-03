<?php
if (filter_input(INPUT_POST, "Adatmodositas", FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE)) {
    $adatok = $_POST;
    var_dump($adatok);
    $bicikli_id = filter_input(INPUT_POST, "bicikli_id", FILTER_SANITIZE_NUMBER_INT);
    $markaneve = htmlspecialchars(filter_input(INPUT_POST, "markaneve"));
    $tipus = filter_input(INPUT_POST, "tipusSelect");
    $gyartasiev = filter_input(INPUT_POST, "gyartasiev");
    $megjegyzes = filter_input(INPUT_POST, "megjegyzes");
    $nyilvantartasban = filter_input(INPUT_POST, "nyilvantartasban");
    $from = null;
    $to = null;
    if ($_FILES['kepfajl']['error'] == 0) {
        $kiterjesztes = null;
        switch ($_FILES['kepfajl']['type']) {
            case 'image/png':
                $kiterjesztes = ".png";
                break;
            case 'image/jpeg':
                $kiterjesztes = ".jpg";
                break;
            default:
                break;
        }
        $from = $_FILES['kepfajl']['tmp_name'];
        $to = dir(getcwd());
        $to = $to->path . DIRECTORY_SEPARATOR . "kepek" . DIRECTORY_SEPARATOR . $markaneve . $kiterjesztes;
        if (copy($from, $to)) {
            echo '<p>A kép feltöltés sikeres</p>';
        } else {
            echo '<p>A kép feltöltés sikertelen!</p>';
        }
    }
    if ($db->setKivalasztottkerekpar($bicikli_id, $markaneve, $tipus, $gyartasiev, $megjegyzes, $nyilvantartasban)) {
        echo '<p>Az adatok módosítása sikeres</p>';
        header("Location: index.php?menu=home");
    } else {
        echo '<p>Az adatok módosítása sikertelen!</p>';
    }
} else {
    $adatok = $db->getKivalasztottkerekpar($id);
}
?>
<!--<!-- array (size=8)
  'allatid' => string '7' (length=1)
  'allat_neve' => string 'Gazsi' (length=5)
  'faj' => string 'kutya' (length=5)
  'fajta' => string 'Mobsz' (length=5)
  'szuletesi_ido' => string '2021-01-11' (length=10)
  'nem' => string 'szuka' (length=5)
  'megjegyzes' => string 'csinos' (length=6)
  'nyilvantartasban' => string '2023-05-10' (length=10) -->
<form method="post" action="index.php?menu=home&id=<?php echo $adatok['bicikli_id']; ?>" enctype="multipart/form-data">
    <input type="hidden" name="bicikli_id" value="<?php echo $adatok['bicikli_id']; ?>">
    <div class="mb-3">
        <label for="markaneve" class="form-label">Márka neve</label>
        <input type="text" class="form-control" name="markaneve" id="markaneve" value="<?php echo $adatok['markaneve']; ?>">
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="tipusSelect" class="form-label">Tipus</label>
            <select id="tipusSelect" name="fajtaSelect" class="form-select">
                <?php
                foreach ($db->getTipus() as $value) {
                    if ($adatok['tipus'] == $value[0]) {
                        echo '<option selected value="' . $value[0] . '">' . $value[0] . '</option>';
                    } else {
                        echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="gyartasiev" class="form-label">Gyártási év:</label>
            <input type="date" class="form-control" name="gyartasiev" id="gyartasiev" max="<?php echo date("Y-m-d"); ?>" value="<?php echo $adatok['gyartasiev']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="nyilvantartasban" class="form-label">Nyilvántartásba vétel</label>
            <input type="date" class="form-control" name="nyilvantartasban" id="gyartasiev" max="<?php echo date("Y-m-d"); ?>"  value="<?php echo $adatok['gyartasiev']; ?>">
        </div>
        <div class="mb-3 col-6">
            <label for="megjegyzes" class="form-label">Megjegyzés</label>
            <input type="text" class="form-control" name="megjegyzes" id="megjegyzes" value="<?php echo $adatok['megjegyzes']; ?>">
        </div>

    </div>
    <div class="row">
        <div class="mb-3 col-4">
            <label for="kepfajl" class="form-label">Képfájl</label>
            <input type="file" class="form-control" name="kepfajl" id="kepfajl" value="">
        </div>

    </div>
    <button type="submit" class="btn btn-info" value="1" name="Adatmodositas">Módosítás</button>
    <a href="index.php?menu=felhasznalo&bicikli_id=<?php echo $adatok['bicikli_id'];?>" class="btn btn-dark">Megvásárlom</a>
</form>
<?php ?>