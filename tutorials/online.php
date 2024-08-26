<?php
$id=$_REQUEST['id'];

// Replace this with your actual API endpoint
$externalApiUrl = 'https://fu-laravel.onrender.com/api/update-value?table_name=online&field_to_update=status&where_condition=5&new_value=online';

// Check if the request is coming from your domain
if ($_SERVER['HTTP_REFERER'] !== 'http://your-domain.com') {
    die('Access denied');
}

// Get the data sent in the request
$data = $_POST['data'];

try {
    // Make the external request using cURL
    $ch = curl_init($externalApiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5); // Prevent infinite redirects
    
    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if ($statusCode != 200) {
        throw new Exception("Request failed with status code $statusCode");
    }
    
    // Return the response to JavaScript
    header('Content-Type: application/json');
    echo json_encode(['result' => $response]);
    
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}

// Close the cURL session
curl_close($ch);

?>


?>
