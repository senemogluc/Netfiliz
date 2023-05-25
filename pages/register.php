<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="../style/authentication.css">
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="register.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="subscription">Subscription:</label>
        <select id="subscription" name="subscription" required>
            <option value="free">Free</option>
            <option value="student">Student</option>
            <option value="premium">Premium</option>
        </select><br><br>
        <label for="age_verification">Are you older than 18?</label>
        <input type="checkbox" id="age_verification" name="age_verification"><br><br>
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
        $ageVerification = isset($_POST["age_verification"]);

        
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
        // Perform username and password verification
        $errors = [];
        // check if the username is already taken
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $errors[] = "Username already taken. Please choose a different username.";
        }

        if (!isValidPassword($password)) {
            $errors[] = "Invalid password. Please choose a password with at least 8 characters.";
        }

        if (empty($errors)) {

            // Prepare and execute the query
            $stmt = $conn->prepare("INSERT INTO users (username, password, subscription, age_verification) VALUES (?, ?, ?, ?)");
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("sssi", $username, $hash, $subscription, $ageVerification);
            $stmt->execute();

            // Check if the query was successful
            if ($stmt->affected_rows === 1) {
                // Registration successful
                echo "Registration successful. Welcome, " . $username . "!";
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION["username"] = $username;

                // Check if the selected subscription is a paid subscription and age verification is checked
                if (($subscription === "student" || $subscription === "premium")) {
                    // Redirect to the payment page
                    header("Location: payment.php");
                    exit();
                } else {
                    // Redirect to moviezone.php or any other page
                    header("Location: moviezone.php");
                    exit();
                }
            } else {
                // Registration failed
                echo "Registration failed. Please try again.";
            }

            // Close the connection
            $stmt->close();
            $conn->close();
        } else {
            // Display errors
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
        }
    }

    // Function to validate the username
    function isValidUsername($username) {
        // Implement your username validation logic here
        // Return true if the username is not taken, otherwise return false
        return preg_match('/^[a-zA-Z0-9]{5,}$/', $username);
    }

    // Function to validate the password
    function isValidPassword($password) {
        // Implement your password validation logic here
        // Return true if the password is valid, otherwise return false
        return strlen($password) >= 8;
    }
    ?>
</body>
</html>
