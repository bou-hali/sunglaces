<?php
// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "optitrend");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Requête pour récupérer les chemins d'images
$req1 = mysqli_query($con, "SELECT path_image FROM product_images");
if ($req1) {
    while ($res = mysqli_fetch_array($req1)) {
        echo $res['path_image'] . "<br>";
    }
} else {
    echo "Error: " . mysqli_error($con);
}

// Fermeture de la connexion à la base de données
mysqli_close($con);
?>
