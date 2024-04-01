<?php
include "./public/headers.php";

//Call function addproduct when click on button save using php
if (isset($_POST['save'])) {
    $nom = $_POST['name'];
    $prix = $_POST['price'];
    $taille = $_POST['size'];
    $couleur = $_POST['colorr'];
    $quantite = $_POST['quant'];
    $description = $_POST['description'];
    if (empty($nom) || empty($prix) || empty($taille) || empty($couleur) || empty($quantite)) {
        echo "Please fill all the fields";
    } else {
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            $image_name = $_FILES["image"]["name"];
            $image_tmp = $_FILES["image"]["tmp_name"];
            $image_destination = "images/" . basename($image_name);

            $image_type = strtolower(pathinfo($image_destination, PATHINFO_EXTENSION));
            if (!in_array($image_type, array("jpg", "jpeg", "png", "gif"))) {
                echo "Only images with extension JPG, JPEG, PNG et GIF are allowed.";
                exit();
            }

            if (move_uploaded_file($image_tmp, $image_destination)) {
                addProduct($nom, $prix, $taille, $couleur, $quantite, $description, $image_destination);
            }
        } else {
            addProduct($nom, $prix, $taille, $couleur, $quantite, $description);
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
                            <h4>Manage Products</h4>
                        </center>
                        <hr>
                        <div class="registerfrm">
                            <form method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Import an Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="mb-3">
                                    <label for="name"><b>Name</b></b></label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Product Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="price"><b>Price</b></label>
                                    <input type="text" class="form-control" name="price" id="price"
                                        placeholder="Product Price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="size"><b>Size</b></label>
                                    <input type="text" class="form-control" name="size" id="size"
                                        placeholder="Xs, S, M, L, XL" required>
                                </div>
                                <div class="mb-3">
                                    <label for="colorr"><b>Color</b></label>
                                    <input type="text" class="form-control" name="colorr" id="colorr"
                                        placeholder="Red, Blue, Green...">
                                </div>
                                <div class="mb-3">
                                    <label for="quant"><b>Quantity</b></label>
                                    <input type="number" class="form-control" name="quant" id="quant" min="0">
                                </div>
                                <div class="mb-3">
                                    <label for="description"><b>Description</b></label>
                                    <textarea class="form-control" name="description" id="description"
                                        rows="5"></textarea>
                                </div>
                                <center>
                                    <div class="mb-3">
                                        <input type="submit" name="save" value="Add Product" class="btn btn-success">
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
</body>
Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam deserunt eveniet ipsam quibusdam aliquid quam adipisci
quod quidem veritatis quasi.

</html>