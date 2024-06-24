<?php
session_start();
$con = new mysqli("localhost", "root", "", "optitrend");

// Vérifier la connexion
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Gérer la soumission du formulaire
if (isset($_POST['submit_order'])) {
    // Valider et filtrer les données d'entrée
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));

    // Valider le format de l'e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Vérifier si un client avec le même e-mail existe déjà
    $stmt = $con->prepare("SELECT client_id FROM clients WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Un client avec le même e-mail existe déjà, gérer en conséquence (mettre à jour ou erreur)
        echo "Client with email already exists. Handle accordingly.";
    } else {
        // Insérer le nouveau client dans la table `clients`
        $stmt = $con->prepare("INSERT INTO clients (first_name, last_name, email, phone, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $address);

        if ($stmt->execute()) {
            $client_id = $stmt->insert_id; // Récupérer l'ID du client nouvellement inséré
            $stmt->close();

            // Continuer avec l'insertion de la commande dans la table `orders`
            $order_date = date("Y-m-d"); // Assurez-vous que la date est au bon format
            $status = "Pending"; // Statut initial de la commande

            // Récupérer le total_price à partir de la session
            if (isset($_SESSION['total_price'])) {
                $total_price = $_SESSION['total_price'];
            } else {
                $total_price = 0.00;
                echo "Total price is not set in the session. Defaulting to 0.00.";
            }

            echo "Total Price: $total_price"; // Debug: Afficher le total_price

            // Insérer la commande dans la table `orders`
            $stmt = $con->prepare("INSERT INTO orders (client_id, order_date, status, total_price, address) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issds", $client_id, $order_date, $status, $total_price, $address);

            // Insert order details
            if ($stmt->execute()) {
                $order_id = $stmt->insert_id; // Récupérer l'ID de la commande nouvellement insérée
                $stmt->close();

                // Prepare the statement for inserting order details
                $stmt = $con->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                if (!$stmt) {
                    die("Prepare failed: (" . $con->errno . ") " . $con->error);
                }

                // Debug: Print the contents of the cart
                echo "<pre>";
                print_r($_SESSION['cart']);
                echo "</pre>";

                foreach ($_SESSION['cart'] as $item) {
                    $product_id = $item['id'];
                    $quantity = $item['quantity'];
                    $price =  $_SESSION['price']; // Default to 0.00 if price is not set

                    // Bind parameters and execute statement
                    if (!$stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price)) {
                        die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
                    }

                    if (!$stmt->execute()) {
                        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
                    }
                }

                $stmt->close();

                // Clear the cart after successful order insertion
                unset($_SESSION['cart']);
                unset($_SESSION['total_price']);

                // Rediriger vers une page de confirmation ou afficher un message de succès
                header("Location: index.html");
                exit();
            } else {
                die("Order insertion failed: " . $stmt->error);
            }
        } else {
            die("Client insertion failed: " . $stmt->error);
        }
    }
    $stmt->close();
}
$con->close();
?>
