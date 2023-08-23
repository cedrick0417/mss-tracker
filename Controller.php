<?php

require_once 'User.php';
// Controller.php

class Controller
{
    public function login()
    {
        // Check if the login form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve the login credentials from the request
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Create a new User object with the provided credentials
            $user = new User($username, $password);

            // Validate the user credentials (you can replace this with your own validation logic)
            if ($this->validateUser($user)) {
                // User credentials are valid, set a session variable to indicate the user is logged in
                $_SESSION['user'] = $user->getUsername();

                // Redirect the user to a protected page or dashboard
                header('Location: dashboard.php');
                exit();
            } else {
                // Invalid login credentials, show an error message
                $errorMessage = 'Invalid username or password.';
            }
        }

        // Load the login view
        require 'login.php';
    }

    private function validateUser($user)
    {
        // Perform your own validation logic here
        // For example, check against a database or an array of valid users
        // You should also consider password hashing and salting for secure authentication

        // Simulating a successful login for demonstration purposes
        $validUsers = array(
          array('username' => 'admin', 'password' => 'password123'),
          array('username' => 'user', 'password' => 'password456')
        );

        foreach ($validUsers as $validUser) {
            if ($user->getUsername() === $validUser['username'] && $user->getPassword() === $validUser['password']) {
                return true;
            }
        }

        return false;
    }
}
