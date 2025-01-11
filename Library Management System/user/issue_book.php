<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['book_id'];
    $user_id = $_POST['user_id'];
    $issue_date = date('Y-m-d');
    $return_date = date('Y-m-d', strtotime("+14 days"));

    // Insert transaction into the database
    $stmt = $conn->prepare("INSERT INTO transactions (book_id, user_id, issue_date, return_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('iiss', $book_id, $user_id, $issue_date, $return_date);
    $stmt->execute();

    // Get the last inserted transaction id
    $transaction_id = $conn->insert_id;

    // Mark book as not available
    $update_book = $conn->prepare("UPDATE books SET is_available = FALSE WHERE book_id = ?");
    $update_book->bind_param('i', $book_id);
    $update_book->execute();

    echo "Book issued successfully! Transaction ID: " . $transaction_id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Issue Book</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>
        <h2>Issue Book</h2>
        <nav>
            <ul>
            <li><a href="index.php">Home</a></li>
                <li><a href="add_book.php">Book</a></li>
                <li><a href="fine_pay.php">Pay Fine</a></li>
                <li><a href="issue_book.php">Issue Book</a></li>
                <li><a href="return_book.php">Return Book</a></li>
            </ul>
        </nav>
    </header>
    <br/>
    <form method="POST">
        <label for="book_id">Book ID:</label>
        <input type="number" name="book_id" required>
        <br>
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" required>
        <br>
        <button type="submit">Issue Book</button>
    </form>
</body>
</html>
