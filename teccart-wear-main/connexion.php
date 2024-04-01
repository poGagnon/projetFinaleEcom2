<?php
include "./public/headers.php";
if (isset($_POST['connexion'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    if (!empty($email) && !empty($mot_de_passe)) {
        authentification($email, $mot_de_passe);
    }
}

?>

<main>
    <section>
        <div class="registerfrm">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <center>
                            <h3 class="mb-3">LOGIN</h3>
                        </center>
                        <form method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"><i
                                        class="bi bi-envelope-at-fill"></i>
                                    <b>Email</b></label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label"><i class="bi bi-lock-fill"></i>
                                    <b>Password</b></label>
                                <input type="password" name="mot_de_passe" class="form-control"
                                    id="exampleInputPassword1">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Not a Member?</label><a href="Inscription.php"
                                    style="color: navy; font-weight:bold; text-decoration:none;">
                                    Register Now</a>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" name="connexion" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>