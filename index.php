<?php
$route = $_SERVER['REQUEST_URI'];
$route = parse_url($route, PHP_URL_PATH);
$servername = "localhost";
$username   = "time_it_user";
$pwss       = "time_it@mysql";
$conn = mysqli_connect($servername, $username, $pwss);
date_default_timezone_set('Asia/Kolkata');

// Checking connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "USE time_it";
$conn->query($sql);
$sql = 'SELECT * FROM logs where CurrentMonth="' . substr(date('M'),0,3);
$result = $conn->query($sql);

if(substr(date('M'),0,3) == 'Feb')
{
    if(date('Y') % 4 == 0 && (date('Y') % 100 != 0 || date('Y') % 400 == 0))
    {
        $sql = 'SELECT * FROM logs WHERE CurrentMonth="Feb" AND CurrentYear='.date('Y');
        $result = $conn->query($sql);   
        $CurrentYear_F = date('Y');
        $CurrentDate_F = date(' h:i:s P');
        if($result->num_rows < 29)
        {
            for ($i=1; $i <= 29; $i++) { 
                $sql = "INSERT INTO logs (CurrentMonth,CurrentYear,CurrentDayIndex,CurrentTime,CurrentStatus,TODO,TimeStudied) VALUES ('Feb',$CurrentYear_F,$i,'$CurrentDate_F','Inactive','',0)";
                $result = $conn->query($sql);   
            }
        }
        
    }
    else
    {
        $sql = 'SELECT * FROM logs WHERE CurrentMonth="Feb" AND CurrentYear='.date('Y');
        $result = $conn->query($sql);   
        $CurrentYear_F = date('Y');
        $CurrentDate_F = date(' h:i:s P');
        if($result->num_rows < 28)
        {
            for ($i=1; $i <= 28; $i++) { 
                $sql = "INSERT INTO logs (CurrentMonth,CurrentYear,CurrentDayIndex,CurrentTime,CurrentStatus,TODO,TimeStudied) VALUES ($CurrentMonth_F,$CurrentYear_F,$i,'$CurrentDate_F','Inactive','',0)";
                $result = $conn->query($sql);   
            }
        }
    }
}
elseif(substr(date('M'),0,3) == 'Jan' || substr(date('M'),0,3) == 'Mar' || substr(date('M'),0,3) == 'MAY' OR substr(date('M'),0,3) == 'Jul' OR substr(date('M'),0,3) == 'Aug' OR substr(date('M'),0,3) == 'Oct' OR substr(date('M'),0,3) == 'Dec')//31 days
{
    $CurrentMonth_F = substr(date('M'),0,3);
    $sql = "SELECT * FROM logs WHERE CurrentMonth='$CurrentMonth_F' AND CurrentYear=".date('Y');
    $result = $conn->query($sql);   
    $CurrentYear_F = date('Y');
    $CurrentDate_F = date(' h:i:s P');
    if($result->num_rows < 31)
    {
        for ($i=1; $i <= 31; $i++) { 
            $sql = "INSERT INTO logs (CurrentMonth,CurrentYear,CurrentDayIndex,CurrentTime,CurrentStatus,TODO,TimeStudied) VALUES ('$CurrentMonth_F',$CurrentYear_F,$i,'$CurrentDate_F','Inactive','',0)";
            $result = $conn->query($sql);   
        }
    }
}
else
{
    $CurrentMonth_F = substr(date('M'),0,3);
    $sql = "SELECT * FROM logs WHERE CurrentMonth='$CurrentMonth_F' AND CurrentYear=".date('Y');
    $result = $conn->query($sql);   
    $CurrentYear_F = date('Y');
    $CurrentDate_F = date(' h:i:s P');
    if($result->num_rows < 30)
    {
        for ($i=1; $i <= 30; $i++) { 
            $sql = "INSERT INTO logs (CurrentMonth,CurrentYear,CurrentDayIndex,CurrentTime,CurrentStatus,TODO,TimeStudied) VALUES ('$CurrentMonth_F',$CurrentYear_F,$i,'$CurrentDate_F','Inactive','',0)";
            $result = $conn->query($sql);   
        }
    }
}

