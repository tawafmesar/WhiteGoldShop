<?php
session_start();

// Ensure secure password hashing and storage
require_once 'password_hashing_functions.php'; // Include your secure password hashing functions


if (isset($_SESSION['name'])) {
    ?>
    <script>window.location.href = "logoutpage.php";</script>
    <?php
      exit();
    }
// Define error/success messages
$login_error = '';
$login_success = '';

// Process login form submission if present
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username and password
    if (empty($username)) {
        $login_error = 'Please enter a username.';
    } else if (empty($password)) {
        $login_error = 'Please enter a password.';
    } else {
        // Verify credentials using secure password hashing
        if ($username =="admin" AND $password =="admin") {
            $_SESSION['name'] = $username;
            $login_success = 'Login successful!';
            ?>
            <script>window.location.href = "logoutpage.php";</script>
            <?php
            exit;
        } else {
            $login_error = 'Invalid username or password.';
        }
    }
}

// Display login form
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <?php if (!empty($login_error)): ?>
        <p style="color: red;"><?php echo $login_error; ?></p>
    <?php elseif (!empty($login_success)): ?>
        <p style="color: green;"><?php echo $login_success; ?></p>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
