<?php
    $users ??= [];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/assets/css/main.css">
    <title>Document</title>
</head>
<body>
    <form action="/example/create-user" method="post">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="password" name="password" placeholder="Password"><br>

        <input type="submit" value="Submit">
    </form>

    <h2>Users</h2>
    <ul>
        <?php foreach ($users as $user): ?>
            <li><?= var_dump($user) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
