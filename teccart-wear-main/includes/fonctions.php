<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

function connexionDB()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "TeccartWear";
    $dbport = 3306;
    $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
    if (!$conn) {
        die("Error during connection => " . mysqli_connect_error());
    }
    return $conn;
}

//Function to connect to the database
function authentification($email, $mot_de_passe)
{
    $conn = connexionDB();
    $sql = "SELECT * FROM  Utilisateur wHERE email =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $utilisateur = $stmt->get_result();

    if ($utilisateur->num_rows >= 1) {
        $utilisateur = $utilisateur->fetch_assoc();
        if (password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            $_SESSION['utilisateur'] = $utilisateur['id'];
            $_SESSION['user_id'] = $utilisateur['id'];
            $_SESSION['utilisateur_nom'] = $utilisateur['nom'];
            $_SESSION['utilisateur_add'] = $utilisateur['addresse'];
            $_SESSION['utilisateur_email'] = $utilisateur['email'];
            $_SESSION['utilisateur_pscode'] = $utilisateur['postal_code'];
            $_SESSION['utilisateur_prenom'] = $utilisateur['prenom'];
            $_SESSION['roleU'] = $utilisateur['roleU'];
            header('Location: ./home.php');
        } else {
            echo "Email or password Incorrect. Try again!!";
        }
    } else {
        echo "User Not Found";
    }
}

//Function to register user
function register($nom, $prenom, $email, $date_naissance, $mot_de_passe)
{
    $mot_de_passe = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    $conn = connexionDB();
    $sql = "INSERT INTO Utilisateur(nom,prenom,email,mot_de_passe,date_naissance,roleU)
    VALUES (?,?,?,?,?,?)";
    $user = "Client";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nom, $prenom, $email, $mot_de_passe, $date_naissance, $user);
    $result = $stmt->execute();
    if ($result) {
        header('Location: ./connexion.php');
    } else {
        echo "An error occured";
    }
}

function UpdateUser($id, $nom, $prenom, $email, $addresse, $postal_code, $date_naissance, $roleU)
{
    $conn = connexionDB();
    $sql = "UPDATE Utilisateur SET nom=?, prenom=?, email=?, addresse=?, postal_code=?, date_naissance=?, roleU=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $nom, $prenom, $email, $addresse, $postal_code, $date_naissance, $roleU, $id);
    $result = $stmt->execute();
    if ($result) {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
        header('Location: ./manageUsers.php');
    } else {
        echo "An error occurred";
    }
}

function UpdateOwnUser($id, $nom, $prenom, $email, $addresse, $postal_code, $date_naissance)
{
    $conn = connexionDB();
    $sql = "UPDATE Utilisateur SET nom=?, prenom=?, email=?, addresse=?, postal_code=?, date_naissance=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nom, $prenom, $email, $addresse, $postal_code, $date_naissance, $id);
    $result = $stmt->execute();
    if ($result) {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
        header('Location: ./myProfile.php');
    } else {
        echo "An error occurred";
    }
}


//function to modify password
function UpdatePassword($id, $mot_de_passe)
{
    $mot_de_passe = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    $conn = connexionDB();
    $sql = "UPDATE Utilisateur SET mot_de_passe=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $mot_de_passe, $id);
    $result = $stmt->execute();
    if ($result) {
        header('Location: ./myProfile.php');
    } else {
        echo "An error occured";
    }
}


//--------------------------------------USERS--------------------------------------------

//Function getallUsers
function getAllUsers()
{
    $conn = connexionDB();
    $sql = "SELECT * FROM Utilisateur;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultats = $stmt->get_result();
    $users = array();
    foreach ($resultats as $user) {
        $users[] = $user;
    }
    return $users;
}

//Function get userbyId
function getUserById($id)
{
    $conn = connexionDB();
    $sql = "SELECT * FROM Utilisateur where id=?; ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    return $user;
}

//Function to update user by id



//Function to delete user by id
function deleteUser($id)
{
    $conn = connexionDB();

    $user = getUserById($id);
    if ($user) {

        $sql = 'DELETE FROM Utilisateur where id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        if ($result) {
            header('Location: ./manageUsers.php');
            exit();
        } else {
            echo "An error occured";
        }
    } else {
        echo "User not found";
    }
}

//--------------------------------------PRODUCTS--------------------------------------------

//Function to add product
function addProduct($nom, $prix, $taille, $couleur, $quantite, $item_description = "", $chemin = "")
{
    $conn = connexionDB();
    $sql = "Insert into Produit (nom, prix, taille, couleur, quantite, item_description) values (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssis", $nom, $prix, $taille, $couleur, $quantite, $item_description);
    $result = $stmt->execute();
    $id_produit = $conn->insert_id;
    $stmt->close();
    $conn->close();
    if ($result) {
        if (!empty($chemin)) {
            insertImage($id_produit, $chemin);
        }
        header('Location: ./manageProduct.php');
        exit();
    } else {
        echo "Error adding product";
    }
    $stmt->close();
    $conn->close();
}
//Function to get all products
function getAllProducts()
{
    $conn = connexionDB();
    $sql = "SELECT p.id, p.nom,p.item_description,p.prix,p.taille,p.couleur,p.quantite, i.chemin FROM produit p 
    JOIN Images i ON p.id = i.id_produit; ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultats = $stmt->get_result();
    $products = array();
    foreach ($resultats as $product) {
        $products[] = $product;
    }
    return $products;
}

