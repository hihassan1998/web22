<?php
// check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // check register button
    if (isset($_POST['register'])) {
        // Get the username and password from the form
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        // Check if the username or password entered
        if (empty($username) || empty($password)) {
            $message = "Both username and password must be given.";
        } else {
            // register user if username and password given
            $message = register_user($username, $password);
        }
    // Check if the "login" button was clicked
    } elseif (isset($_POST['login'])) {
        // Get the username and password from the form 
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        // check user name and passwordd
        if (empty($username) || empty($password)) {
            $message = "Both username and password must be given.";
        // authenticate user
        } elseif (authenticate_user($username, $password)) {
            // if authnticatation is succefull then redirect to index.php
            header('Location: index.php');
            exit;
        } else {
            // error message if authentication fails becaue of username or password
            $message = "Wrong username or password.";
        }
    }
}
