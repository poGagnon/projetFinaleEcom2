<?php
include "./public/headers.php";
$products = getAllProducts();
?>

<main>
    <section>
        <div class="registerfrm">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <h4>Manage Products</h4>
                        </center>
                        <hr>
                        <div class="mb-3">
                            <center><a href="addProduct.php" class="btn btn-success">Add new Product</a>
                            </center>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Img</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Item Description</th>
                                    <th scope="col">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $product['id']; ?>
                                        </th>
                                        <th scope="row"><img src="<?php echo $product['chemin']; ?>" width="50" height="50"
                                                alt=""></th>

                                        <td>
                                            <?php echo $product['nom']; ?>
                                        </td>
                                        <td>
                                            <?php echo $product['prix']; ?>
                                        </td>
                                        <td>
                                            <?php echo $product['taille']; ?>
                                        </td>
                                        <td>
                                            <?php echo $product['couleur']; ?>
                                        </td>
                                        <td>
                                            <?php echo $product['quantite']; ?>
                                        </td>
                                        <td>
                                            <?php echo $product['item_description']; ?>
                                        </td>
                                        <td>
                                            <a href="./modifyProduct.php?id=<?php echo $product['id']; ?>"
                                                class="btn btn-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <a href="./deleteProduct.php?id=<?php echo $product['id']; ?>"
                                                class="btn btn-danger">
                                                <i class="bi bi-trash3-fill">
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</body>

</html>