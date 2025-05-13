<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "employee";


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Байланыс қатесі: " . $conn->connect_error);
}


$name       = $_POST['name'] ?? '';
$dob        = $_POST['dob'] ?? '';
$gender     = $_POST['gender'] ?? '';
$province   = $_POST['province'] ?? '';
$district   = $_POST['district'] ?? '';
$street     = $_POST['street'] ?? '';
$phone      = $_POST['phone'] ?? '';
$experience = $_POST['experience'] ?? '';
$department = $_POST['department'] ?? '';
$position   = $_POST['position'] ?? '';
$salary     = $_POST['salary'] ?? '';


if (
    empty($name) || empty($dob) || empty($gender) || empty($province) ||
    empty($district) || empty($street) || empty($phone) || empty($experience) ||
    empty($department) || empty($position) || empty($salary)
) {
    die("Барлық өріс толтырылуы қажет.");
}


$sql = "INSERT INTO employees (name, dob, gender, province, district, street, phone, experience, department, position, salary)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


$stmt = $conn->prepare($sql);


if (!$stmt) {
    die("Сұранысты дайындау қатесі: " . $conn->error);
}

$stmt->bind_param("sssssssssss", $name, $dob, $gender, $province, $district, $street, $phone, $experience, $department, $position, $salary);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Мәлімет енгізу қатесі: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
