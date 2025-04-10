<?php
if(isset($_GET['role']) && isset($_GET['prompt']) && $_GET['role'] != '' && $_GET['prompt'] != '') {
    $api_url = "https://api.groq.com/openai/v1/chat/completions";
    $api_key = "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";
    // Request payload
    $data = [
        "model" => "llama-3.3-70b-versatile",
        "messages" => [
            [
                "role" => "system",
                "content" => $_GET['role']
            ],
            [
                "role" => "user",
                "content" => $_GET['prompt']
            ]
        ]
    ];

    // Initialize cURL
    $ch = curl_init($api_url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . $api_key
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute request and capture response
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo "cURL error: " . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    // Decode JSON response
    $json_response = json_decode($response, true);

    // Print JSON response
    header('Content-Type: application/json');
    echo json_encode($json_response, JSON_PRETTY_PRINT);
} else {
    echo "Something went wrong";
}
?>
