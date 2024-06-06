<?php
session_start();
if (!isset($_SESSION['hint'])) {
    header("Location: scan_panel.php");
    exit;
}
$hint = $_SESSION['hint'];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wskazówka</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon.svg" type="image/svg+xml">
</head>
<body>
    <h2>Wskazówka</h2>
    <p><?php echo htmlspecialchars($hint); ?></p>
    <a href="scan_panel.php">Powrót do skanera</a>
    
</body>
</html>
