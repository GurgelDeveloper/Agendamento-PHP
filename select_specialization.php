<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecionar Especialização</title>
    <link rel="stylesheet" href="./css/ss.css">
</head>
<body>
    <div class="container">
        <h1>Selecionar Especialização</h1>
        <div class="link-container">
            <form method="POST" action="select_doctor.php">
                <label for="specialization">Especialização:</label>
                <select name="specialization" required>
                    <option value="Cardiologia">Cardiologia</option>
                    <option value="Dermatologia">Dermatologia</option>
                    <option value="Pediatria">Pediatria</option>
                    <!-- Se for o caso adicione outras especializações-->
                </select><br>
                <input type="submit" value="Continuar">
            </form>
            <a href="dashboard.php">Voltar</a>
        </div>
    </div>
</body>
</html>
