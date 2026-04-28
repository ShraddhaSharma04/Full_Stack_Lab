<?php
header("Content-Type: application/json");

$file = "comments.json";

$username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
$message = isset($_POST["message"]) ? trim($_POST["message"]) : "";

if ($username === "" || $message === "") {
    echo json_encode([
        "status" => "error",
        "message" => "Username and message are required."
    ]);
    exit;
}

if (!file_exists($file)) {
    $created = file_put_contents($file, "[]");

    if ($created === false) {
        echo json_encode([
            "status" => "error",
            "message" => "Unable to create comments.json file."
        ]);
        exit;
    }
}

$jsonData = file_get_contents($file);

if ($jsonData === false) {
    echo json_encode([
        "status" => "error",
        "message" => "Unable to read comments.json file."
    ]);
    exit;
}

$comments = json_decode($jsonData, true);

if (!is_array($comments)) {
    $comments = [];
}

$newId = 1;

if (count($comments) > 0) {
    $lastComment = end($comments);
    $newId = $lastComment["id"] + 1;
}

$newComment = [
    "id" => $newId,
    "username" => htmlspecialchars($username),
    "message" => htmlspecialchars($message),
    "time" => date("d-m-Y h:i:s A")
];

$comments[] = $newComment;

$saved = file_put_contents($file, json_encode($comments, JSON_PRETTY_PRINT));

if ($saved === false) {
    echo json_encode([
        "status" => "error",
        "message" => "Unable to save comment."
    ]);
    exit;
}

echo json_encode([
    "status" => "success",
    "message" => "Comment added successfully.",
    "comment" => $newComment
]);
?>