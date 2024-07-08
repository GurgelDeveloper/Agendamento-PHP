<?php
session_start();
include_once 'Database.php';
include_once 'Patient.php';

$database = new Database();
$db = $database->getConnection();

$patient = new Patient($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient->email = $_POST['email'];
    $patient->password = $_POST['password'];

    if ($patient->login()) {
        $_SESSION['patient_id'] = $patient->id;
        $_SESSION['patient_name'] = $patient->name;
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['message'] = "Email ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Paciente</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="container">
        <h1>Login de Paciente</h1>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
        <form method="POST" action="login.php">
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            <label for="password">Senha:</label>
            <input type="password" name="password" required><br>
            <input class="btn" type="submit" value="Login">
        </form>
        <a href="register.php">Não tem uma conta? Cadastre-se</a>
    </div>
</body>
</html>
