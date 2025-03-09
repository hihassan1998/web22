<?php
// index.php
require 'functions.php';
if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}
if (isset($_POST['logout'])) {
    logout();
}
// title for the page
$title = "User Page";
// include header
include("./includes/header.php");
?>
<main class="main-content">
    <!-- Logout post form wit logout button -->
    <form style="display:flex; flex-direction: column; align-items: center;" method="post">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
        <br>
        <p>You are logged in.</p>
        <br>
        <p> How nice of you to login, nice to meet you :)</p>
        <br>
        <button type="submit" name="logout">Log Out</button>
    </form>

</main>
<!-- include footer -->
<?php include './includes/footer.php'; ?>