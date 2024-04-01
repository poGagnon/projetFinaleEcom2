<?php
include "./public/headers.php";
$grandTotal = 0;
$cart = getAllCart();

if (isset($_POST['modifyProduct'])) {
    $id = $_POST['id_produit'];
    $quant = $_POST['Quant'];
    addCart($id, $quant, false);
}

if (isset($_POST['deleteProduct'])) {
    $id = $_POST['id_produit'];
    unset($_SESSION['cart'][$id]);
    header('Location: ./myCart.php');
    exit();
}

if (isset($_POST['payer'])) {
    if (isset($_SESSION['utilisateur'])) {
        $id_user = $_SESSION['user_id'];
        addCommand($_SESSION['totals'], $id_user);
        emptyCart();

    } else {
        header('Location: ./connexion.php');
        exit();
    }
}

?>

<main>
    <section>
        <div class="registerfrm">
            <center>
                <h4>My Cart</h4>
                <hr width="600px"><br>
            </center>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Item Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($cart as $idProduct => $quant) {
                                    $product = getProductById($idProduct);
                                    $total = $quant * $product['prix'];
                                    $grandTotal += $total;
                                    $_SESSION['totals'] = $grandTotal;
                                    ?>
                                    <form method="post">
                                        <tr>
                                            <input type="hidden" name="id_produit" value="<?php echo $idProduct; ?>">
                                            <td>
                                                <?php echo $product['nom']; ?>
                                            </td>
                                            <td>
                                                <?php echo $product['taille']; ?>
                                            </td>
                                            <td>
                                                <?php echo $product['couleur']; ?>
                                            </td>
                                            <td>
                                                <?php echo $product['prix']; ?>
                                            </td>
                                            <td><input min="1" max="<?php echo $product['quantite']; ?>" type="number"
                                                    value="<?php echo $quant; ?>" name="Quant"></td>
                                            <td>
                                                <?php echo $total; ?>
                                            </td>
                                            <td>
                                                <?php echo $product['item_description']; ?>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-info" name="modifyProduct">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button type="submit" class="btn btn-danger" name="deleteProduct">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </form>
                                <?php } ?>
                            </tbody>
                        </table>
                        <hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    <center>
                                        <h3>Total Price: <b>$
                                                <?php echo $grandTotal; ?>
                                            </b></h3>
                                    </center>
                                </div>
                            </div><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form method="post">
            <center>
                <button class="btn btn-info" name="payer"><i class="bi bi-coin"></i> <b>Pay
                        Now</b></button><br><br>
                <div id="paypal-payment-button" name="payer" style="width: 300px;"></div>
            </center>
        </form>
    </section>
</main>

<script
    src="https://www.paypal.com/sdk/js?client-id=AeNR5aCDiC3uGG8jDi6KBG_RgBSxh1GcIQ80ANEo_cE-adwN62-Zfaym-lsaJkk0ssHuc1XLgkl2uEU-&currency=CAD"></script>
<script src="./public/paypal.js"></script>

</body>

</html>