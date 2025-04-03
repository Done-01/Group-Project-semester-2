<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WelcomePage</title>
    <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
</head>
<body>
    <?php
        session_start();
        // Import Nav Bar
        require_once 'NavigationBar.inc.php';
        // Import inactivity script
        require_once 'includes/InactivityScript.inc.php';
        // Import Database Connection script
        require_once 'includes/dbh.inc.php';

        $UserId = $_SESSION["UserId"];
    ?>
    <div id="test">
        <h2>Transactions Page</h2>

            <div class="transactionTables">
            <h3>Incoming</h3>
                <?php
                    $select_query = "SELECT * FROM Transactions WHERE ReceiverID = '$UserId'";
                    $result = $db -> query($select_query);

                    echo "<table>";
                    echo "<tr> <th>SenderID</th>
                            <th>ReceiverID</th>
                            <th>Time of Transaction</th>
                            <th>Amount</th> </tr>";
                    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                        $senderID= $row['SenderID'];
                        $receiverID=$row['ReceiverID'];
                        $transactionTime=$row['TransactionTime'];
                        $amount=$row['Amount'];
                        echo "<tr> 
                            <td>$senderID</td> 
                            <td>$receiverID</td>
                            <td>$transactionTime</td>
                            <td>$amount</td>
                            </tr>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                ?>

                <h3>Outgoing</h3>
                <?php
                    $select_query = "SELECT * FROM Transactions WHERE SenderID = '$UserId'";
                    $result = $db -> query($select_query);

                    echo "<table>";
                    echo "<tr> <th>SenderID</th>
                            <th>ReceiverID</th>
                            <th>Time of Transaction</th>
                            <th>Amount</th> </tr>";
                    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                        $senderID= $row['SenderID'];
                        $receiverID=$row['ReceiverID'];
                        $transactionTime=$row['TransactionTime'];
                        $amount=$row['Amount'];
                        echo "<tr> 
                            <td>$senderID</td> 
                            <td>$receiverID</td>
                            <td>$transactionTime</td>
                            <td>$amount</td>
                            </tr>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                ?>
            </div>
    </div>
</body>
</html>