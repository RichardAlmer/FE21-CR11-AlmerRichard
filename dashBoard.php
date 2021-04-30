<?php
session_start();
require_once 'components/db_connect.php';

if (!isset($_SESSION[ 'adm' ]) && !isset($_SESSION['user'])) {
    header("Location: index.php" );
    exit;
}

if ( isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

$id = $_SESSION['adm' ];
$status = 'adm';
$sqlSelect = "SELECT * FROM user WHERE status != ? ";
$stmt = $connect->prepare($sqlSelect);
$stmt->bind_param("s", $status);
$work = $stmt->execute();
$result = $stmt->get_result();
$tbody = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= 
        "<tr>
            <td><img class='img-thumbnail rounded-circle' src='pictures/".$row['picture']."' alt=".$row['first_name']."></td>
            <td>".$row['first_name']." ".$row['last_name']."</td>
            <td>".$row['date_of_birth']."</td>
            <td>".$row['email']."</td>
            <td><a href='update.php?id=".$row['id']."'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete.php?id=".$row['id']."'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
        </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm-DashBoard</title>
    <?php require_once 'components/boot.php' ?>
    <style type="text/css">       
        .img-thumbnail{
            width: 70px !important;
            height: 70px !important;
        }
        td{
            text-align: center;
            vertical-align: middle;
        }
        tr{
            text-align: center;
        }
        .userImage{
            width: 100px ;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img class="userImage" src="pictures/admavatar.png" alt="Adm avatar">
                <p class="">Administrator</p>
                <a href="logout.php?logout">Sign Out</a><br>
                <a href="animals/index.php">Pets</a><br>
                <a href="adoption.php">Adoptions</a>
            </div>
            <div class="col-8 mt-2">
                <p class='h2'>Users</p>
                <table class='table table-striped'>
                <thead class='table-success'>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th >
                        <th>Date of birth</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$tbody?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>