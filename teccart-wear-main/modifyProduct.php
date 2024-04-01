<?php
include "./public/headers.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = getProductById($id);
    if (isset($_POST['save'])) {
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $taille = $_POST['taille'];
        $couleur = $_POST['couleur'];
        $quantite = $_POST['quantite'];
        $item_description = $_POST['item_description'];

        if (empty($nom) || empty($prix) || empty($taille) || empty($couleur) || empty($quantite)) {
            echo "Please fill all the fields";
        } else {
            modifyProduct($id, $nom, $prix, $taille, $couleur, $quantite, $item_description);
        }
    }
}

?>
<main>
    <section>
        <div class="registerfrm">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <h4>Modify Product</h4>
                        </center>
                        <hr>
                        <!--Form to add new product-->
                        <div class="registerfrm">
                            <form action="#" method="post">
                                <center><img src="<?php echo $product['chemin']; ?>" width="100" height="100"
                                        style="border-radius:5px;"></center>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Import an Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="mb-3">
                                    <label for="name"><b>Name</b></b></label>
                                    <input type="text" class="form-control" name="nom"
                                        value="<?php echo $product['nom']; ?>" placeholder="Product Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="prix"><b>prix</b></label>
                                    <input type="text" class="form-control" name="prix"
                                        value="<?php echo $product['prix']; ?>" placeholder="Product prix" required>
                                </div>
                                <div class="mb-3">
                                    <label for="taille"><b>taille</b></label>
                                    <input type="text" class="form-control" name="taille"
                                        value="<?php echo $product['taille']; ?>" placeholder="Xs, S, M, L, XL"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="couleur"><b>Color</b></label>
                                    <input type="text" class="form-control" name="couleur"
                                        value="<?php echo $product['couleur']; ?>" placeholder="Red, Blue, Green...">
                                </div>
                                <div class="mb-3">
                                    <label for="quantite"><b>Quantity</b></label>
                                    <input type="number" class="form-control" name="quantite"
                                        value="<?php echo $product['quantite']; ?>" min="0">
                                </div>
                                <div class="mb-3">
                                    <label for="item_description" class="form-label">Item Description</label>
                                    <textarea class="form-control" name="item_description"
                                        rows="3"><?php echo $product['item_description']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" name="save" value="Modify Product" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</body>

</html>