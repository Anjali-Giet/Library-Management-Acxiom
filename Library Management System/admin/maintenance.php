<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_book'])) {
        $book_id = $_POST['book_id'];
        $title = $_POST['title'];
        $author = $_POST['author'];

        $stmt = $conn->prepare("UPDATE books SET title = ?, author = ? WHERE book_id = ?");
        $stmt->bind_param('ssi', $title, $author, $book_id);
        $stmt->execute();
    } elseif (isset($_POST['delete_book'])) {
        $book_id = $_POST['book_id'];

        $stmt = $conn->prepare("DELETE FROM books WHERE book_id = ?");
        $stmt->bind_param('i', $book_id);
        $stmt->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>
    <link rel="stylesheet" href="backendstyle.css">
</head>
<body>

    <header>
        <h1>Maintenance</h1>
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
        <h2>Update Book</h2>
        <label for="book_id">Book ID:</label>
        <input type="number" name="book_id" required>

        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="author">Author:</label>
        <input type="text" name="author" required>

        <button type="submit" name="update_book">Update Book</button>
    </form>

    <form method="POST">
        <h2>Delete Book</h2>
        <label for="book_id">Book ID:</label>
        <input type="number" name="book_id" required>

        <button type="submit" name="delete_book">Delete Book</button>
    </form>
</body>
</html>

