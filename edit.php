<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "clients";

$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$name = "";
$email = "";
$number = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']== 'GET'){
    
    if(!isset($_GET["id"])){
        header("location: dashboard.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location:dashboard.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $number = $row["number"];
}
else{

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["number"];

    do{

        if(empty($id) || empty($name) || empty($email) || empty($number)){
            $errorMessage = "All the fields are required";
        }

        $sql = "UPDATE clients" . "SET name = '$name', email= '$email', number = '$number'" . "WHERE id = $id";

        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query " . $connection->error;
            break;
        }

        $successMessage = "Client updated successfully";

        header("location: dashboard.php");
    }while(false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="db.css">

	<title>Dashboard</title>
</head>
<body>
	<div class="container">
		<h2>New Client</h2>

        <?php
        if(!empty($errorMessage)){
            echo "
            <div class = 'alert alert-warning' role ='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' label='Close'></button>
            </div>
            ";
        }
        ?>

		<form method="post">
            <input type="hidden" name= "id" value="<?php echo $id; ?>">
			<div class="row">
				<label class="colona">Name</label>
				<div class="colon">
					<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
				</div>
			</div>
			<div class="row">
				<label class="colona">Email</label>
				<div class="colon">
					<input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
				</div>
			</div>
			<div class="row">
				<label class="colona">Number</label>
				<div class="colon">
					<input type="text" class="form-control" name="number" value="<?php echo $number; ?>">
				</div>
			</div>


            <?php
            if(!empty($successMessage)){
                echo"
                <div class = 'row'>
                <div class = 'alert alert-success' role ='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' label='Close'></button>
            </div>
            </div>
            ";
            }

            ?>

			<div class="row">
				<div class="butoni">
					<button type="submit" class="btn">Submit</button>
				</div>
				<div class="butoni">
					<a class="btn" href="dashboard.php" role="button">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</body>
</html>