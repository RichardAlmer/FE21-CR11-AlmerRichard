<?php
session_start();
require_once 'components/db_connect.php';

if (isset($_SESSION[ 'user']) != "") {
    header("Location: home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php" );
    exit;
}

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM adoption WHERE id = {$id}" ;
    $result = $connect->query($sql);
    $data = $result->fetch_assoc();
    if ($result->num_rows == 1) {
        $date = $data['date'];
    } else {
        header("location: animals/error.php");
    }
    $connect->close();
} else {
    header("location: animals/error.php");
}  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delete Adoption</title>
        <?php require_once 'components/boot.php' ?>
        <style type= "text/css">
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 70%;
            }    
            .img-thumbnail{
                width: 70px !important;
                height: 70px !important;
            }    
        </style>
    </head>
    <body>
        <fieldset>
            <legend class='h2 mb-3'> Delete request </legend>
            <h5>You have selected the adoption for: </h5>
            <table class="table w-75 mt-3" >
                <tr>
                    <td><?php echo $date?></td>
                </tr>
            </table>
            <h3 class="mb-4">Do you really want to delete this adoption?</h3>
            <form action="animals/actions/a_deleteAdop.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>"/>
                <button class="btn btn-danger" type="submit"> Yes, delete it!</button>
                <a href="adoption.php"><button class="btn btn-warning" type="button"> No, go back!</button></a>
            </form>
        </fieldset>
    </body>
</html>