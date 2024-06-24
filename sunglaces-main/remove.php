<?php
session_start();

if (isset($_POST['remove']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Vérifiez si le panier existe et n'est pas vide
    if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
        // Parcourez le panier pour trouver et supprimer le produit
        foreach ($_SESSION["cart"] as $key => $item) {
            if ($item['id'] == $id) {
                unset($_SESSION["cart"][$key]);
                break;
            }
        }
        
        // Ré-indexe le tableau après la suppression
        $_SESSION["cart"] = array_values($_SESSION["cart"]);
    }
}

header("Location: cart.php"); // Redirige vers la page du panier après suppression
exit();
?>