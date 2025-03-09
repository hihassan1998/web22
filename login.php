<?php
// login.php
require 'functions.php';
// check login details and hanlde the login and give on screen messages
$message = '';
include "./handleLogin.php";
// title for the page
$title = "Login page";
// include header

include './includes/header.php';
?>
<main class="main-content">
    <!-- console log prinst -->
    <?php if ($message): ?>
        <pre class="cont"><?= htmlspecialchars($message) ?></pre>
    <?php endif; ?>
    <!-- Post request form -->
    <form class="center-content" style="display:flex; flex-direction: column; align-items: center;" method="post">
        <label for="">
            <h2>Log in and signup form</h2>
        </label>
        <br>
        <input type="text" name="username" placeholder="Användarnamn">
        <input type="password" name="password" placeholder="Lösenord">
        <button type="submit" name="login">Log in</button>
        <button type="submit" name="register">Save new user</button>
    </form>
</main>
<!-- include footer -->
<?php include './includes/footer.php'; ?>