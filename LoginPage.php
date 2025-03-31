<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/8b309bcba5.js" crossorigin="anonymous"></script>
    <title>Sign in</title>
</head>
<body>
<!-- The form box is the container for the form, the input-group is the container for the input fields, the input-field is the container for the input and icon, the btn-field is the container for the buttons. -->
<div class="container">
    <div class="form-box">
        <h1 id="title">Sign up</h1>
        <form action="loginScript.php" method="POST">
            <div class="input-group">
                <!-- Mulitple inputs so we have fields -->
                <div class="input-field" id="emailField">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="text" id="email" placeholder="Email">
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-users-rectangle"></i>
                    <input type="text" id="UserId" name="UserId" placeholder="Username" required>
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-key"></i>
                    <input type="password" id="Password" name="Password" placeholder="Password" required>
                </div>
                <!-- Paragraph text with an empty link for now-->
                <!-- <p>Forgot password? <a href="#">Click here</a></p> -->
                <div class="btn-field">
                    <button type="submit" id="registerBtn">Register</button>
                    <button type="submit" id="loginBtn" name = "submit" class="disable">Log in</button>
                </div>
            </div>
        </form>
        
    <!-- error handling -->
    </div>
    <h2><?php
        if(isset($_GET['error'])){
        $error = $_GET['error'];
        echo''. $error .'';
        }
    ?> </h2>
</div>
<!-- To change the log in and register pages, we just hide the namefield -->
<script>
    var logCount = 0;
    var registerCount = 0;
    loginBtn.onclick = function(){
        emailField.style.maxHeight = 0;
        title.innerHTML = "Log in"
        registerBtn.classList.add("disable")
        loginBtn.classList.remove("disable")
        registerCount=0;
        logCount++;
        if (logCount > 1) {
            loginBtn.type = "submit"
            }
        else {
            loginBtn.type = "button"
        }
    }

    

    registerBtn.onclick = function(){
        emailField.style.maxHeight = "60px";
        title.innerHTML = "Register"
        registerBtn.classList.remove("disable")
        loginBtn.classList.add("disable")
        logCount=0;
        registerCount++;
        if (registerCount > 1) {
            registerBtn.type = "button"///////////////////////////////////
            }
        else {
            registerBtn.type = "button"
        }
    }
</script>
</body>
</html>