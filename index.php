<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization"); 

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

header("Content-Type: application/json; charset=utf-8");

require 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("SELECT * FROM mouments WHERE id = ?");
        $stmt->execute([$id]);
        $moument = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($moument, JSON_UNESCAPED_UNICODE);
    } else {
        $stmt = $conn->query("SELECT * FROM mouments");
        $mouments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($mouments, JSON_UNESCAPED_UNICODE);
    }
}
?>
