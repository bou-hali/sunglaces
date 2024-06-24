<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si le formulaire a été soumis avec succès
    $id = $_POST['idp'];
    $qte = $_POST['totalItems'];

    // Vérifie si la variable de session 'cart' est déjà définie
    if (isset($_SESSION["cart"])) {
        $found = false;
        // Vérifie si le produit existe déjà dans le panier
        foreach ($_SESSION["cart"] as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] += $qte; // Met à jour la quantité
                $found = true;
                break;
            }
        }
        if (!$found) {
            // Ajoute un nouveau produit au panier
            $_SESSION["cart"][] = array('id' => $id, 'quantity' => $qte);
        }
    } else {
        // Initialise le panier avec le premier produit
        $_SESSION["cart"] = array(array('id' => $id, 'quantity' => $qte));
    }
}

?>
