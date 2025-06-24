
<?php
$users ??= [];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/assets/css/main.css">
    <title>Users</title>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <h2>Users</h2>
        <ul>
            <?php foreach ($users as $user) { ?>
                <li><?= $user->getFullName() ?></li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>
