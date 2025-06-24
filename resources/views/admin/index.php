<?php
$migrations ??= [];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/assets/css/main.css">
    <title>Admin</title>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <h2>Migrations</h2>
        <ul>
            <?php foreach ($migrations as $migration) { ?>
                <li><?= htmlspecialchars($migration->name) ?></li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>
