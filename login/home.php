<div class="row">
    <?php
    foreach ($db->osszesBicikli() as $row) {
        $image = null;
        if (file_exists("./kepek/elektromos" . $row['markaneve'] . ".jpg")) {
            $image = "./kepek/elektromos" . $row['markaneve'] . ".jpg";
        } else if (file_exists("./kepek/fatbike" . $row['markaneve'] . ".jpeg")) {
            $image = "./kepek/fatbike" . $row['markaneve'] . ".jpeg";
        } else if (file_exists("./kepek/kemping" . $row['markaneve'] . ".png")) {
            $image = "./kepek/kemping" . $row['markaneve'] . ".png";
        } else if (file_exists("./kepek/MTB" . $row['markaneve'] . ".png")) {
            $image = "./kepek/MTB" . $row['markaneve'] . ".png";
        } else if (file_exists("./kepek/orszaguti" . $row['markaneve'] . ".png")) {
            $image = "./kepek/orszaguti" . $row['markaneve'] . ".png";
        } else if (file_exists("./kepek/varosi" . $row['markaneve'] . ".png")) {
            $image = "./kepek/varosi" . $row['markaneve'] . ".png";
        } else {
            $image = "./images/Nincskep.jpg";
        }
        $card = '<div class="card" style="width: 18rem;">
                    <img src="'.$image.'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $row['markaneve'] . '</h5>' .
                '<p class="card-text">gyártasiév: ' . $row['gyartasiev'] . '</p>' .
                '<p class="card-text">nálunk: ' . $row['nyilvantartasban'] . '</p>' .
                '<p class="card-text">' . $row['megjegyzes'] . '</p>' .
                '<a href="index.php?menu=home&id=' . $row['bicikli_id'] . '" class="btn btn-dark">Kiválaszt</a>
                    </div>
                </div>
            ';
        echo $card;
    }
    ?>
</div>