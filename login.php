<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="style/authentication.css">
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>

    <p>Don't have an account? <a href="register.php">Sign Up</a></p>

    <?php
    session_start();
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
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();
        

        // Check if the user exists and the password is correct
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                // Successful login
                echo "Login successful. Welcome, " . $username . "!";
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION["username"] = $username;
                // Redirect to moviezone.php
                header("Location: moviezone.php");
            } else {
                // Invalid password
                echo "Invalid password.";
            }
        } else {
            // Invalid username
            echo "Invalid username.";
        }

        // Close the connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
