<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="style/authentication.css">
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="register.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="subscription">Subscription:</label>
        <select id="subscription" name="subscription">
            <option value="free">Free</option>
            <option value="student">Student</option>
            <option value="premium">Premium</option>
        </select><br><br>
        <input type="submit" value="Register">
    </form>

    <?php
    session_start();
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the form data
        $username = $_POST["username"];
        $password = $_POST["password"];
        $subscription = $_POST["subscription"];

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
        $stmt = $conn->prepare("INSERT INTO users (username, password, subscription) VALUES (?, ?, ?)");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $username, $hash, $subscription);
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
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION["username"] = $username;
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
