<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}

include_once 'Database.php';
include_once 'Appointment.php';

$database = new Database();
$db = $database->getConnection();

$appointment = new Appointment($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment->patient_id = $_SESSION['patient_id'];
    $appointment->doctor_id = $_POST['doctor_id'];
    $appointment->appointment_date = $_POST['appointment_date'];
    $appointment->notes = $_POST['notes'] ?? '';

    if ($appointment->create()) {
        $_SESSION['message'] = "Consulta agendada com sucesso!";
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['message'] = "Erro ao agendar consulta.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Consulta</title>
</head>
<body>
    <h1>Agendar Consulta</h1>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
    <form method="POST" action="book_appointment.php">
        <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($_POST['doctor_id']); ?>">
        <label for="appointment_date">Data e Horário:</label>
        <input type="text" name="appointment_date" value="<?php echo htmlspecialchars($_POST['appointment_date']); ?>" readonly><br>
        <label for="notes">Notas:</label>
        <textarea name="notes"></textarea><br>
        <input type="submit" value="Agendar">
    </form>
    <a href="select_date.php">Voltar</a>
</body>
</html>
