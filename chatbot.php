<?php
$apiKey = "ENTER YOUR API KEY";

$userMessage = $_POST['message'] ?? '';
if (trim($userMessage) === '') {
    echo "Empty message";
    exit;
}

$data = [
    "model" => "meta-llama/llama-3.1-8b-instruct",
    "messages" => [
        ["role" => "user", "content" => $userMessage]
    ]
];

$ch = curl_init("https://openrouter.ai/api/v1/chat/completions");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $apiKey,
    "Content-Type: application/json",
    "HTTP-Referer: http://localhost",
    "X-Title: College Chatbot"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

echo $result['choices'][0]['message']['content']
     ?? ($result['error']['message'] ?? "AI error");