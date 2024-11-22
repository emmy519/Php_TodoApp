<?php ob_start(); ?>

<h1>Ajouter une nouvelle tâche</h1>
<form action="/add" method="POST">
    <input type="text" name="task" placeholder="Entrez une tâche" required>
    <button type="submit">Ajouter</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php include "layout.php" ?>