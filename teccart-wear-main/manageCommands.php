<?php
include "./public/headers.php";
$commandes = getAllCommands();
?>

<main>
    <section>
        <div class="registerfrm">
            <center>
                <h2 class="text-primary"><b>Manage Orders</b></h2>
                <hr width="600px"><br>
            </center>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Client ID</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Date Command</th>
                                    <th scope="col">Products ==> Quantity</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($commandes as $commande) {
                                    $id_user = $commande['id_utilisateur'];
                                    $user = getUserById($id_user) ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $commande['id_commande']; ?>
                                        </th>
                                        <td>
                                            <?php echo $commande['id_utilisateur']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['nom'] . " " . $user['prenom']; ?>
                                        </td>
                                        <td>
                                            <?php echo $commande['date_commande']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $tab_commands = getCommandById($commande['id_commande']);
                                            foreach ($tab_commands as $key => $value) {
                                                $product = getProductById($value['id_produit']); ?>
                                                <?php echo $product['nom'] . " ==> <b>" . $value['quantity'] . "</b><br>"; ?>
                                            <?php } ?>
                                        </td>                                       
                                        <td>
                                            <?php echo $commande['total']; ?>
                                        </td>
                                        <td>
                                            <a href="./deleteCommand.php?id=<?php echo $commande['id_commande']; ?>"
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