switch (true) {
    case $route === '/':
        // Load the home page
        include 'views/home.php';
        require ('views/nav.doc');
        break;

    case $route === '/upload':
        require('views/nav.doc');
        include 'views/uploads.php';
        break;

    case $route === '/pdf':
        require('views/nav.doc');
        include 'views/downloader.php';
        break;

    case $route === '/graphs':
        header('Content-Type: text/javascript');
        include 'js/downloader.js';
        break;

    case $route === '/logs':
        require('views/nav.doc');
        include 'views/Logs.php';
        break;

    case $route === '/ui':
        header('Content-Type: text/javascript');
        echo file_get_contents('js/ui.js');
        break;

    case $route === '/uic':
        header('Content-Type: text/css');
        echo file_get_contents('css/ui.css');
        break;

    case $route === '/fcss':
        header('Content-Type: text/css');
        echo file_get_contents('css/filemanager.css');
        break;
    case $route === '/filemanager':
        header('Content-Type: text/javascript');
        echo file_get_contents('js/filemanager.js');
        break;

    case $route === '/data':
        include 'data.php';
        break;
    case $route === '/textIcon':
        header('Content-Type: image/png');
        include 'images/FileIcon.png';
        break;
    case $route === '/audioIcon':
        header('Content-Type: image/png');
        include 'images/AudioIcon.png';
        break;
    case $route === '/emptyIcon':
        header('Content-Type: image/png');
        include 'images/emptyIcon.png';
        break;
    case $route === '/videoIcon':
        header('Content-Type: image/png');
        include 'images/VideoIcon.png';
        break;
    case $route === '/cameraIcon':
        header('Content-Type: image/png');
        include 'images/CameraIcon.png';
        break;

    case preg_match('/^\/preview\/(.+)$/', $route, $matches):
    $filename = basename($matches[1]); // Prevent directory traversal
    $filePath = "adx/$filename";
    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
    $mimeType = 'other';
    
    switch (strtolower($fileExtension)) {
        case 'jpg':
        case 'jpeg':
            $mimeType = 'image/jpeg';
            break;
        case 'png':
            $mimeType = 'image/png';
            break;
        case 'gif':
            $mimeType = 'image/gif';
            break;
        case 'mp3':
            $mimeType = 'audio/mpeg';
            break;
        case 'wav':
            $mimeType = 'video/wav';
            break;
        case 'ogg':
            $mimeType = 'video/ogg';
            break;
        case 'mp4':
            $mimeType = 'video/ogg';
            break;
        case 'pdf':
            $mimeType = 'application/pdf';
            header('Content-Disposition: inline; filename="' . $filename . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            break;
        // Add more MIME types as needed
        default:
            include ('views/nav.doc');
            $html = <<<O
            <a download href='/$filePath'> <pre><i>Click on me to download</i></pre></a>
            O;
            echo $html;
            readfile($filePath);
            exit;
        }
        if(substr($mimeType,0,5) == 'image')
        {
            include ('views/nav.doc');
            $html = <<<O
             <pre><i>Click on the image below to download</i></pre><a download href='/$filePath'><img id='previewImage' src='/$filePath' alt='Image'><i class="fa fa-shopping-cart" aria-hidden="true"></i></a> 
            O;
            echo $html;
            return;
        }
        elseif(substr($mimeType,0,5) == 'audio')
        {
            include ('views/nav.doc');
            $html = <<<O
            <a download href='/$filePath'> <pre><i>Click on me to download</i></pre></a><audio controls><source src='/$filePath'></audio><i class="fa fa-shopping-cart" aria-hidden="true"></i>
            O;
            echo $html;
            return;
        }
        elseif(substr($mimeType,0,5) == 'video')
        {
            include ('views/nav.doc');
            $html = <<<O
            <a download href='/$filePath'> <pre><i>Click on me to download</i></pre></a><video autoplay muted controls><source src='/$filePath'  type="video/mp4"></video>
            O;
            echo $html;
            return;
        }
        elseif( $mimeType == 'application/pdf')
        {
            include ('views/nav.doc');
            $html = <<<O
            <object class="pdf" data="/Files/$filename" width='100%' height='100%'></object>
            O;
            echo $html;
            return;
            header('Content-Type: ' . $mimeType);
            header('Content-Length: ' . filesize($filePath));
        }
    
        header('Content-Type: ' . $mimeType);
        header('Content-Length: ' . filesize($filePath));
        header('Contefsf: ' . $mimeType);
    // Output the file conten   t
        // readfile($filePath);
        break;

        case preg_match('/^\/adx\/(.+)$/', $route, $matches):
        $filename = basename($matches[1]); // Prevent directory traversal
        $filePath = "files/$filename";
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        $mimeType = '';
        
        
        switch (strtolower($fileExtension)) {
            case 'jpg':
            case 'jpeg':
                $mimeType = 'image/jpeg';
                break;
            case 'png':
                $mimeType = 'image/png';
                break;
            case 'gif':
                $mimeType = 'image/gif';
                break;
            case 'pdf':
                $mimeType = 'application/pdf';
                break;
            // Add more MIME types as needed
            default:
                // require('views/nav.doc');
                echo readfile($filePath);
                exit;
            }
            $fileType = substr($mimeType,0,5);
            header('Content-Type: ' . $mimeType);
            header('Content-Length: ' . filesize($filePath));
    
        // Output the file conten   t
            readfile($filePath);
        break;
        
        case preg_match('/^\/delete\/(.+)$/', $route, $matches):
            $filename = basename($matches[1]); // Prevent directory traversal
            $filePath = "files/$filename";
            $res = exec("rm -rf $filePath");
            header("Location: /upload");
            break;
    default:
        require('views/nav.doc');
        include 'views/404.php';
        break;
}
?>