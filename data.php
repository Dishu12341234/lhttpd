
<?php


$route = isset($_GET['route']) ? $_GET['route'] : '/';
$servername = "localhost";
$username   = "time_it_user";
$pwss       = "time_it@mysql";
$conn = mysqli_connect($servername, $username, $pwss);
date_default_timezone_set('Asia/Kolkata');

// Checking connection
if (!$conn) {
    die();
}


$sql = "USE time_it";
$conn->query($sql);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the raw POST data (JSON)
    $data = json_decode(file_get_contents("php://input"), true);

    $sql = "UPDATE logs set ";
    $reqBody = array();
    $CurrentMonth = $data  ["CurrentMonth"];
    $CurrentDayIndex = $data  ["CurrentDayIndex"];
    $CurrentYear = $data  ["CurrentYear"];
    $sqlq = "SELECT CurrentDayIndex,TimeStudied FROM logs WHERE CurrentMonth='$CurrentMonth' AND CurrentDayIndex='$CurrentDayIndex' AND CurrentYear='$CurrentYear' AND TimeStudied!=0";
    $resq = $conn->query($sqlq);
    foreach ($data as $key => $value) {
        if($key == "TimeStudied")
        {
            if($resq)
            {
                $increment = $value;
                $sql = $sql."$key=TimeStudied + $increment,";
            }
        }
        else
        {
            $sql = $sql."$key='$value',";
        }
    }



    $sql = substr($sql,0,strlen($sql)-1);
    $sql = $sql . " WHERE CurrentMonth='$CurrentMonth' AND CurrentDayIndex='$CurrentDayIndex' AND CurrentYear=$CurrentYear";
    file_put_contents("log.txt", print_r($sql, true), FILE_APPEND);
    $res = $conn->query($sql);

    // Log the request and any errors
    $file = fopen("gfg.txt", 'w');
    if ($file) {
        foreach ($data as $key => $value) {
            fwrite($file, "$key: $value\n");
        }
        fwrite($file, "SQL Error: " . mysqli_error($conn) . "\n");
        fclose($file);
    }
    
    // Check if data is received and valid
    if ($data) {
        // Send the response
        echo json_encode([
            'message' => '$message',
        ]);
    } else {
        echo json_encode(['message' => 'No valid JSON data received']);
    }
} else {
    // Handle invalid request method
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
}
?>
