<?php
include 'db.php';

$sql = "SELECT * FROM transactions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="backendstyle.css">
</head>
<body>
    
    <header>
        <h1>Reports</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="transactions.php">Transactions</a></li>
                <li><a href="maintenance.php">Maintenance</a></li>
                <li><a href="add_membership.php">Membership</a></li>
                <li><a href="add_book.php">Add Book</a></li>
            </ul>
        </nav>
    </header>
    <br/>
    <table border="1">
        <tr>
            <th>Transaction ID</th>
            <th>User ID</th>
            <th>Book ID</th>
            <th>Issue Date</th>
            <th>Return Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['transaction_id'] ?></td>
            <td><?= $row['user_id'] ?></td>
            <td><?= $row['book_id'] ?></td>
            <td><?= $row['issue_date'] ?></td>
            <td><?= $row['return_date'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>