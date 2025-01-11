<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_id = $_POST['transaction_id'];
    $return_date = date('Y-m-d');

    // Update the return date in the transactions table
    $stmt = $conn->prepare("UPDATE transactions SET return_date = ? WHERE transaction_id = ?");
    $stmt->bind_param('si', $return_date, $transaction_id);
    $stmt->execute();

    // Mark book as available
    $transaction = $conn->query("SELECT book_id FROM transactions WHERE transaction_id = $transaction_id");
    $transaction_data = $transaction->fetch_assoc();
    $book_id = $transaction_data['book_id'];

    $update_book = $conn->prepare("UPDATE books SET is_available = TRUE WHERE book_id = ?");
    $update_book->bind_param('i', $book_id);
    $update_book->execute();

    echo "Book returned successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Return Book</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    
    <header>
    <h2>Return Book</h2>
        <nav>
            <ul>
            <li><a href="index.php">Home</a></li>
                <li><a href="add_book.php">Book</a></li>
                <li><a href="fine_pay.php">Pay Fine</a></li>
                <li><a href="issue_book.php">Issue Book</a></li>
                <li><a href="return_book.php">Return Book</a></li>
                
        </nav>
    </header>
    <br/>
    <form method="POST">
        <label for="transaction_id">Transaction ID:</label>
        <input type="number" name="transaction_id" required>
        <br>
        <button type="submit">Return Book</button>
    </form>
</body>
</html>
