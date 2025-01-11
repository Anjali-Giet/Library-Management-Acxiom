<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');  // Redirect to login page if not logged in
    exit();
}

echo "Welcome, " . $_SESSION['name'] . "!";  // Display the user's name from the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Library Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>
        <h1>Library Management System</h1>
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

    <main>
        <section>
        <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
        <p>Your User ID is: <?php echo $_SESSION['user_id']; ?></p>
            <img src="https://media.istockphoto.com/id/949118068/photo/books.jpg?s=612x612&w=0&k=20&c=1vbRHaA_aOl9tLIy6P2UANqQ27KQ_gSF-BH0sUjQ730=" alt="Library Image" id="library-image">
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Library Management System</p>
    </footer>
</body>
</html>
