<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="register.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Register">
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the form data
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Database connection details
        $host = "localhost";
        $database = "netfiliz";
        $dbUsername = "root";
        $dbPassword = "";

        // Create a connection
        $conn = new mysqli($host, $dbUsername, $dbPassword, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the query
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $username, $hash);
        $stmt->execute();
        
        // Check if the user exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        // Check if the query was successful
        if ($stmt->affected_rows === 1) {
            // Registration successful
            echo "Registration successful. Welcome, " . $username . "!";
            // Redirect to moviezone.php
            header("Location: moviezone.php");
        } else {
            // Registration failed
            echo "Registration failed. Please try again.";
        }

        // Close the connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
