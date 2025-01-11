<?php
session_start();
include 'db.php';  // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user exists with the provided email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists and if the password matches
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables upon successful login
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            header('Location: index.php');  // Redirect to the home page
            exit();
        } else {
            echo "Invalid login credentials!";
        }
    } else {
        echo "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>
        <h1>Library Management System</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="registration.php">Register</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Login</h2>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <br><br>

            <button type="submit">Login</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Library Management System</p>
    </footer>
</body>
</html>
