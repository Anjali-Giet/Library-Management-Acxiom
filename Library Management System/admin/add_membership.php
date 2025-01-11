<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $duration = $_POST['duration'];
    $start_date = date('Y-m-d');
    $end_date = date('Y-m-d', strtotime("+$duration months"));

    // Check if user_id exists in the users table
    $check_query = "SELECT 1 FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // User exists, proceed with inserting the membership
        $stmt = $conn->prepare("INSERT INTO memberships (user_id, start_date, end_date) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $user_id, $start_date, $end_date);
        $stmt->execute();
        echo "Membership added successfully!";
    } else {
        echo "User ID does not exist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Membership</title>
    <link rel="stylesheet" href="backendstyle.css">
</head>
<body>
    
    <header>
    <h1>Add Membership</h1>
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
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" required>

        <label for="duration">Duration:</label>
        <select name="duration">
            <option value="6">6 months</option>
            <option value="12">1 year</option>
            <option value="24">2 years</option>
        </select>

        <button type="submit">Add Membership</button>
    </form>
</body>
</html>
