<!--Delete User-->
<?php
include "./public/headers.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteUser($id);
}
header("location: manageUsers.php");
?>