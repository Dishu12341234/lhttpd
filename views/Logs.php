<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs</title>
    <style>
        /* Body styles */
        body {
            background-color: #2b2b2b;
            color: #f0f0f0;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Container for logs */
        .log-container {
            width: 90%;
            margin: 50px auto;
            background-color: #1c1c1c;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            padding: 20px;
            max-width: 1200px;
        }

        /* Data block styles */
        .data {
            background-color: #555;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s, background-color 0.3s ease;
        }

        .data:hover {
            transform: translateY(-5px);
            background-color: #777;
        }

        /* Heading styles */
        h1 {
            text-align: center;
            font-size: 3em;
            margin-bottom: 20px;
            color: #ff0066;
        }

        /* Horizontal rules (between log entries) */
        hr {
            border: none;
            height: 1px;
            background-color: #444;
            margin: 10px 0;
        }

        /* Responsive font sizes */
        @media (max-width: 768px) {
            h1 {
                font-size: 2em;
            }

            .log-container {
                width: 95%;
            }
        }
    </style>
</head>
<body>

    <div class="log-container">
        <h1>Logs</h1>

        <?php 
        // PHP: Database connection
        $servername = "localhost";
        $username = "time_it_user";
        $pwss = "time_it@mysql";
        $conn = mysqli_connect($servername, $username, $pwss);
        date_default_timezone_set('Asia/Kolkata');

        // Checking connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "USE time_it";
        $conn->query($sql);

        // Query to fetch logs where TODO is not empty
        $sql = "SELECT * FROM logs WHERE TimeStudied!=''";
        $result = $conn->query($sql);

        // If there are results, display them
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='data'>";
                foreach ($row as $key => $value) {
                    echo "<strong>" . htmlspecialchars($key) . ":</strong> " . htmlspecialchars($value) . "<br>";
                }
                echo "</div>";
                echo "<hr>";
            }
        } else {
            echo "<p>No data entry</p>";
        }

        // Closing the connection
        $conn->close();
        ?>
    </div>

</body>
</html>
