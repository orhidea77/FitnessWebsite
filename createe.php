<?php

require_once "database.php";

if(isset($_POST['submit'])){

    $name =$_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST ['phone'];
    $sql = mysqli_query($conn, "INSERT INTO clients(name,email,phone) VALUES('$name','$email','$phone')");

    if($sql){
        echo "<script>alert('New client successfully added');</script>";
        echo "<script>document.location='createe.php';</script>";

    }else{
        echo "<script>alert('Something went wrong');</script>";
    }
}
?>
<div class="container">
  <div class="row">
    <div class="column">
      <h2>Add Client</h2>
    </div>
  </div>
      <form method="POST">
        <div class="row">
        <div class="column">
          <label>Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        </div>
        <div class="row">
        <div class="column">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        </div>
        <div class="row">
        <div class="column">
          <label for="phone">Phone</label>
          <input type="text" name="phone" class="form-control" required>
        </div>
        </div>
        <div class="row">
        <div class="column">
          <button type="text" name="submit" class="btn">Add Client</button>
          <a href="dashboardd.php">Registered Clients</a>
        </div>
        </div>
      </form>
    </div>
    </body>
    </html>