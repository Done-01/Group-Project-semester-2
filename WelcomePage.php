<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/Stylesheet.css">

    <title>Document</title>
</head>
<body>
<?php
        session_start();
        include 'NavigationBar.inc.php';
        require_once 'includes/InactivityScript.inc.php';
    ?>
    <div class="main" style = "margin: 0px 20px">
    <div class="text-center">
    <h1>Welcome</h1>
      <?php
            echo '<table class="table table-striped table-bordered">
                <thead>
                <tr>
                <th scope="col">User ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Login Time</th>
                <th scope="col">Admin Status</th>
                </tr>
            </thead>';

            $userid = $_SESSION['UserId'];
            $adminstatus = $_SESSION['AdminStatus'];
            $firstname = $_SESSION['FirstName'];
            $logintime = $_SESSION['LoginTime'];


            echo "    <tbody>
                        <tr>
                        <th scope='row'>$userid</th>
                        <td>$firstname</td>
                        <td>$logintime</td>
                        <td>$adminstatus</td>
                        <td>
                            <a href='AccountPage.php' class='btn btn-primary' >View Account</a> &nbsp;&nbsp;
                            <a href='TransferPage.php' class='btn btn-success' >Make a transfer</a>
                        </td>
                        </tr>
                    </tbody>";
            
            echo "</table>";
?>
    </div>
    </div>
</body>
</html>