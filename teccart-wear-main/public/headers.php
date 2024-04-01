<?php
include './includes/fonctions.php';
$quantity = qteCart();
?>

<!--Header and Navigation Section-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="cache-control" content="no-cache">
  <title>TeccartWears</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/style.css">
</head>

<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <a class="navbar-brand" href="home.php"><b><span class="firstWord">Teccart WEARS</span></b><span class="secondWord">
        WORKOUT IN STYLE</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['utilisateur'])) {
          $utilisateur_prenom = $_SESSION['utilisateur_prenom'];
          $utilisateur_nom = $_SESSION['utilisateur_nom']; ?>
          <li class="nav-item">
            <a class="btn btn-info" style="font-weight: bold;">Welcome <span class="btn btn-warning"
                style="color:white; font-weight: bold;"><?php echo $utilisateur_prenom . " (" . $utilisateur_nom . ")"; ?>
              </span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="Products.php"><i class="bi bi-shop"></i> Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="myProfile.php"><i class="bi bi-person-badge"></i> My Profile</a>
          </li>
          <li class="nav-item">
            <a href="myCart.php" class="btn btn-primary">
              <i class="bi bi-cart4"></i> <span class="badge text-bg-danger">
                <?php echo $quantity; ?>
              </span>
            </a>
          </li>
          <?php if ($_SESSION['roleU'] == "Admin") { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="bi bi-database-fill-lock"></i> Administration</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="manageProduct.php"><i class="bi bi-basket-fill"></i> Manage Products</a>
                </li>
                <li><a class="dropdown-item" href="manageUsers.php"><i class="bi bi-people"></i> Users</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="manageCommands.php"><i class="bi bi-bag-fill"></i> Orders</a></li>
              </ul>
            </li>
          <?php } ?>
        <?php } else ?>
        <?php if (!isset($_SESSION['utilisateur'])) { ?>
          <li class="nav-item">
            <a class="nav-link active" href="connexion.php"><i class="bi bi-box-arrow-in-right"></i> Sign in</a>
          </li>
        <?php } else { ?>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
          <li class="nav-item">
            <a class="nav-link active" href="logout.php"><i class="bi bi-box-arrow-right"></i> Log Out</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </nav>
</header>

<body>