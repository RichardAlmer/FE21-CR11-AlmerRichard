<?php
session_start();
require_once '../../components/db_connect.php';

if (isset($_SESSION['adm' ])) {
    header("Location: ../../dashboard.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php" );
    exit;
}

$res = mysqli_query($connect, "SELECT * FROM user WHERE id=".$_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

if ($_POST) {  
    $name = $_POST['name'];
    $id = $_POST['id'];
    $picture = $_POST['picture'];
    $date = $_POST['date'];
    
    $sql = "INSERT INTO adoption (date, fk_user_id, fk_pet_id) VALUES ('$date', '$row[id]', '$id')";
    $sql_status = "UPDATE animals SET status = '<font color=red>reserved</font>' WHERE id = '$id'";

    if ($connect->query($sql) === true && $connect->query($sql_status) === true ) {
        $class = "success";
        $message = "Your pick-up date has been noted.";
    } else {
        $class = "danger";
        $message = "Error. Try again: <br>" . $connect->error;
    }
} else {
    header("location: ../error.php");
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Adopt</title>
        <?php require_once '../../components/boot.php' ?>
        <style>
            body{
                background-color: rgb(116, 185, 253);
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Adoption</h1>
            </div>
            <div class="alert alert-<?=$class;?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <a href='../../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
            </div>
        </div>
    </body>
</html>