//Function to get product by id
function getProductById($id)
{
    $conn = connexionDB();
    $sql = "SELECT p.id, p.nom,p.item_description,p.prix,p.taille,p.couleur,p.quantite, i.chemin FROM produit p 
    JOIN Images i ON p.id = i.id_produit where p.id=?; ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_assoc();
    return $products;
}


//Function to delete product by id
function deleteProductById($id)
{
    $conn = connexionDB();

    $product = getProductById($id);
    if ($product) {

        $sql = 'DELETE FROM Produit where id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        if ($result) {
            header('Location: ./manageProduct.php');
            exit();
        }
    } else {
        echo "Erreur while deleting";
    }
}

//Function to modify product by id
function modifyProduct($id, $nom, $prix, $taille, $couleur, $quantite, $item_description)
{
    $conn = connexionDB();
    $sql = "update Produit set nom=?, prix=?, taille=?, couleur=?, quantite=?, item_description=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssisi", $nom, $prix, $taille, $couleur, $quantite, $item_description, $id);
    $result = $stmt->execute();
    if ($result) {
        header('Location: ./manageProduct.php');
        exit();
    } else {
        echo "Error modifying product";
    }
    $stmt->close();
    $conn->close();
}

//--------------------------------------CART--------------------------------------------

function addCart($id, $quantite, $ishome = true)
{
    $_SESSION['cart'][$id] = $quantite;
    if ($ishome) {
        header('Location: ./Products.php');
        exit();
    } else {
        header('Location: ./myCart.php');
        exit();
    }
}
function qteCart()
{
    $countElmnt = count($_SESSION['cart']);
    return $countElmnt;
}
function getAllCart()
{
    return $_SESSION['cart'];
}

function emptyCart()
{
    unset($_SESSION['cart']);
    header('Location: ./success.php');
    exit();
}

//--------------------------------------IMAGES--------------------------------------------

function insertImage($id_produit, $chemin)
{
    $conn = connexionDB();
    $sql = "INSERT INTO Images(id_produit,chemin) values(?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $id_produit, $chemin);
    $resultat = $stmt->execute();
    if ($resultat) {
        // header("Location: ./manageProduct.php");
    } else {
        echo "An error occurred";
    }
}

function getDateAct()
{
    return $date_commande = date("Y-m-d h:m:s");
}

//--------------------------------------COMMANDS--------------------------------------------

function addCommand($total, $id_utilisateur)
{
    $conn = connexionDB();
    $sql = "INSERT INTO Commands(total,date_commande,id_utilisateur) values(?,?,?)";
    $stmt = $conn->prepare($sql);
    $date_commande = getDateAct();
    $stmt->bind_param('dsi', $total, $date_commande, $id_utilisateur);
    $resultat = $stmt->execute();
    if ($resultat) {
        $id_commande = $conn->insert_id;
        $myCart = getAllCart();
        foreach ($myCart as $id_produit => $qte) {
            addListCommand($id_commande, $id_produit, $qte);
        }
        header("Location: ./success.php");
    }
}

function addListCommand($id_commande, $id_produit, $qte)
{
    $conn = connexionDB();
    $sql = "INSERT INTO listcommands(id_commande,id_produit,quantity) values(?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $id_commande, $id_produit, $qte);
    $resultat = $stmt->execute();
}

function getAllCommands()
{
    $conn = connexionDB();
    $sql = "SELECT * FROM Commands";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultats = $stmt->get_result();
    $commands = array();

    foreach ($resultats as $command) {
        $commands[] = $command;
    }
    return $commands;
}

function getCommandById($id)
{
    $conn = connexionDB();
    $sql = "SELECT * FROM listcommands where id_commande=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $results = $stmt->get_result();
    $commands = array();
    foreach ($results as $command) {
        $commands[] = $command;
    }
    return $commands;
}

function getCommandByOwnId($id)
{
    $conn = connexionDB();
    $sql = "SELECT * FROM listcommands INNER JOIN Commands ON listcommands.id_commande = Commands.id_commande
    WHERE Commands.id_utilisateur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $results = $stmt->get_result();
    $commands = array();
    foreach ($results as $command) {
        $commands[] = $command;
    }
    return $commands;
}

//create function to delete command
function deleteCommandById($id)
{
    $conn = connexionDB();

    $command = getCommandById($id);
    if ($command) {

        $sql = 'DELETE FROM Commands where id_commande = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        if ($result) {
            header('Location: ./manageCommands.php');
            exit();
        }
    } else {
        echo "Error while deleting";
    }
}


?>