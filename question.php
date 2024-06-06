<?php
session_start();
require_once "db_connection.php";


function check_previous_question($user_id, $sequence, $conn) {
    if ($sequence == 1) {
        return true; 
    }

    $previous_sequence = $sequence - 1;
    $sql = "SELECT q.id FROM logs l
            JOIN questions q ON l.question_id = q.id
            WHERE l.user_id = '$user_id' AND q.sequence = '$previous_sequence' AND l.is_correct = 1";
    $result = $conn->query($sql);
    return ($result->num_rows > 0);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["qr"])) {
        $qrCode = $_GET["qr"];
        $user_id = $_SESSION["user_id"];
        $sql = "SELECT id, question, hint, sequence FROM questions WHERE qr_code = '$qrCode'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $question_id = $row["id"];
            $sequence = $row["sequence"];
            if (check_previous_question($user_id, $sequence, $conn)) {
                $_SESSION['question'] = $row["question"];
                $_SESSION['hint'] = $row["hint"];
                $_SESSION['question_id'] = $question_id;
            } else {
              
                echo "<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Redirecting...</title>
                    <script type='text/javascript'>
                        setTimeout(function() {
                            window.location.href = 'scan_panel.php';
                        }, 1400); 
                    </script>
                </head>
                <body>
                    <p>Musisz najpierw odpowiedzieć na poprzednie pytanie.</p>
                </body>
                </html>";
                exit();
            }
        } else {
            echo "Błąd: Nie znaleziono pytania dla tego kodu QR.";
            exit;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $qrCode = $_POST["qr_code"];
    $user_id = $_SESSION["user_id"];
    $question_id = $_POST["question_id"];
    $answer = strtolower($_POST["answer"]);

    $sql = "SELECT correct_answer, hint FROM questions WHERE id = '$question_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $correct_answer = $row["correct_answer"];
        $hint = $row["hint"];
        $is_correct = ($answer == $correct_answer) ? 1 : 0;

        $sql = "INSERT INTO logs (user_id, question_id, qr_code, answer, is_correct) 
                VALUES ('$user_id', '$question_id', '$qrCode', '$answer', '$is_correct')";
        if ($conn->query($sql) === TRUE) {
            if ($is_correct) {
                $_SESSION['hint'] = $hint;
                header("Location: hint.php");
                exit;
            } else {
                $message = "Błędna odpowiedź. Proszę spróbuj ponownie.";
            }
        } else {
            echo "Błąd: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Błąd: Nie znaleziono pytania.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pytanie</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon.svg" type="image/svg+xml">
</head>
<body>
    <h2>Pytanie</h2>
    <p class="pytanie"><?php echo isset($_SESSION['question']) ? $_SESSION['question'] : ''; ?></p> 
    <form id="questionForm" action="question.php" method="post" onsubmit="convertToLowercase()">
        <input type="hidden" name="question_id" value="<?php echo isset($_SESSION['question_id']) ? $_SESSION['question_id'] : ''; ?>"> 
        <input type="hidden" name="qr_code" value="<?php echo isset($qrCode) ? $qrCode : ''; ?>"> 
        <label for="answer">Odpowiedź:</label><br>
        <input type="text" id="answer" name="answer"><br><br>
        <input class="login" type="submit" value="Sprawdź">
    </form>

    <?php if (isset($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <a href="scan_panel.php">Powrót do skanera</a>
    
<script>
    function convertToLowercase() {
        var answerInput = document.getElementById("answer");
        answerInput.value = answerInput.value.toLowerCase();
    }
</script>

</body>
</html>
