<?php
include "./public/headers.php";
if (isset($_POST['register'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $date_naissance = $_POST['date_naissance'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $c_mot_de_passe = $_POST['c-mot_de_passe'];
    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($date_naissance) && !empty($mot_de_passe) && !empty($c_mot_de_passe)) {
        if ($mot_de_passe === $c_mot_de_passe) {
            register($nom, $prenom, $email, $date_naissance, $mot_de_passe);

        }
    }
}
?>

<?php

?>

<section>
    <div class="registerfrm">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="login-container">
                        <center>
                            <h3 class="mb-3">SIGN UP</h3>
                        </center>
                        <form method="post">
                            <div class="container">
                                <div class="mb-3">
                                    <label for="nom" class="form-label"><i class="bi bi-forward-fill"></i> <b>Last Name</b></label>
                                    <input type="text" name="nom" class="form-control" id="nom">
                                </div>
                                <div class="mb-3">
                                    <label for="prenom" class="form-label"><i class="bi bi-forward-fill"></i> <b>First Name</b></label>
                                    <input type="text" name="prenom" class="form-control" id="prenom">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label"><i class="bi bi-envelope-plus-fill"></i> <b>Email</b></label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="mb-3">
                                    <label for="date_naissance" class="form-label"><i class="bi bi-calendar-month-fill"></i> <b>Date of Birth</b></label>
                                    <input type="date" name="date_naissance" class="form-control" id="date_naissance">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputpassword" class="form-label"><i class="bi bi-incognito"></i> <b>Password</b></label>
                                    <input type="password" name="mot_de_passe" class="form-control"
                                        id="exampleInputpassword">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputpassword" class="form-label"><i class="bi bi-incognito"></i> <b>Confirm Password</b></label>
                                    <input type="password" name="c-mot_de_passe" class="form-control"
                                        id="exampleInputpassword">
                                </div>
                                <br>
                                <div class="d-grid gap-2">
                                    <button type="submit" name="register" class="btn btn-primary">Register</button>
                                </div>
                                <label class="form-check-label" for="exampleCheck1">Already a member?</label><a
                                    href="connexion.php" style="color: navy; font-weight:bold; text-decoration:none;">
                                    Login</a>
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