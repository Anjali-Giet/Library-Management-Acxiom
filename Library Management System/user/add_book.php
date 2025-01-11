<?php
include 'db.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];

    // Check if the book already exists in the table
    $checkStmt = $conn->prepare("SELECT book_id FROM books WHERE title = ? AND author = ?");
    $checkStmt->bind_param('ss', $title, $author);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // Book exists, fetch its book_id
        $checkStmt->bind_result($book_id);
        $checkStmt->fetch();
        echo "Book is available in the library with ID: " . $book_id;
    } else {
        // Book doesn't exist
        echo "The specified book is not available in the library.";
    }

    $checkStmt->close();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check Book</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>
        <h2>Check Book Availability</h2>
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
        <label for="title">Book Title:</label>
        <input type="text" name="title" required>
        <br>
        <label for="author">Author:</label>
        <input type="text" name="author" required>
        <br>
        <button type="submit">Check Availability</button>
    </form>
</body>
</html>

