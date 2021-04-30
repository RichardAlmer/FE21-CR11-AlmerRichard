<?php
session_start();
require_once '../../components/db_connect.php';

if (isset($_SESSION[ 'user']) != "") {
    header("Location: ../../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php" );
    exit;
}

if ($_POST) {  
    $name = $_POST['name'];
    $size = $_POST['size'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $picture = $_POST['picture'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $hobbies = $_POST['hobbies'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    
    $sql = "INSERT INTO animals (name, size, species, breed, picture, age, description, hobbies, zip, city, address) VALUES ('$name', '$size', '$species', '$breed', '$picture', $age, '$description', '$hobbies', $zip, '$city', '$address')";

    if ($connect->query($sql) === true) {
        $class = "success";
        $message = "The entry below was successfully created<br>
            <table class='table w-50'>
                <tr>
                    <td><img class='img-thumbnail rounded-circle' src='$picture' width='100px'></td>
                    <td>$name</td>
                    <td>$breed</td>
                </tr>
            </table><hr>";
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
    }
    $connect->close();
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Create</title>
        <?php require_once '../../components/boot.php' ?>
    </head>
    <body>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Create request response</h1>
            </div>
            <div class="alert alert-<?=$class;?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <a href='../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
            </div>
        </div>
    </body>
</html>