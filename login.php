<?php

@include 'konfigurimi.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:index.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In and Registration Form</title>
    <link rel="stylesheet" href="login.css"/>
  </head>
  <body>
    <div class="container">
        <div class = "form-box">
            <h1 id="title">Log In</h1>
            <form action="#">
                <div class = "field">
                <div class="input-field name-field">
                    <div class="input-field">
                    <input type = "text" placeholder="Name" class="name"/>
                </div>
                    <span class="error name-error">
                        <p class="error-text">Please enter a valid Name.</p>
                    </span>
                </div>
                <br>
                <div class="field create-password">
                <div class="input-field">
                    <input type = "password" placeholder="Password" class="password"/>
                </div>
                <span class="error password-error">
                    <p class="error-text"> Please enter atleast 8 characters with number, symbol, small and capital letter.</p>
                </span>
                </div>
                <br>
                <br>
                <p>Forgot Password? <a href = "#">Click Here!</a></p>
                <br>
                <div class ="button">
                   <input type="submit" value="Log In"/>
                </div>
                <br>
                <p>Don't have an Account?</p>
                <br>
                <div class="btn">
                <button onclick = "window.location.href='forma.html';">Sign Up</button>
            </form>
        </div>
    </div>
<script>

const form = document.querySelector("form"),
      nameField = form.querySelector(".name-field"),
      nameInput = nameField.querySelector(".name"),
      passField = form.querySelector(".create-password"),
      passInput = passField.querySelector(".password");

    function name(){
        const namePattern = /^[A-Z][a-z]{3,8}$/;
        if(!nameInput.value.match(namePattern)){
            return nameField.classList.add("invalid");
        }
        nameField.classList.remove("invalid");
      }

    function createPass(){
        const passPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/;

        if(!passInput.value.match(passPattern)){
            return passField.classList.add("invalid");
        }
        passField.classList.remove("invalid");

    window.location.href = 'index.php';
    return false;
    }

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        name();
        createPass();
    });

</script>
</body>
</html>