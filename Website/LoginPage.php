<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
    <div id="LoginContainer">
        <h1>Please Log In</h1>
        <form action="LoginScript.php" method="POST"> 
            <label for="UserId">User Id</label>
            <input type="text" id="UserId" name="UserId" required />
            <label for="Password">Password</label> 
            <input type="password" id="Password" name="Password" required />
            <button type="submit" name="submit">Log In</button> 
        </form> 
    </div>
</body>
</html>
