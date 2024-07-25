<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$host = 'localhost';
$db = 'nmb'; // Set database name to 'nmb'
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$errors = [];
$item = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $about = $_POST['about'] ?? '';
    $image = $_FILES['image'] ?? null;

    // Input validation
    if (empty($category)) {
        $errors['category'] = 'Category is required';
    }
    if (empty($name)) {
        $errors['name'] = 'Name is required';
    }
    if (empty($price) || !is_numeric($price)) {
        $errors['price'] = 'Valid price is required';
    }
    if (empty($stock) || !is_numeric($stock)) {
        $errors['stock'] = 'Valid quantity is required';
    }
    if (empty($about)) {
        $errors['about'] = 'About is required';
    }
    if ($image && $image['error'] !== UPLOAD_ERR_OK) {
        $errors['image'] = 'Valid image is required';
    }

    // If no errors, process the form
    if (empty($errors)) {
        // Process the image upload
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $imagePath = $uploadDir . basename($image['name']);
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Save the item in the database
            $stmt = $pdo->prepare("INSERT INTO products (category, name, price, stock, about, image) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$category, $name, $price, $stock, $about, $imagePath])) {
                // Redirect or show success message
                header('Location: success.php');
                exit;
            } else {
                $errors['database'] = 'Failed to save the item';
            }
        } else {
            $errors['image'] = 'Failed to upload image';
        }
    }
}

// Include the form again, with errors and previously submitted data
include 'index.php';
?>
