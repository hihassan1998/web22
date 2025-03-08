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
$title= "User Page";
include("header.php");
?>
<main class="main-content">
    <form style="display:flex; flex-direction: column; align-items: center;" method="post">
        <h2>Välkommen, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
       
        <p>Du är inloggad.</p>
        <br>
        <br>
        <button type="submit" name="logout">Logga ut</button>
    </form>

</main>
<?php include './includes/footer.php'; ?>