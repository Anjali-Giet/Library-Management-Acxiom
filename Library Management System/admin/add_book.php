<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $serial_number = $_POST['serial_number'];

    $stmt = $conn->prepare("INSERT INTO books (title, author, serial_number) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $title, $author, $serial_number);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="backendstyle.css">
</head>
<body>
<header>
        <h1>Add Book</h1>
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
    <form method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="author">Author:</label>
        <input type="text" name="author" required>

        <label for="serial_number">Serial Number:</label>
        <input type="text" name="serial_number" required>

        <button type="submit">Add Book</button>
    </form>
</body>
</html>