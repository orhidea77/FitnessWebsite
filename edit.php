<?php

require_once "database.php";

if(isset($_POST['edit'])){
    $eid = $_GET['editid'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = mysqli_query($conn, "UPDATE clients SET name = '$name', email = '$email', phone = '$phone' WHERE id = '$eid'");
    if($sql){
        echo "<script>alert('Successfull Edit');</script>";
        echo "<script>document.location='dashboardd.php'</script>";
    }else{
        echo "<script>alert('Something went wrong')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="d.css"/>
  </head>
  <body>
<div class="container">
  <div class="row">
    <div class="column">
      <h2>Edit Client</h2>
    </div>
  </div>
      <form method="POST">
        <?php
        $eid = $_GET['editid'];
        $sql = mysqli_query($conn, "SELECT * FROM clients WHERE id='$eid'");
        while($row=mysqli_fetch_array($sql)){
        ?>
        <div class="row">
        <div class="column">
          <label>Name</label>
          <input type="text" name="name" value="<?php echo $row['name'];?>"class="form-control" required>
        </div>
        </div>
        <div class="row">
        <div class="column">
          <label>Email</label>
          <input type="email" name="email" value="<?php echo $row['email'];?>" class="form-control" required>
        </div>
        </div>
        <div class="row">
        <div class="column">
          <label for="phone">Phone</label>
          <input type="text" name="phone" value="<?php echo $row['phone'];?>" class="form-control" required>
        </div>
        </div>
        <?php
        }?>
        <div class="row">
        <div class="column">
          <button type="text" name="edit" class="btn">Add Client</button>
          <a href="dashboardd.php">Registered Clients</a>
        </div>
        </div>
      </form>
    </div>
    </body>
    </html>