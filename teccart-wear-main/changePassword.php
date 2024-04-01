<?php
include "./public/headers.php";
$users = getAllUsers();

if (isset($_SESSION['utilisateur'])) {
    $id = $_SESSION['user_id'];
    $user = getUserById($id);
    if (isset($_POST['update'])) {
        $ancien_mot_de_passe = $_POST['ancien_mot_de_passe'];
        $mot_de_passe = $_POST['mot_de_passe'];
        $c_mot_de_passe = $_POST['c-mot_de_passe'];

        if (
            !empty($mot_de_passe) || !empty($c_mot_de_passe)
        ) {
            if ($mot_de_passe === $c_mot_de_passe) {
                UpdatePassword($id, $mot_de_passe);
            }
        }
    }
}

?>

<section>
    <div class="registerfrm">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="login-container">
                        <center>
                            <h3 class="mb-3">CHANGE PASSWORD</h3>
                        </center>
                        <hr>
                        <form method="post">
                            <div class="container">
                                <div class="mb-3">
                                    <label for="exampleInputpassword" class="form-label"><i class="bi bi-key-fill"></i>
                                        <b>Old Password</b></label>
                                    <input type="password" name="ancien_mot_de_passe" class="form-control"
                                        id="exampleInputpassword" value="<?php echo $user['mot_de_passe']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputpassword" class="form-label"><i class="bi bi-incognito"></i>
                                        <b>New Password</b></label>
                                    <input type="password" name="mot_de_passe" class="form-control"
                                        id="exampleInputpassword" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputpassword" class="form-label"><i class="bi bi-incognito"></i>
                                        <b>Confirm Password</b></label>
                                    <input type="password" name="c-mot_de_passe" class="form-control"
                                        id="exampleInputpassword" required>
                                </div>
                                <br>
                                <center>
                                    <div class="mb-3">
                                        <button type="submit" name="update" class="btn btn-primary">Modify</button>
                                    </div>
                                </center>
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