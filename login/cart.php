<h2>Kosár tartalma</h2>
<?php
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            echo "<p>{$item['bicikli_id']} - {$item['markaneve']} - Gyártásiév:{$item['gyartasiev']} - Megjegyzes: {$item['megjegyzes']} - Nyilvantartasban: {$item['nyilvantartasban']} - Ár: {$item['ar']}</p>";
        }
    } else {
        echo "<p>A kosár üres</p>";
    }
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Kosárba'])) {
        $product_id = $_POST['bicikli_id'];
        $product_name = $_POST['markaneve'];
        $product_price = $_POST['ar'];

        // Kosárba adás: termék hozzáadása a kosárhoz
        $product = [
            'bicikli_id' => $product_id,
            'markaneve' => $product_name,
            'ar' => $product_price,
            'quantity' => 1 // Kezdetben minden termékből egy van a kosárban
        ];

        // Ellenőrizzük, hogy a termék már van-e a kosárban
        $product_already_in_cart = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] === $product_id) {
                $item['quantity']++; // Ha a termék már van a kosárban, növeljük a mennyiségét
                $product_already_in_cart = true;
                break;
            }
        }

        if (!$product_already_in_cart) {
            // Ha a termék még nem volt a kosárban, adjuk hozzá
            $_SESSION['cart'][] = $product;
        }
    }

    // Visszatérhet a terméklistára vagy a kívánt oldalra
    header("Location: index.php");
?>