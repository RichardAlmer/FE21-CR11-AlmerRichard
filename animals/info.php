<?php
session_start();
require_once '../components/db_connect.php';

if (!isset($_SESSION[ 'adm' ]) && !isset($_SESSION['user'])) {
    header("Location: index.php" );
    exit;
}

if ( isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

$res = mysqli_query($connect, "SELECT * FROM user WHERE id=".$_SESSION['adm']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE id = {$id}";
    $result = $connect->query($sql);
    $data = $result->fetch_assoc();
    if ($result->num_rows == 1) {
        $name = $data['name'];
        $size = $data['size'];
        $species = $data['species'];
        $breed = $data['breed'];
        $picture = $data['picture'];
        $age = $data['age'];
        $description = $data['description'];
        $hobbies = $data['hobbies'];
        $zip = $data['zip'];
        $city = $data['city'];
        $address = $data['address'];
        $status = $data['status'];
    } else {
        header("location: error.php");
    }
    
} else {
    header("location: error.php");
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - <?php echo $row['first_name']; ?></title>
    <?php require_once '../components/boot.php' ?>
    <style>
        #all{
            display: flex;
            align-items: center;
            flex-direction: column;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div id="all">
            <h2>Info</h2>
            <div class="card mb-3" style="max-width: 75vw;">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="<?php echo $picture ?>" alt="<?php echo $name ?>" width="350px">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $name ?></h5>
                            <p class="card-text"><b>Species: </b><?php echo $species ?></p>
                            <p class="card-text"><b>Breed: </b><?php echo $breed ?></p>
                            <p class="card-text"><b>Age: </b><?php echo $age ?></p>
                            <p class="card-text"><b>Description: </b><?php echo $description ?></p>
                            <p class="card-text"><b>Hobbies: </b><?php echo $hobbies ?></p>
                            <p class="card-text"><b>Size: </b><?php echo $size ?></p>
                            <p class="card-text"><b>Located: </b><?php echo $zip ?> <?php echo $city ?>, <?php echo $address ?></p>
                            <p class="card-text"><b>Status: </b><?php echo $status ?></p>
                            <a href="index.php"><button class='btn btn-primary btn-sm' type='button'>Back</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>