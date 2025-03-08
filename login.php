<?php
// login.php
require 'functions.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        if (empty($username) || empty($password)) {
            $message = "Både användarnamn och lösenord måste anges.";
        } else {
            $message = register_user($username, $password);
        }
    } elseif (isset($_POST['login'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        if (empty($username) || empty($password)) {
            $message = "Både användarnamn och lösenord måste anges.";
        } elseif (authenticate_user($username, $password)) {
            header('Location: index.php');
            exit;
        } else {
            $message = "Felaktigt användarnamn eller lösenord.";
        }
    }
}
$title = "Login page";
include './header.php';
?>
<main class="main-content">
    <?php if ($message): ?>
        <pre class="cont"><?= htmlspecialchars($message) ?></pre>
    <?php endif; ?>
    <form class="center-content" style="display:flex; flex-direction: column; align-items: center;" method="post">
        <label for="">    <h2>Logga in</h2></label>
        <br>
        <input type="text" name="username" placeholder="Användarnamn" required>
        <input type="password" name="password" placeholder="Lösenord" required>
        <button type="submit" name="login">Logga in</button>
        <button type="submit" name="register">Spara ny användare</button>
    </form>
</main>
<?php include './includes/footer.php'; ?>