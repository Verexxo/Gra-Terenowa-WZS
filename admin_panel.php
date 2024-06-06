<?php
session_start();
require_once "db_connection.php";


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["username"] !== "admin") {
    header("location: login.php");
    exit;
}


$sqlGroups = "SELECT DISTINCT username AS group_name FROM users";
$resultGroups = $conn->query($sqlGroups);
$groups = [];
if ($resultGroups->num_rows > 0) {
    while ($row = $resultGroups->fetch_assoc()) {
        $groups[] = $row['group_name'];
    }
}


$selectedGroup = isset($_POST['group']) ? $_POST['group'] : (isset($groups[0]) ? $groups[0] : null);
$statistics = [];
if ($selectedGroup) {
    $sql = "SELECT q.id AS question_id, q.question, q.correct_answer, COUNT(l.id) AS total_attempts,
                   SUM(CASE WHEN l.is_correct = 1 THEN 1 ELSE 0 END) AS correct_attempts,
                   SUM(CASE WHEN l.is_correct = 0 THEN 1 ELSE 0 END) AS incorrect_attempts
            FROM logs l
            JOIN questions q ON l.question_id = q.id
            JOIN users u ON l.user_id = u.id
            WHERE u.username = '$selectedGroup'
            GROUP BY q.id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $statistics[] = $row;
        }
    }
}


$errors = [];
if ($selectedGroup) {
    $sqlErrors = "SELECT q.question, l.answer, q.correct_answer
                  FROM logs l
                  JOIN questions q ON l.question_id = q.id
                  JOIN users u ON l.user_id = u.id
                  WHERE u.username = '$selectedGroup' AND l.is_correct = 0";
    $resultErrors = $conn->query($sqlErrors);
    if ($resultErrors->num_rows > 0) {
        while ($row = $resultErrors->fetch_assoc()) {
            $errors[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Panel Administratora</h2>
    <form action="" method="post">
        <label for="group">Wybierz grupę użytkowników:</label>
        <select name="group" id="group">
            <?php foreach ($groups as $group) : ?>
                <option value="<?php echo $group; ?>" <?php echo $selectedGroup === $group ? 'selected' : ''; ?>><?php echo $group; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Pokaż statystyki">
    </form>

    <?php if ($selectedGroup && count($statistics) > 0) : ?>
        <h3>Statystyki dla grupy <?php echo $selectedGroup; ?></h3>
        <table>
            <tr>
                <th>Pytanie</th>
                <th>Liczba wszystkich prób</th>
                <th>Liczba poprawnych odpowiedzi</th>
                <th>Liczba błędnych odpowiedzi</th>
                <th>Podgląd błędów</th>
            </tr>
            <?php foreach ($statistics as $statistic) : ?>
                <tr>
                    <td><?php echo $statistic['question']; ?></td>
                    <td><?php echo $statistic['total_attempts']; ?></td>
                    <td><?php echo $statistic['correct_attempts']; ?></td>
                    <td><?php echo $statistic['incorrect_attempts']; ?></td>
                    <td><button onclick="openModal('<?php echo $statistic['question']; ?>')">Pokaż błędy</button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Błędy</h3>
            <table id="errorTable">
                <tr>
                    <th>Pytanie</th>
                    <th>Wprowadzona odpowiedź</th>
                    <th>Poprawna odpowiedź</th>
                </tr>
            </table>
        </div>
    </div>

    <script>
        function openModal(question) {
            var modal = document.getElementById("myModal");
            var modalContent = modal.querySelector(".modal-content");
            var errorTable = document.getElementById("errorTable");
            
            errorTable.innerHTML = '<tr><th>Pytanie</th><th>Wprowadzona odpowiedź</th><th>Poprawna odpowiedź</th></tr>';
            <?php foreach ($errors as $error) : ?>
                if ("<?php echo $error['question']; ?>" === question) {
                    var row = errorTable.insertRow();
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    cell1.innerHTML = "<?php echo $error['question']; ?>";
                    cell2.innerHTML = "<?php echo $error['answer']; ?>";
                    cell3.innerHTML = "<?php echo $error['correct_answer']; ?>";
                }
            <?php endforeach; ?>
            modal.style.display = "block";
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
    </script>

    <br>
    <a href="logout.php">Wyloguj</a>
</body>
</html>
