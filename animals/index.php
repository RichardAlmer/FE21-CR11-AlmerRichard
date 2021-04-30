<?php 
session_start();
require_once '../components/db_connect.php' ;


if (isset($_SESSION['user']) != "") {
   header("Location: ../home.php");
   exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
   header("Location: ../index.php" );
    exit;
}

$sql = "SELECT * FROM animals";
$result = mysqli_query($connect ,$sql);
$tbody='';
if(mysqli_num_rows($result) > 0) {    
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){        
        $tbody .= 
            "<tr>
                <td><img class='img-thumbnail' src='$row[picture]' width='200px'</td>
                <td><b>".$row['name']."</b></td>
                <td>".$row['age']."</td>
                <td>".$row['breed']."</td>
                <td>".$row['zip']." ".$row['city'].",<br>".$row['address']."</td>
                <td>".$row['status']."</td>
                <td><a href='update.php?id=".$row['id']."'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a><br>
                <a href='delete.php?id=".$row['id']."'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a><br>
                <a href='info.php?id=".$row['id']."'><button class='btn btn-success btn-sm' type='button'>Info</button></a></td>
            </tr>";
   };
} else {
   $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pet Adoption</title>
        <?php require_once '../components/boot.php' ?>
        <style type= "text/css">
            .manageProduct {          
                margin: auto;
            }
            .img-thumbnail {
                width: 70px !important;
                height: 70px !important;
            }
            td {          
                text-align: center;
                vertical-align: middle;
            }
            tr {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="manageProduct w-75 mt-3">   
            <div class='mb-3'>
                <a href= "create.php"><button class='btn btn-primary' type = "button">Add Homeless Pet</button></a>
                <a href= "../dashBoard.php"><button class='btn btn-warning' type = "button">Back</button></a>
            </div>
            <p class='h2'>Pets</p>
            <table class='table table-striped'>
                <thead class='table-success'>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Breed</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $tbody;?>
                </tbody>
            </table>
        </div>
    </body>
</html>