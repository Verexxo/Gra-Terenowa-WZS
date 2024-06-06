<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}
require_once "db_connection.php";


$user_id = $_SESSION["user_id"];
$sql = "SELECT MAX(scanned_order) as last_order FROM logs WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$last_order = $result->fetch_assoc()['last_order'] ?? 0;
$next_order = $last_order + 1;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel skanowania</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon.svg" type="image/svg+xml">
</head>
<body>
    <h2>Skanowanie kodu QR</h2>
    <div id="qr-reader"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.0.0/html5-qrcode.min.js"></script>
<script>

    var html5QrcodeScanner = new Html5QrcodeScanner(
    "qr-reader", { fps: 200, qrbox: 250 });

    function onScanSuccess(qrCodeMessage) {
            
        html5QrcodeScanner.clear().then(_ => {
            window.location.href = "question.php?qr=" + qrCodeMessage;
        }).catch(error => {
        console.error("Nie udało się zatrzymać skanowania", error);
    });
}

html5QrcodeScanner.render(onScanSuccess);   
</script>
</body>
</html>
