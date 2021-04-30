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

$sql = "SELECT DISTINCT species FROM animals";
$result = mysqli_query($connect ,$sql);
$tbody='';
if (mysqli_num_rows($result) > 0){    
    while($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)){        
        $tbody .= 
            "<li><a href='speciesSelect.php?species=".$rows['species']."'>$rows[species]</a></li>";
    };
} else {
    $tbody = "<p>No Data Available</p>";
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
    <style>
        ul{
            text-align: center;
            list-style-type: none;
            padding: 0;
        }
    </style>
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
            <h2>Surch for a specific Species?</h2>
            <div id="list">   
                <p class='h4'>All Species</p>
                <ul>
                    <?= $tbody;?>
                </ul>
            </div> 
        </div>
    </div>
</body>
</html>