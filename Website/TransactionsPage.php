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
        // Import transactions tables script
        require_once 'includes/transactionsScript.inc.php';
    ?>

    <div id="test">
        <h2>Transactions Page</h2>
        <div class="transactionTables">
            <h3>Incoming</h3>
            <table>
                <th>
                    <tr>
                        <th>SenderID</th>
                        <th>ReceiverID</th>
                        <th>Time of Transaction</th>
                        <th>Amount</th>
                    </tr>
                </th>
                <tb>
                    <?php while ($row = $incomingTransactions->fetchArray(SQLITE3_ASSOC)): ?>
                        <tr>
                            <td><?= $row['SenderID'] ?></td>
                            <td><?= $row['ReceiverID'] ?></td>
                            <td><?= $row['TransactionTime'] ?></td>
                            <td><?= $row['Amount'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tb>
            </table>

            <h3>Outgoing</h3>
            <table>
                <th>
                    <tr>
                        <th>SenderID</th>
                        <th>ReceiverID</th>
                        <th>Time of Transaction</th>
                        <th>Amount</th>
                    </tr>
                </th>
                <tb>
                    <?php while ($row = $outgoingTransactions->fetchArray(SQLITE3_ASSOC)): ?>
                        <tr>
                            <td><?= $row['SenderID'] ?></td>
                            <td><?= $row['ReceiverID'] ?></td>
                            <td><?= $row['TransactionTime'] ?></td>
                            <td><?= $row['Amount'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tb>
            </table>
        </div>
    </div>
</body>
</html>