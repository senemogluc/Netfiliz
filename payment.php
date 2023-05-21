<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the payment details from the form
    $name = $_POST['name'];
    $cardNumber = $_POST['card_number'];
    $expiryMonth = $_POST['expiry_month'];
    $expiryYear = $_POST['expiry_year'];
    $cvv = $_POST['cvv'];

    // Perform validation on the payment details
    $errors = [];
    if (empty($name)) {
        $errors[] = 'Please enter your name';
    }
    if (empty($cardNumber) || !is_numeric($cardNumber)) {
        $errors[] = 'Please enter a valid card number';
    }
    if (empty($expiryMonth) || empty($expiryYear) || !is_numeric($expiryMonth) || !is_numeric($expiryYear)) {
        $errors[] = 'Please enter a valid expiry date';
    }
    if (empty($cvv) || !is_numeric($cvv)) {
        $errors[] = 'Please enter a valid CVV';
    }

    // If there are no errors, process the payment
    if (empty($errors)) {
        // Place your payment processing logic here
        // This is where you would interact with a payment gateway or perform any necessary operations

        // For the sake of this example, let's assume the payment is successful
        $paymentStatus = 'success';

        // Redirect to success.php
        header("Location: success.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <link rel="stylesheet" href="style/payment.css">
</head>
<body>
    <?php if (isset($paymentStatus) && $paymentStatus === 'success'): ?>
        <h1>Payment Successful!</h1>
        <p>Thank you for your payment.</p>
    <?php else: ?>
        <h1>Payment Page</h1>
        <?php if (!empty($errors)): ?>
            <div style="color: red;">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" required><br><br>

            <label for="expiry_month">Expiry Month:</label>
            <select id="expiry_month" name="expiry_month" required>
                <option value="">Select Month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select><br><br>

            <label for="expiry_year">Expiry Year:</label>
            <select id="expiry_year" name="expiry_year" required>
                <option value="">Select Year</option>
                <?php
                $currentYear = date('Y');
                for ($year = $currentYear; $year <= $currentYear + 10; $year++) {
                    echo "<option value='$year'>$year</option>";
                }
                ?>
            </select><br><br>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required><br><br>

            <input type="submit" value="Pay">
        </form>
    <?php endif; ?>
</body>
</html>
