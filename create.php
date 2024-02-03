<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "clients";

$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";
$number = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["number"];

    do{
        if(empty($name) || empty($email) || empty($number)){
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "INSER INTO clients (name, email, number)" . "VALUES ('$name', '$email', '$number')";
        $result = $connection-> query($sql);

        if(!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $name = "";
        $email = "";
        $number = "";

        $successMessage = "Client added correctly";

        header("location: dashboard.php");
        exit;

    }while (false);
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