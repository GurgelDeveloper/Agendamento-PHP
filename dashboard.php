<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}

include_once 'Database.php';
include_once 'Doctor.php';

$database = new Database();
$db = $database->getConnection();

$doctor = new Doctor($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Paciente</title>
    <link rel="stylesheet" href="./css/dashboard.css">
</head>
<body>
    <div class="container">
        <h1>Bem-vindo, <?php echo $_SESSION['patient_name']; ?></h1>
        <div class="link-container">
            <a href="select_specialization.php">Agendar Consulta</a><br>
            <a href="history.php">Histórico de Consultas</a><br>
        </div>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
