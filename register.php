<?php
session_start();
include_once 'Database.php';
include_once 'Patient.php';

$database = new Database();
$db = $database->getConnection();

$patient = new Patient($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient->name = $_POST['name'];
    $patient->email = $_POST['email'];
    $patient->password = $_POST['password'];

    if ($patient->register()) {
        $_SESSION['message'] = "Cadastro realizado com sucesso!";
    } else {
        $_SESSION['message'] = "Erro ao realizar cadastro.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Paciente</h1>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
        <form method="POST" action="register.php">
            <label for="name">Nome:</label>
            <input type="text" name="name" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            <label for="password">Senha:</label>
            <input type="password" name="password" required><br>
            <input class="btn" type="submit" value="Cadastrar">
        </form>
        <a href="login.php">Já tem uma conta? Faça login</a>
    </body>
    </div>
</html>
