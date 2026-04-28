<?php
header("Content-Type: application/json");

if (!isset($_FILES["textFile"])) {
    echo json_encode([
        "status" => "error",
        "message" => "No file uploaded."
    ]);
    exit;
}

$file = $_FILES["textFile"];

if ($file["error"] !== UPLOAD_ERR_OK) {
    echo json_encode([
        "status" => "error",
        "message" => "File upload error."
    ]);
    exit;
}

$fileName = $file["name"];
$fileTmpPath = $file["tmp_name"];
$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

if ($fileExtension !== "txt") {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid file type. Only .txt files are allowed."
    ]);
    exit;
}

$content = file_get_contents($fileTmpPath);

if ($content === false) {
    echo json_encode([
        "status" => "error",
        "message" => "Unable to read uploaded file."
    ]);
    exit;
}

if (trim($content) === "") {
    echo json_encode([
        "status" => "error",
        "message" => "Uploaded file is empty."
    ]);
    exit;
}

$lines = preg_split("/\r\n|\n|\r/", $content);
$lineCount = count($lines);

$words = str_word_count(strtolower($content), 1);

$wordCount = count($words);

$frequency = [];

foreach ($words as $word) {
    if (isset($frequency[$word])) {
        $frequency[$word]++;
    } else {
        $frequency[$word] = 1;
    }
}

arsort($frequency);

$mostFrequentWord = array_key_first($frequency);

echo json_encode([
    "status" => "success",
    "message" => "File analyzed successfully.",
    "word_count" => $wordCount,
    "line_count" => $lineCount,
    "most_frequent_word" => $mostFrequentWord
]);
?>