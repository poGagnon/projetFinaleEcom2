<?php
include "./public/headers.php";
$products = getAllProducts();
?>

<main>
    <section class="products">
        <marquee behavior="alternate">
            <h1 style="color: navy">Products</h1>
        </marquee>
        <hr>
        <div class="productContainer">
            <?php foreach ($products as $product) { ?>
                <div class="product">
                    <img src="<?php echo $product['chemin']; ?>" class="my_img">
                    <h2>
                        <?php echo $product['nom']; ?>
                    </h2><br>
                    <p><b>Item Description:</b>
                        <?php echo $product['item_description']; ?>
                    </p>
                    <span class="price"><b>Price:</b>$
                        <?php echo $product['prix']; ?>
                    </span><br>
                    <span class="price"><b>Color:</b>
                        <?php echo $product['couleur']; ?>
                    </span><br>
                    <span class="price"><b>Size:</b>
                        <?php echo $product['taille']; ?>
                    </span><br><br>
                    <a href="productDetail.php?id=<?php echo $product['id']; ?>" class="btn btn-primary"><i
                            class="bi bi-eye-fill"></i> View Product</a>
                </div>


            <?php } ?>
        </div>

    </section>
</main>

<?php
include "./footer.php";
?>