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
    $id = $_POST['id'];  
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
    $status = $_POST['status'];
    
    $sql = "UPDATE animals SET name = '$name', size = '$size', species = '$species', breed = '$breed', picture = '$picture', age = $age, description = '$description', hobbies = '$hobbies', zip = $zip, city = '$city', address = '$address', status = '$status' WHERE id = {$id}";
        
    if ($connect->query($sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>".$connect->error;
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
        <title>Update</title>
        <?php require_once '../../components/boot.php' ?> 
    </head>
    <body>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Update request response</h1>
            </div>
            <div class="alert alert-<?php echo $class;?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <a href='../update.php?id=<?=$id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
                <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
            </div>
        </div>
    </body>
</html>