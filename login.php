<?php
session_start();
require_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["loggedin"] = true;
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $username;
            if ($username === "admin") {
                header("Location: admin_panel.php");
            } else {
                header("Location: scan_panel.php");
            }
        } else {
            echo "Nieprawidłowe hasło.";
        }
    } else {
        echo "Nieprawidłowa nazwa użytkownika.";
    }
    $stmt->close();
    $conn->close();
}
?>
