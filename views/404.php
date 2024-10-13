<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #1c1c1c;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .navbar
        {
            border-radius:10px;
        }

        .container {
            text-align: center;
            border-radius:10px;
        }

        h1 {
            font-size: 10em;
            margin: 0;
            color: #ff0066;
        }

        h2 {
            font-size: 2em;
            margin: 20px 0;
            color: #ffffff;
        }

        p {
            font-size: 1.2em;
            margin: 20px 0;
        }

        a {
            display: inline-block;
            padding: 10px 25px;
            text-decoration: none;
            font-size: 1em;
            background-color: #ff0066;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        
        a:hover {
            background-color: #ff4081;
        }

        .glitch {
            position: relative;
            color: #fff;
            font-size: 3em;
        }

        .glitch:before, .glitch:after {
            content: attr(data-text);
            position: absolute;
            left: 0;
            right: 0;
            color: #ff0066;
            background: transparent;
            overflow: hidden;
            clip: rect(0, 900px, 0, 0);
        }

        .glitch:before {
            top: -2px;
            text-shadow: 2px 0 blue;
            animation: glitchTop 2s infinite linear alternate-reverse;
        }

        .glitch:after {
            top: 2px;
            text-shadow: -2px 0 red;
            animation: glitchBot 2s infinite linear alternate-reverse;
        }

        @keyframes glitchTop {
            0% {
                clip: rect(44px, 9999px, 56px, 0);
            }
            20% {
                clip: rect(75px, 9999px, 80px, 0);
            }
            40% {
                clip: rect(32px, 9999px, 60px, 0);
            }
            60% {
                clip: rect(110px, 9999px, 130px, 0);
            }
            80% {
                clip: rect(77px, 9999px, 110px, 0);
            }
            100% {
                clip: rect(44px, 9999px, 56px, 0);
            }
        }

        @keyframes glitchBot {
            0% {
                clip: rect(77px, 9999px, 110px, 0);
            }
            20% {
                clip: rect(32px, 9999px, 60px, 0);
            }
            40% {
                clip: rect(75px, 9999px, 80px, 0);
            }
            60% {
                clip: rect(44px, 9999px, 56px, 0);
            }
            80% {
                clip: rect(110px, 9999px, 130px, 0);
            }
            100% {
                clip: rect(77px, 9999px, 110px, 0);
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>404</h1>
        <h2 class="glitch" data-text="Page Not Found">Page Not Found</h2>
        <p>Oops! The page you are looking for does not exist or has been moved.</p>
        <a href="/">Go Back Home</a>
    </div>

</body>
</html>
