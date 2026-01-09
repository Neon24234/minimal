<?php
require_once "connect.php";
header("Content-Type: application/json; charset=UTF-8");

// JSON beolvasása HTTP body-ból
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// JSON ellenőrzése
if (!$data || !isset($data['task'])) {
    http_response_code(400);
    echo json_encode(["error" => "Hibás vagy hiányzó JSON adat"]);
    exit;
}

$task = $data['task'];
$finished = isset($data['finished']) ? (int)$data['finished'] : 0;

// Prepared statement
$stmt = $conn->prepare(
    "INSERT INTO todo_list (task, finished) VALUES (?, ?)"
);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "SQL előkészítési hiba"]);
    exit;
}

// Paraméterek bindelése
$stmt->bind_param("si", $task, $finished);

// Végrehajtás
if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "id" => $stmt->insert_id
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "error" => "Adatbázis hiba",
        "details" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>  