<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // 注文データの処理（例: データベースに保存）
    $response = ['success' => true];
} else {
    $response = ['success' => false, 'message' => '注文データが無効です。'];
}

echo json_encode($response);
?>
