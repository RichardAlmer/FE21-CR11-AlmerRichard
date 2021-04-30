<?php
session_start();
require_once 'components/db_connect.php';

if (isset($_SESSION['adm' ])) {
    header("Location: dashboard.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php" );
    exit;
}

$res = mysqli_query($connect, "SELECT * FROM user WHERE id=".$_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

$sql = "SELECT * FROM animals WHERE status LIKE '%available%'";
$result = mysqli_query($connect ,$sql);
$tbody='';

if(mysqli_num_rows($result) > 0) {    
    while($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)){        
        $tbody .= 
            "<tr>
                <td><img class='img-thumbnail' src='$rows[picture]' width='200px'</td>
                <td><b>".$rows['name']."</b></td>
                <td>".$rows['age']."</td>
                <td>".$rows['breed']."</td>
                <td>".$rows['zip']." ".$rows['city'].",<br>".$rows['address']."</td>
                <td>".$rows['status']."</td>
                <td><a href='info.php?id=".$rows['id']."'><button class='btn btn-success btn-sm' type='button'>Show More</button></a><br><a href='adopt.php?id=".$rows['id']."'><button class='btn btn-primary btn-sm' type='button'>Take me home</button></a></td>
            </tr>";
   };
} else {
   $tbody =  "<tr><td colspan='7'><center>No Pets Available or all Pets are reserved</center></td></tr>";
}

$sql_stat = "SELECT * FROM animals WHERE status LIKE '%reserved%'";
$result_stat = mysqli_query($connect ,$sql_stat);
$tbody_stat='';

if(mysqli_num_rows($result_stat) > 0) {    
    while($rows = mysqli_fetch_array($result_stat, MYSQLI_ASSOC)){        
        $tbody_stat .= 
            "<tr>
                <td><img class='img-thumbnail' src='$rows[picture]' width='200px'</td>
                <td><b>".$rows['name']."</b></td>
                <td>".$rows['age']."</td>
                <td>".$rows['breed']."</td>
                <td>".$rows['zip']." ".$rows['city'].",<br>".$rows['address']."</td>
                <td>".$rows['status']."</td>
                <td><a href='info.php?id=".$rows['id']."'><button class='btn btn-success btn-sm' type='button'>Show More</button></a></td>
            </tr>";
   };
} else {
   $tbody_stat =  "<tr><td colspan='7'><center>No reserved Pets</center></td></tr>";
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - <?php echo $row['first_name']; ?></title>
    <?php require_once 'components/boot.php' ?>
    <link rel="stylesheet" href="CSS/home.css">
</head>
<body>
    <div id="header">
        <img class="userImage" src="pictures/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>">
        <p id="userName" class="text-white">Hi <?php echo $row['first_name']; ?></p>
        <h2 id="head">All of our animals look forward to a new home</h2>
        <a id="userNav2" href="logout.php?logout">Sign Out</a>
        <a id="userNav1" href="update.php?id=<?php echo $_SESSION['user'] ?>">Edit Profile</a>
        <a href="home.php" id="aHome">All Pets</a>
        <a href="senior.php" id="aSeniors">Seniors</a>
        <a href="species.php" id="aSpecies">Species</a>
    </div>
    <div class="container">
        <div id="all">
            <h2>All Pets</h2>
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
                    <?= $tbody_stat;?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>