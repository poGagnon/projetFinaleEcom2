<?php
include "./public/headers.php"; ?>

<main>
  <section style="background-color: #eee;">
    <div class="container py-5">


      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3">
                <b>
                  <?php echo $_SESSION['utilisateur_prenom'] . " " . $_SESSION['utilisateur_nom']; ?>
                </b>
              </h5>
              <p class="text-muted mb-1"><b>Client ID :</b>
                <?php echo $_SESSION['utilisateur']; ?>
              </p>
              <p class="text-muted mb-1">Full Stack Developer</p>
              <p class="text-muted mb-4">
                <?php echo $_SESSION['utilisateur_add']; ?>
              </p>
              <div class="d-block justify-content-center mb-2">
                <a href="editMyProfile.php" class="btn btn-primary">Edit Profile</a>
              </div>
              <div class="d-block justify-content-center mb-2">
                <a href="changePassword.php" class="btn btn-warning">Change Password</a>
              </div>

            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0"><b>Full Name</b></p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                  <?php echo $_SESSION['utilisateur_prenom'] . " " . $_SESSION['utilisateur_nom']; ?>
                  </p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0"><b>Email</b></p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    <?php echo $_SESSION['utilisateur_email']; ?>
                  </p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0"><b>Phone</b></p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    +1 (438) 123 1234
                  </p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0"><b>Address</b></p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    <?php echo $_SESSION['utilisateur_add']; ?>
                  </p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0"><b>Postal Code</b></p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    <?php echo $_SESSION['utilisateur_pscode']; ?>
                  </p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</main>
<?php include './footer.php'; ?>