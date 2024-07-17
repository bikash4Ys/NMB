<?php
session_start();

if (!isset($_SESSION['order'])) {
    echo "注文データがありません。";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注文確認</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>個人情報入力</h1>
    <form action="confirm_order.php" method="post">
        <label for="name">名前:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="address">住所:</label>
        <input type="text" id="address" name="address" required>
        <br>
        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <button type="submit">注文確認</button>
    </form>
</body>
</html>
