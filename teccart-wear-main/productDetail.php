<?php
include "./public/headers.php";
$id = $_GET['id'];
$product = getProductById($id);
if (isset($_POST['addCart'])) {

    $quantite = $_POST['Quant'];

    if ($quantite > 0) {
        addCart($id, $quantite);
    }
}
?>
<main>
    <section>
        <!--Form to add new product-->
        <div class="registerfrm">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="login-container">
                            <center>
                                <h3 class="mb-3">Product Details</h3>
                            </center>
                            <hr />
                            <form action="#" method="post">
                                <div class="mb-3">
                                    <center><img src="<?php echo $product['chemin']; ?>" width="100" height="100"
                                            style="border-radius:5px;">
                                    </center><br>
                                    <label for="name"><b>Name</b></b></label>
                                    <input type="text" class="form-control" name="nom"
                                        value="<?php echo $product['nom']; ?>" placeholder="Product Name" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="prix"><b>Price</b></label>
                                    <input type="text" class="form-control" name="prix"
                                        value="<?php echo $product['prix']; ?>" placeholder="Product prix" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="taille"><b>Size</b></label>
                                    <input type="text" class="form-control" name="taille"
                                        value="<?php echo $product['taille']; ?>" placeholder="Xs, S, M, L, XL"
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="couleur"><b>Color</b></label>
                                    <input type="text" class="form-control" name="couleur"
                                        value="<?php echo $product['couleur']; ?>" placeholder="Red, Blue, Green..."
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="Quant" class="form-label"><b>Quantity *</b></label>
                                    <input type="number" class="form-control" name="Quant" min=0 max=<?php echo $product['quantite']; ?> required>
                                </div>
                                <div class="mb-3">
                                    <label for="item_description" class="form-label"><b>Item Description</b></label>
                                    <textarea class="form-control" name="item_description" rows="3"
                                        readonly><?php echo $product['item_description']; ?></textarea>
                                </div>
                                <center>
                                    <div class="mb-3">
                                        <button name="addCart"class="btn btn-warning"><i class="bi bi-cart-plus-fill"></i> <b>Add to cart</b></button>
                                    </div>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include "./footer.php";
?>