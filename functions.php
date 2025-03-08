<?php
// functions.php
session_start();

define('USER_FILE', 'uploads/users.txt');

function is_logged_in() {
    return isset($_SESSION['username']);
}

function logout() {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

function register_user($username, $password) {
    if (!file_exists(USER_FILE)) {
        file_put_contents(USER_FILE, '');
    }
    
    $users = file(USER_FILE, FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($saved_username) = explode(';', $user);
        if (strcasecmp($saved_username, $username) == 0) {
            return "Användarnamnet finns redan.";
        }
    }
    
    $hash = password_hash($password, PASSWORD_DEFAULT);
    file_put_contents(USER_FILE, "$username;$hash" . PHP_EOL, FILE_APPEND);
    return "Användare registrerad!";
}

function authenticate_user($username, $password) {
    if (!file_exists(USER_FILE)) {
        return false;
    }
    
    $users = file(USER_FILE, FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($saved_username, $saved_hash) = explode(';', $user);
        if (strcasecmp($saved_username, $username) == 0 && password_verify($password, $saved_hash)) {
            $_SESSION['username'] = $username;
            return true;
        }
    }
    return false;
}
?>
