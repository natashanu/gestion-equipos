<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__.'/../app/lib/Core.php';
require_once __DIR__.'/../app/config/config.php';

$init = new Core();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=APP_NAME?></title>
</head>
<body>
    <h2>Index</h2>
</body>
</html>