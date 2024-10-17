
<?php

$servername = "localhost";
$username = "time_it_user";
$pwss = "time_it@mysql";
$conn = mysqli_connect($servername, $username, $pwss);

if (!$conn) {
    die("Internal Server Error: Could Not Access Database");
}

$sql = "USE time_it";
$res = $conn->query($sql);

if (!$res) {
    echo 'Err';
    echo mysqli_error($conn);
}
$CM = substr(date('M'), 0, 3);
$sql = "SELECT TimeStudied,CurrentDayIndex FROM logs WHERE CurrentMonth='$CM'";
$res = $conn->query($sql);

if ($res->num_rows > 0) {
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
}

?>


<!-- current status has two sets of values active and inactive -->
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/helpers.esm.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timit</title>
    <script src="ui" defer></script>
    <link rel="stylesheet" href="uic">
    <style>
        /* General reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styling */
body {
    background-color: #1f1f1f;
    font-family: 'Arial', sans-serif;
    color: #f0f0f0;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    transition: background-color 0.5s ease;
}

/* Graph container */
canvas#graph {
    margin: 100px 0 40px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    background-color: #2a2a2a;
    padding: 20px;
}

/* Button styling */
.ui.pushable {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 30px;
}

button.setter {
    background-color: #ff0055;
    color: white;
    border: none;
    padding: 15px 30px;
    font-size: 1.2em;
    border-radius: 50px;
    cursor: pointer;
    transition: all .2s linear, background-color 0.3s ease, transform 0.2s, box-shadow 0.3s ease;
}

button.setter:hover {
    background-color: #ff4081;
    box-shadow: 0px 4px 15px rgba(255, 0, 85, 0.3);
    scale:1.03;
}

button.setter:active {
    background-color: #ff2045;
    transform: scale(0.98);
    box-shadow: none;
}

/* Timer display */
p#timer {
    font-size: 2.5em;
    color: #ffaeff;
    margin-left: 20px;
    background-color: #333;
    padding: 10px 20px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

p#timer:hover {
    transform:translate(18%,-1%);
    box-shadow: 0 4px 20px rgba(255, 174, 255, 0.3);
}

/* Media Queries for Responsive Design */

/* Large Desktops (1440px and above) */
@media screen and (min-width: 1440px) {
    body {
        padding: 30px;
    }
    canvas#graph {
        /* max-width: 1600px; */
    }
}

/* Medium Desktops (1024px to 1440px) */
@media screen and (min-width: 1024px) and (max-width: 1440px) {
    body {
        padding: 20px;
    }
    canvas#graph {
        max-width: 800px;
    }
    button.setter {
        font-size: 1.2em;
        padding: 12px 25px;
    }
}

/* Tablets (768px to 1024px) */
@media screen and (min-width: 768px) and (max-width: 1024px) {
    body {
        padding: 15px;
    }
    canvas#graph {
        max-width: 700px;
    }
    p#timer {
        font-size: 2.2em;
        padding: 10px 15px;
    }
    button.setter {
        font-size: 1.1em;
        padding: 12px 20px;
    }
}

/* Mobile Devices (480px to 768px) */
@media screen and (min-width: 480px) and (max-width: 768px) {
    body {
        padding: 10px;
    }
    canvas#graph {
        max-width: 600px;
    }
    p#timer {
        font-size: 2em;
        padding: 10px 15px;
    }
    button.setter {
        font-size: 1em;
        padding: 10px 20px;
    }
}

/* Small Mobile Devices (up to 480px) */
@media screen and (max-width: 480px) {
    body {
        padding: 10px;
    }
    canvas#graph {
        max-width: 90%;
    }
    p#timer {
        font-size: 1.8em;
        padding: 8px 12px;
    }
    button.setter {
        font-size: 0.9em;
        padding: 8px 15px;
    }
}

    </style>
</head>
<body>
    
<canvas id="graph" aria-label="chart"></canvas>
    <script defer>
        var chrt = document.getElementById("graph");
        var graph = new Chart(chrt, {
            type: 'line',
            data: {
                labels: dayIndices,
                datasets: [{
                    label: "Timewise performance",
                    data: timeData,
                    backgroundColor: "#fa93ff66",
                    borderColor: "#ffaeff",
                    borderWidth: 1,
                    // fill: true,
                    pointHoverRadius: 4,
                    pointHitRadius: 1,
                    tension:.2
                }],
            },
            options: {
                responsive: true,
            },
        });
    </script>

    <div class="ui pushable">
        <button class="setter" id="setter"></button>
        <p id="timer" class="front">00:00:00</p>
    </div>

</body>
</html>

<?php
include "prompter.doc"; 
?>