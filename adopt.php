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
    <?php require_once 'components/boot.php' ?>
    <link rel="stylesheet" href="CSS/home.css">
    <style>
        fieldset {
            margin: auto;
            margin-top: 50px;
            width: 75%;
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
            <fieldset>
                <legend class='h2'> Adopt <br><br><img class='img-thumbnail rounded-circle' src='<?php echo $picture ?>' alt="<?php echo $name ?>" width="300px"></legend>
                <form action ="animals/actions/a_adopt.php" method="post" enctype="multipart/form-data">
                    <table class="table">
                        <tr>
                            <th>When would you like to pick up your new pet</th><br>
                            <td><input class='form-control' type="date" name="date"/></td>
                        </tr>
                        <tr>
                            <input type="hidden" name="id" value= "<?php echo $data['id'] ?>"/>
                            <input type="hidden" name="name" value= "<?php echo $data['name'] ?>"/>
                            <input type="hidden" name="picture" value= "<?php echo $data['picture'] ?>"/>
                            <td><button class="btn btn-success" type="submit">Adopt</button></td>
                            <td><a href="index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
        </div>
    </div>
</body>
</html>