<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="uic">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downloads</title>
    <script src="graphs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/helpers.esm.min.js"></script>

    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            background-color: #1f1f1f;
            color: #f0f0f0;
            font-family: 'Arial', sans-serif;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Canvas styling */
        canvas#graph {
            max-width: 90%;
            width: 600px;
            height: 350px;
            background-color: #2c2c2c;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            margin-top: 20px;
        }

        /* Dropdown styling */
        .dropdown {
            position: relative;
            display: inline-block;
            margin-top: 20px;
        }

        .dropdown button {
            background-color: #ff5252;
            color: white;
            padding: 12px 24px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .dropdown button:hover {
            background-color: #af2222;
            transform: scale(1.05);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #ffffff;
            min-width: 200px;
            border-radius: 5px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            margin-top: 10px;
            opacity: 0;
            transform: scale(0.95);
            transition: opacity 0.3s ease, transform 0.3s ease;
            background:000;
        }

        .dropdown-content.show {
            display: block;
            opacity: 1;
            transform: scale(1);
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        /* Error message styling */
        .error {
            font-size: 24px;
            color: #ff5252;
            text-align: center;
            margin-top: 20px;
        }
    </style>

<?php
$sql = "SELECT CurrentMonth,CurrentYear FROM logs WHERE CurrentDayIndex=1";
$res = $conn->query($sql);

if (!$res) {
    echo 'Err';
    echo mysqli_error($conn);
} else {
    $dataArr = "";
    for ($i = 0; $i < $res->num_rows; $i++) {
        $dataArr = $dataArr . '\'';
        foreach ($res->fetch_assoc() as $key => $value) {
            $dataArr = $dataArr . '' . $value . ' ';
        }
        $dataArr = $dataArr . '\',';
    }
    $js = <<<R

    <script>
    let data = [$dataArr];
    </script>
    R;
    echo $js;
}
?>
</head>
<body>

<?php

// Access the parameters from the URL
$month = isset($_GET['month']) ? $_GET['month'] : null;
$dx = isset($_GET['dx']) ? $_GET['dx'] : null;
$dy = isset($_GET['dy']) ? $_GET['dy'] : null;

// Check if all parameters exist
if ($month && $dx && $dy) {
    echo "Graphs";
    $sql = "SELECT TimeStudied,CurrentDayIndex FROM logs WHERE CurrentMonth='$month' AND CurrentYear=$dy";
    $res = $conn->query($sql);
    echo '<canvas id="graph" aria-label="chart"></canvas>';

    echo '<script>let timeData = [];';
    echo 'let dayIndices = [];';
    for ($i = 0; $i < $res->num_rows; $i++) {
        foreach ($res->fetch_assoc() as $key => $value) {
            if ($key == 'TimeStudied') {
                echo 'timeData.push(';
                echo (($value / 60));
                echo ');';
            } else if ($key == 'CurrentDayIndex') {
                echo 'dayIndices.push(';
                echo (($value));
                echo ');';
            }
        }
    }
    echo '</script>';

    $html = <<<K
    <script>
      let chrt = document.getElementById("graph");
      var graph = new Chart(chrt, {
         type: 'line',
         data: {
            labels: dayIndices,
            datasets: [{
               label: "Timewise performance",
               data:timeData,
               backgroundColor: "#fa93ff66",
               borderColor: "#ffaeff",
               borderWidth: 1,
               fill: true,
               pointHoverRadius:4,
               pointHitRadius:1
            }],
         },
         options: {
            responsive: true,
         },
      });
    </script>
    K;
    echo $html;
} 
else if($_SERVER['REQUEST_URI'] != '/pdf')
{
    echo "<H2 class='error'>Can't find the graph<br><pre>Error: incomplete data</pre></H2>";
}

?>
        <div class="dropdown">
            <button id="dropdownButton">Graphs</button>
            <div id="dropdownContent" class="dropdown-content">
                <p>Graphs</p>
            </div>
        </div>
        
    <script>
        // Toggle dropdown visibility
        const button = document.getElementById("dropdownButton");
        const content = document.getElementById("dropdownContent");
        
        button.addEventListener("click", function () {
            content.classList.toggle("show");
        });
        
        // Close the dropdown when clicking outside of it
        window.onclick = function (event) {
            if (!event.target.matches('#dropdownButton')) {
                if (content.classList.contains("show")) {
                    content.classList.remove("show");
                }
            }
        }
    </script>

</body>
</html>
