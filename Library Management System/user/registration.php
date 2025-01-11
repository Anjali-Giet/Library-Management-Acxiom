<?php
include 'db.php';  // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the query to insert a new user
    $stmt = $conn->prepare("INSERT INTO users (email, password, name) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $email, $hashed_password, $name);
    $stmt->execute();

    echo "Registration successful! <a href='login.php'>Login</a>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Library Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>
        <h1>Library Management System</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Register</h2>
        <form method="POST">
            <label for="name">Full Name:</label>
            <input type="text" name="name" required>
            <br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <br><br>

            <button type="submit">Register</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Library Management System</p>
    </footer>
</body>
</html>
