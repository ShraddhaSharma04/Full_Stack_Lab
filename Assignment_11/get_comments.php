<?php
header("Content-Type: application/json");

$file = "comments.json";

if (!file_exists($file)) {
    echo json_encode([
        "status" => "success",
        "message" => "No comments found.",
        "comments" => []
    ]);
    exit;
}

$jsonData = file_get_contents($file);

if ($jsonData === false) {
    echo json_encode([
        "status" => "error",
        "message" => "Unable to read comments.json file.",
        "comments" => []
    ]);
    exit;
}

$comments = json_decode($jsonData, true);

if (!is_array($comments)) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid JSON format in comments.json.",
        "comments" => []
    ]);
    exit;
}

echo json_encode([
    "status" => "success",
    "message" => "Comments fetched successfully.",
    "comments" => $comments
]);
?>