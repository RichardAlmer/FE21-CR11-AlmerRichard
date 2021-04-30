<?php 
session_start();
require_once 'components/db_connect.php' ;


if (isset($_SESSION['user']) != "") {
   header("Location: ../home.php");
   exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
   header("Location: ../index.php" );
    exit;
}

$sql = "SELECT adoption.id, date, first_name, last_name, name FROM adoption INNER JOIN user ON fk_user_id = user.id INNER JOIN animals ON fk_pet_id = animals.id ORDER BY date;";
$result = mysqli_query($connect ,$sql);
$tbody='';
if(mysqli_num_rows($result) > 0) {    
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){        
        $tbody .= 
            "<tr>
                <td>$row[date]</td>
                <td>$row[first_name] $row[last_name]</td>
                <td>$row[name]</td>
                <td><a href='deleteAdop.php?id=$row[id]'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
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
        <?php require_once 'components/boot.php' ?>
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
                <a href= "dashBoard.php"><button class='btn btn-warning' type = "button">Back</button></a>
            </div>
            <p class='h2'>List of Adoptions</p>
            <table class='table table-striped'>
                <thead class='table-success'>
                    <tr>
                        <th>Date</th>
                        <th>User Name</th>
                        <th>Pet Name</th>
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