<?php
if (isset($_GET['logout'])) {
    session_start();
    session_destroy();
    header("Location: /");
    exit;
}
?>
<a href="?logout=true">Se déconnecter</a>

<h1>Bienvenue <?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "inconnu" ?> 🚀🚀</h1>

