<h1>Ajánlataink a biciklikről</h1>
<p>Ezek a járművek amit ajánalni tuduk és segíteni azoknak akik nem tudják milyen biciklit is akarnak és típust.</p>
<div class="row">
    <?php
    foreach ($db->osszesBicikli() as $row) {
        $image = null;
        if (file_exists("./kepek/" . $row['markaneve'] . ".jpg")) {
            $image = "./kepek/" . $row['markaneve'] . ".jpg";
        } else if (file_exists("./kepek/" . $row['markaneve'] . ".jpeg")) {
            $image = "./kepek/" . $row['markaneve'] . ".jpeg";
        } else if (file_exists("./kepek/" . $row['markaneve'] . ".png")) {
            $image = "./kepek/" . $row['markaneve'] . ".png";
        } else if (file_exists("./kepek/" . $row['markaneve'] . ".png")) {
            $image = "./kepek/" . $row['markaneve'] . ".png";
        } else if (file_exists("./kepek/" . $row['markaneve'] . ".png")) {
            $image = "./kepek/" . $row['markaneve'] . ".png";
        } else if (file_exists("./kepek/" . $row['markaneve'] . ".png")) {
            $image = "./kepek/" . $row['markaneve'] . ".png";
        } else {
            $image = "./images/Nincskep.jpg";
        }
        $card = '<div class="card" style="width: 18rem;">
                    <img src="'.$image.'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Márkaneve: ' . $row['markaneve'] . '</h5>' .
                '<p class="card-text">Gyártasiév: ' . $row['gyartasiev'] . '</p>' .
                '<p class="card-text">Nálunk: ' . $row['nyilvantartasban'] . '</p>' .
                '<p class="card-text">Megjegyzés: ' . $row['megjegyzes'] . '</p>' .
                '<p class="card-text">Ár: ' . $row['ar'] . '</p>' .
                '<a href="index.php?menu=home&id=' . $row['bicikli_id'] . '" class="btn btn-dark">Kiválaszt</a>
                    </div>
                </div>
            ';
        echo $card;
    }
    ?>
</div>