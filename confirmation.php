<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin-top: 100px;
        }

        .success-icon {
            font-size: 80px;
            color: green;
            animation: scaleUp 1s ease-out forwards;
        }

        .message {
            font-size: 28px;
            font-weight: bold;
            margin-top: 20px;
            animation: fadeIn 2s;
        }

        .back-button {
            display: none;
            margin-top: 30px;
        }

        button {
            background-color: #2e7d32;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1b5e20;
        }

        @keyframes scaleUp {
            0% { transform: scale(0); }
            100% { transform: scale(1); }
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="success-icon">✔️</div>
    <div class="message">Order Successful!</div>

    <div class="back-button" id="backBtn">
        <button onclick="window.location.href='TThomepage.php'">BACK</button>
    </div>

    <script>
        // Play success sound
        var audio = new Audio('success.mp3');
        audio.play();

        // Show the back button after a delay (1.5 seconds)
        setTimeout(function() {
            document.getElementById('backBtn').style.display = 'block';
        }, 1500);
    </script>
</body>
</html>
