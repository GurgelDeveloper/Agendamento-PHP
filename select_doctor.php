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
$specialization = $_POST['specialization'];

$doctors = $doctor->getDoctorsBySpecialization($specialization);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecionar Médico</title>
    <link rel="stylesheet" href="./css/doctor.css">
</head>
<body>
    <div class="container">
        <h1>Selecionar Médico</h1>
        <form method="POST" action="select_date.php">
            <input type="hidden" name="specialization" value="<?php echo htmlspecialchars($specialization); ?>">
            <label for="doctor">Médico:</label>
            <select name="doctor_id" required>
                <?php while ($row = $doctors->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo htmlspecialchars($row['id']); ?>">
                        <?php echo htmlspecialchars($row['name']) . " - " . htmlspecialchars($row['specialization']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <input type="submit" value="Continuar">
        </form>
        <a href="select_specialization.php">Voltar</a>
    </div>
</body>
</html>
