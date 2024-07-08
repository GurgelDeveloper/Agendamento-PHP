<?php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}

include_once 'Database.php';

$database = new Database();
$db = $database->getConnection();

$doctor_id = $_POST['doctor_id'] ?? null;

if ($doctor_id === null) {
    echo "Médico não selecionado.";
    exit();
}

$query = "SELECT id, available_date FROM doctor_availabilities WHERE doctor_id = ?";
$stmt = $db->prepare($query);
$stmt->bindParam(1, $doctor_id);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecionar Data</title>
    <link rel="stylesheet" href="./css/date.css">
</head>
<body>
    <div class="container">
        <h1>Selecionar Data</h1>
        <form method="POST" action="book_appointment.php">
            <label for="appointment_date">Data e Horário:</label>
            <select name="appointment_date" required>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo htmlspecialchars($row['available_date']); ?>">
                        <?php echo htmlspecialchars($row['available_date']); ?>
                    </option>
                <?php endwhile; ?>
            </select><br>
            <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor_id); ?>">
            <input type="submit" value="Continuar">
        </form>
        <a href="select_doctor.php">Voltar</a>
    </div>
</body>
</html>
