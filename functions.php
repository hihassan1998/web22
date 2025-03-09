<?php
// start session for session uasge
session_start();

// Define the user file path
define('USER_FILE', 'uploads/users.txt');

// Check if the user is logged in
function is_logged_in()
{
    return isset($_SESSION['username']);
}

// Log out the user
function logout()
{
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

// Register a new user
function register_user($username, $password)
{
    // Open the user file for reading and writing with "a+"
    $handle = fopen(USER_FILE, 'a+');
    if (!$handle) {
        return "Error opening user file.";
    }

    // Read existing users to check for duplicates
    while (($user = fgets($handle)) !== false) {
        list($saved_username) = explode(';', rtrim($user, PHP_EOL));
        if (strcasecmp($saved_username, $username) == 0) {
            fclose($handle);
            return "Username is already taken.";
        }
    }

    // Hash the password and append the new user to the file
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $user_data = "$username;$hash" . PHP_EOL;
    fwrite($handle, $user_data);

    // Close file
    fclose($handle);

    return "User registered successfully!";
}

// Authenticate the user
function authenticate_user($username, $password)
{
    // Open the user file for reading only
    $handle = fopen(USER_FILE, 'r');
    if (!$handle) {
        return false;
    }

    // Check if the username and password match
    while (($user = fgets($handle)) !== false) {
        list($saved_username, $saved_hash) = explode(';', rtrim($user, PHP_EOL));
        if (
            strcasecmp($saved_username, $username) == 0 &&
            password_verify($password, $saved_hash)
        ) {
            $_SESSION['username'] = $username;
            fclose($handle);
            return true;
        }
    }

    // Close the file and return false if no match found
    fclose($handle);
    return false;
}
