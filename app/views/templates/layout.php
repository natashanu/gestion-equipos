<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?=APP_NAME?></title>
    <link rel="stylesheet" href="<?=BASE_URL?>/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
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
