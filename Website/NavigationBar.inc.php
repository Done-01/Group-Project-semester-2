<script src="js/scripts.js"></script> 

<?php
    
    if (!isset($_SESSION['AdminStatus'])) { // Not Logged in

        echo    '<nav id="headerBar">
                    <h1 id="siteName"> MZ </h1>
                    <a href="LoginPage.php">Log In</a>
                </nav>
                <nav id="navigationBar">
                    <ul>
                        ! links for non logged in users can go here !
                    </ul>
                </nav>';
    }
    elseif ($_SESSION['AdminStatus'] == 1) { // Admin User
        
        echo   '<nav id="headerBar">
                    <h1 id="siteName"> MZ </h1>
                    <a href="includes/LogoutScript.inc.php">Log Out</a>
                </nav>
                <nav id="navigationBar">
                    <ul>
                        <li id="hamburger" onclick="test()"><a>☰</a></li>
                        <div id="toggle">
                        <li><a href="WelcomePage.php">Home</a></li>
                        <li><a href="SelectUser.php">Admin Settings</a></li>
                        </div>
                    </ul>
                </nav>';
    }
    elseif ($_SESSION['AdminStatus'] == 0) { // User Account
        
        echo    '<nav id="headerBar">
                    <h1 id="siteName"> MZ </h1>
                    <a href="includes/LogoutScript.inc.php">Log Out</a>
                </nav>
                <nav id="navigationBar">
                    <ul>
                        <li id="hamburger" onclick="test()"><a>☰</a></li>
                        <div id="toggle">
                        <li><a href="WelcomePage.php">Home</a></li>
                        <li><a href="AccountPage.php">Account</a></li>
                        <li><a href="TransferPage.php">Transfer</a></li>
                        <li><a href="TransactionsPage.php">Transactions</a></li>
                        </div>
                    </ul>
                </nav>';
    }

?>