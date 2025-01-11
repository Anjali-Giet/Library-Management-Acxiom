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
    <title>Library Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Library Management System</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="admin/reports.php">Reports</a></li>
                <li><a href="admin/transactions.php">Transactions</a></li>
                <li><a href="admin/maintenance.php">Maintenance</a></li>
                <li><a href="admin/add_membership.php">Membership</a></li>
                <li><a href="admin/add_book.php">Add Book</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Dynamic Content Loaded Here -->
        <section id="content">
            <!-- <h2>Welcome to the Library Management System</h2> -->
            <h3>Hello User!</h3>
            <img src="https://media.istockphoto.com/id/949118068/photo/books.jpg?s=612x612&w=0&k=20&c=1vbRHaA_aOl9tLIy6P2UANqQ27KQ_gSF-BH0sUjQ730=" alt="Library Image" id="library-image">
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Library Management System</p>
    </footer>
</body>
</html>