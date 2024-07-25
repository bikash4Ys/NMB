<?php
// Database connection
$host = 'localhost';
$db = 'NMB';
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

// Fetch items from database
$stmt = $pdo->query('SELECT * FROM products');
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2 class="h2">Menu</h2>
        <div class="row">
            <?php foreach ($items as $item): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= htmlspecialchars($item['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($item['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($item['about']) ?></p>
                            <p class="card-text"><strong>Price:</strong> ¥<?= htmlspecialchars($item['price']) ?></p>
                            <p class="card-text"><strong>Stock:</strong> <?= htmlspecialchars($item['stock']) ?></p>
                            <p class="card-text"><strong>Category:</strong> <?= htmlspecialchars($item['category']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
