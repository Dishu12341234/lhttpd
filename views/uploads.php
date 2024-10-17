<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filemanager</title>
    <link rel="stylesheet" href="fcss">
    <script src='filemanager' defer></script>
</head>
<body>
    <div class="files" id="files">

<?php
$files = scandir('files');
arsort($files);
foreach ($files as $key => $value) {
    $filePath = "files/$value";
    $filePreview = "";
    if (is_file($filePath)) {
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        switch ($fileExtension) {
            case 'pdf':
              $filePreview = <<<O
                    <object class="pdf" data="/adx/$value" width='150px'></object>
                    O;
                break;

            case 'mp4':
            case 'ogg':
            case 'webm':
                $filePreview = <<<O
                    <video loop autoplay muted width="150">
                    <source src="/adx/$value" type="video/webm"/>
                    </video>
                    O;
                break;

            case 'mp3':
            case 'wav':
                $filePreview = <<<O
                    <img src='audioIcon' src='text'>
                    <br>
                    O;
                break;

            case 'png':
            case 'jpg':
            case 'jpeg':
            case 'webp':
                $filePreview = <<<O
                    <img width='150px' src='/adx/$value' src='text'>
                    O;
                break;

            default:
                $filePreview = "<img src='emptyIcon' src='text'>";
                break;
                break;
        }
        $exv = $value;
        if (strlen($value) >= 10) {
            $value = chunk_split($value, 10, '<br>');
        }
        $html = <<<O
          
          <div class='fileWrapper'>
          <a href='/delete/$exv'>
          <i class="glyphicon glyphicon-trash"></i>
          </a>
          <p>$value</p><br>$filePreview
          </div>
        O;
        echo $html;
    }

}
?>
    </div>
    <form action="upload" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" id='finp' name="fileToUpload" id="fileToUpload">
        <br>
        <input type="submit" id='filesd' value="Upload Image" name="submit">
      </form>
</body>
</html>


<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $target_dir = "files/";
    $target_file = $target_dir . basename(preg_replace('/\s+/', '', $_FILES["fileToUpload"]["name"]));
    $target_file = preg_replace("/[^a-zA-Z0-9.\/\\\\]/", "", $target_file);
    echo $target_file;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 100000000) {
        echo "Sorry, your file is too large.";
        echo $_FILES["fileToUpload"]["size"];
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<p id='uploadStats'>ups</p>";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
