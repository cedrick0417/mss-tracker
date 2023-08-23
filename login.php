<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user'])) {
    // Redirect to the main page or display a message
    header("Location: index.php");
    exit;
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the username and password (e.g., compare with the database)

    if ($username === 'admin' && $password === 'password') {
        // Set the user session variable
        $_SESSION['user'] = $username;

        // Redirect to the main page
        header("Location: index.php");
        exit;
    } else {
        // Display an error message (e.g., invalid credentials)
        $error = "Invalid username or password.";
    }
}
?>

<!-- Display your login form -->
<h1>Login</h1>
<?php if (isset($error)) : ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>
<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="submit" value="Login">
</form>
