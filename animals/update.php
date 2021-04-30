<?php
session_start();
require_once '../components/db_connect.php';

if (isset($_SESSION[ 'user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php" );
    exit;
}

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
    $connect->close();
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Pet</title>
        <?php require_once '../components/boot.php'?>
        <style type="text/css">
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
            }  
            .img-thumbnail{
                width: 70px !important;
                height: 70px !important;
            }    
        </style>
    </head>
    <body>
        <fieldset>
            <legend class='h2'> Update request <img class='img-thumbnail rounded-circle' src='<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
            <form action ="actions/a_update.php" method="post" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <td><input class='form-control' type="text" name="name" placeholder="Name" value="<?php echo $name ?>"/></td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <td>
                            <select name="size" class="form-select" aria-label="Default select example">
                                <option selected><?php echo $size ?></option>
                                <option value="Small">Small</option>
                                <option value="Large">Large</option>
                                <option value="Senior">Senior</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Species</th>
                        <td><input class='form-control' type="text" name="species" placeholder="Species" value="<?php echo $species ?>"/></td>
                    </tr>
                    <tr>
                        <th>Breed</th>
                        <td><input class='form-control' type="text" name="breed" placeholder="Breed" value="<?php echo $breed ?>"/></td>
                    </tr>
                    <tr>
                        <th>Picture</th>
                        <td><input class='form-control' type="text" name="picture" placeholder="URL" value="<?php echo $picture ?>"/></td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td><input class='form-control' type="number" name="age" placeholder="0" value="<?php echo $age ?>"/></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><input class='form-control' type="text" name="description" placeholder="Description" value="<?php echo $description ?>"/></td>
                    </tr>
                    <tr>
                        <th>Hobbies</th>
                        <td><input class='form-control' type="text" name="hobbies" placeholder="Hobbies" value="<?php echo $hobbies ?>"/></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><input class='form-control' type="number" name="zip" placeholder="Zip: 1010" value="<?php echo $zip ?>"/><br>
                        <input class='form-control' type="text" name="city" placeholder="City: Vienna" value="<?php echo $city ?>"/><br>
                        <input class='form-control' type="text" name="address" placeholder="Address: Stephansplatz 1" value="<?php echo $address ?>"/></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <select name="status" class="form-select" aria-label="Default select example">
                                <option selected><?php echo $status ?></option>
                                <option value="<font color=green>available</font>">available</option>
                                <option value="<font color=red>reserved</font>">reserved</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <input type="hidden" name="id" value= "<?php echo $data['id'] ?>"/>
                        <input type="hidden" name="picture" value= "<?php echo $data['picture'] ?>"/>
                        <td><button class="btn btn-success" type="submit">Save Changes</button></td>
                        <td><a href="index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </body>
</html>