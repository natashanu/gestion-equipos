<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?=APP_NAME?></title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <?php
        if (isset($slot)) {
            include $slot;
        }
        ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
