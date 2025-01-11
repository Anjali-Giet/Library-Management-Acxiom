<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['book_id'];
    $user_id = $_POST['user_id'];
    $issue_date = date('Y-m-d');
    $return_date = date('Y-m-d', strtotime('+7 days'));

    // Check if the book_id exists and is available
    $book_check_stmt = $conn->prepare("SELECT is_available FROM books WHERE book_id = ?");
    $book_check_stmt->bind_param('i', $book_id);
    $book_check_stmt->execute();
    $book_check_result = $book_check_stmt->get_result();

    if ($book_check_result->num_rows > 0) {
        $book = $book_check_result->fetch_assoc();

        if (!$book['is_available']) {
            die("Error: Book is not available for issue.");
        }

        // Check if the user_id exists
        $user_check_stmt = $conn->prepare("SELECT user_id FROM users WHERE user_id = ?");
        $user_check_stmt->bind_param('i', $user_id);
        $user_check_stmt->execute();
        $user_check_result = $user_check_stmt->get_result();

        if ($user_check_result->num_rows > 0) {
            // Insert transaction
            $stmt = $conn->prepare("INSERT INTO transactions (book_id, user_id, issue_date, return_date) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('iiss', $book_id, $user_id, $issue_date, $return_date);

            if ($stmt->execute()) {
                // Mark the book as unavailable
                $update_book_stmt = $conn->prepare("UPDATE books SET is_available = 0 WHERE book_id = ?");
                $update_book_stmt->bind_param('i', $book_id);
                $update_book_stmt->execute();

                echo "Book issued successfully!";
            } else {
                echo "Error: Could not issue the book.";
            }
        } else {
            die("Error: User ID does not exist.");
        }
    } else {
        die("Error: Book ID does not exist.");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link rel="stylesheet" href="backendstyle.css">
</head>
<body>
    <header>
        <h1>Transactions</h1>
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
        <label for="book_id">Book ID:</label>
        <input type="number" name="book_id" required>
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" required>
        <button type="submit">Issue Book</button>
    </form>
</body>
</html>
