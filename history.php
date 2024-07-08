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
$appointments = $appointment->getAppointmentsByPatient($_SESSION['patient_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Consultas</title>
    <link rel="stylesheet" href="./css/history.css">
</head>
<body>
    <div class="container">
        <h1>Histórico de Consultas</h1>
        <table border="1">
            <tr>
                <th>Data</th>
                <th>Médico</th>
                <th>Especialização</th>
                <th>Notas</th>
            </tr>
            <?php while ($row = $appointments->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['doctor_name']; ?></td>
                    <td><?php echo $row['specialization']; ?></td>
                    <td><?php echo $row['notes']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <a href="dashboard.php">Voltar</a>
    </div>
</body>
</html>
