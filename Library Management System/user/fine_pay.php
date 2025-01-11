<?php
session_start();
include 'db.php';  // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_id = $_POST['transaction_id'];
    $fine_paid = $_POST['fine_paid'];

    // Debugging: Check if data is received correctly
    echo "Transaction ID: " . $transaction_id . "<br>";
    echo "Fine Paid: " . $fine_paid . "<br>";

    // Check if transaction_id exists in the database
    $stmt_check = $conn->prepare("SELECT * FROM transactions WHERE transaction_id = ?");
    $stmt_check->bind_param('i', $transaction_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Proceed with updating fine_paid
        $stmt = $conn->prepare("UPDATE transactions SET fine_paid = ? WHERE transaction_id = ?");
        $stmt->bind_param('di', $fine_paid, $transaction_id);
        
        // Execute the update query and check for errors
        if ($stmt->execute()) {
            echo "Fine paid successfully!";
        } else {
            echo "Error executing query: " . $stmt->error;
        }
    } else {
        echo "Transaction ID not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pay Fine</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>
        <h2>Pay Fine</h2>
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
        <label for="transaction_id">Transaction ID:</label>
        <input type="number" name="transaction_id" required>
        <br>
        <label for="fine_paid">Fine Amount:</label>
        <input type="number" name="fine_paid" required>
        <br>
        <button type="submit">Pay Fine</button>
    </form>
</body>
</html>
