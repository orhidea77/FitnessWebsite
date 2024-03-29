<?php

@include 'konfigurimi.php';

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $usertype = $_POST['usertype'];

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $error[] = 'user already exist!';
    }else{
        if($pass != $cpass){
            $error[] = 'password does not match!';
        }else{
            $insert = "INSERT INTO user_form(name, email, password, usertype) VALUES('$name','$email','$pass','$usertype')";
            mysqli_query($conn, $insert);
            header('location:login.php');
        }
    }
};
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In and Registration Form</title>
    <link rel="stylesheet" href="forma.css"/>
  </head>
  <body>
    <div class="container">
        <div class = "form-box">
            <h1 id="title">Sign Up</h1>
            <form action="" method="post">
                <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class= "error-msg">' .$error.'</span>';
                    };
                };
                ?>
                <div class = "field">
                <div class="input-field name-field">
                    <div class="input-field">
                    <input type = "text" name = "name" required placeholder="Enter your Name">
                </div>
                    <span class="error name-error">
                        <p class="error-text">Please enter a valid Name.</p>
                    </span>
                </div>
                <br>
                <div class="field email-field">
                <div class="input-field">
                    <input type = "email" name = "email" required placeholder="Enter your Email">
                </div>
                    <span class="error email-error">
                    <p class="error-text">Please enter a valid Email.</p>
                    </span>
                </div>
                <br>
                <div class="field create-password">
                <div class="input-field">
                    <input type = "password" name="password" required placeholder="Enter your Password">
                </div>
                <span class="error password-error">
                    <p class="error-text"> Please enter atleast 8 characters with number, symbol, small and capital letter.</p>
                </span>
                </div>
                <br>
                <div class="field confirm-password">
                <div class="input-field">
                    <input type = "password" name="cpassword" required placeholder="Confirm your Password">
                </div>
                <span class="error cPassword-error">
                    <p class="error-text">Password does not match.</p>
                </span>
                <br>
                <div class="input-field">
                    <select name="usertype">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <br>
                <p>Forgot Password? <a href = "#">Click Here!</a></p>
                <br>
                <div class ="button">
                    <input type="submit" value="Sign Up" />
                </div>
                <br>
                <br>
                <p>Already have an Account?</p>
                <br>
                <div class="btn">
                <button onclick = "window.location.href='login.html';">Log In</button>
            </form>
        </div>
    </div>
<script>

const form = document.querySelector("form"),
      nameField = form.querySelector(".name-field"),
      nameInput = nameField.querySelector(".name"),
      emailField = form.querySelector(".email-field"),
      emailInput = emailField.querySelector(".email"),
      passField = form.querySelector(".create-password"),
      passInput = passField.querySelector(".password"),
      cPassField = form.querySelector(".confirm-password"),
      cPassInput = cPassField.querySelector(".cPassword");


    function name(){
        const namePattern = /^[A-Z][a-z]{3,8}$/;
        if(!nameInput.value.match(namePattern)){
            return nameField.classList.add("invalid");
        }
        nameField.classList.remove("invalid");
      }
    function checkEmail(){
        const emailpattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if(!emailInput.value.match(emailpattern)){
            return emailField.classList.add("invalid");
        }
        emailField.classList.remove("invalid");
      }

    function createPass(){
        const passPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/;

        if(!passInput.value.match(passPattern)){
            return passField.classList.add("invalid");
        }
        passField.classList.remove("invalid");
    }

    function confirmPassword(){
        if(passInput.value !== cPassInput.value || cPassInput.value === ""){
            return cPassField.classList.add("invalid");
        }
        cPassField.classList.remove("invalid");

    window.location.href = 'index.html';
    return false;
    }

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        name();
        checkEmail();
        createPass();
        confirmPassword();
    });

</script>
</body>
</html>