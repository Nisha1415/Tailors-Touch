<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tailors Touch</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Gill Sans, sans-serif;
            background-color: #E8E8E8;           
        }
        .container, .styles {
            background-color: #E8E8E8;
            padding: 20px;
            margin: 0;
            font-size: 25px;
        }
        .spage1, .spage2, .spage3 {
            display: none; 
            transition: opacity 1s ease;
            opacity: 0;
        }
        .active {
            display: block; 
            opacity: 1; 
        }
        .custom-button {
            background-color: #121212;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            margin: 20px;
        }
        .custom-button {
            padding: 15px 32px;
            transition: background-color 0.3s ease; 
        }
        .image-row {
            display: flex;
            justify-content: center; 
            flex-wrap: wrap; 
            gap: 20px; 
            margin: 20px 0;
        }
        .image-container, .image-container1 {
            display: flex;
            flex-direction: column; 
            align-items: center; 
            justify-content: center; 
            max-width: 300px; 
            text-align: center; 
        }
        .image-container img, .image-container1 img {
            width: 150px; 
            height: 150px; 
            border-radius: 50%; 
            object-fit: cover; 
            margin-bottom: 10px; 
        }
        .image-container img {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .serv_box {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); 
        }
        .serv_box:hover {
            transform: translateY(-5px); 
        }
        h2 {
            color: #121212; 
        }
        h3 {
            margin: 0; 
        }
        .container {
            background-image: url("bg2.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 500px;
            color: black;
            text-align: left;
            margin-left: 20px;
            margin-right: 20px;
            padding: 10px;
            line-height: 1.5;
            font-size: 25px;
            display: flex;
        }
        .container, .styles {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin: 20px auto;
            border-radius: 12px;
        }
        .left-side {
            flex: 1;
            padding: 20px;
            font-style: italic;
        }
        .right-side {
            flex: 1;
        }
        .services_sec {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 1000px;
            margin: 0 auto;
        }
        .serv_box {
            width: 25%; 
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            background-color: #E6E8D4;
            border: 2px solid #ccc;
            border-radius: 10px;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
        }
        .serv_box:hover {
            background-color: #e0e0e0;
            cursor: pointer;            
        }
        .about {
            background-color: #121212;
            color: white;
            padding: 40px;
            margin: 20px auto;
            max-width: 1000px;
            border-radius: 10px;
            animation: fadeIn 1s ease-in-out; 
        }
        .about p {
            margin: 10px 0;
            font-size: 18px;
            line-height: 1.6;
            font-family: 'Arial', sans-serif;
        }
        .about h1 {
            color: #4CAF50; 
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        /*Header section*/
        header {
            background-color: #333;
            padding: 10px 0;
        }
        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-family: 'Roboto', sans-serif;
        }
        nav ul li a:hover {
            color: #ff6600;
        }
    </style>
</head>
<body>
    <!-- header -->
<header>
    <nav>
        <ul>
            <li><a href="TThomepage.php">Home</a></li>
            <li><a href="signupsignin.php">Login</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="feedback.html">Reviews</a></li>
        </ul>
    </nav>
</header>
    <!--  header closet -->
    
    <section class="mpage">
        <div class="container">
            <div class="left-side">
                <center><h1>WELCOME TO TAILORS TOUCH</h1></center>
                <center>
                <p>
                        <?php 
                        if(isset($_SESSION['username'])) {
                            echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";
                        } else {
                            echo "Welcome, Guest!";
                        }
                        ?>
                    </p>
                    <p>"Where Tradition Meets Technology"</p>
                    <p>Combining the art of tailoring with modern digital solutions</p>
                    <p>for a personalized clothing experience</p>
                </center>
                <center>
                    <a href="signupsignin.php"><button class="custom-button">ORDER NOW</button></a></center>
            </div>
            <div class="right-side"></div>
        </div>
    </section>
    <!-- trends -->
    <section class="spage1 active">
        <div class="styles">
            <center><h1>Elegant Styles for Women and Little Ones</h1></center>
        </div>
        <div class="image-row">
            <div class="image-container">
                <img src="lady.jpg" alt="Lady Image">
                <h3>LADIES</h3>
            </div>
            <div class="image-container">
                <img src="child.jpg" alt="Child Image">
                <h3>KIDS</h3>
            </div>
        </div>
    </section>

    <section class="spage2">
        <div class="styles">
            <center><h1>Trending Looks for Women</h1></center>
        </div>
        <div class="image-row">
            <div class="image-container1">
                <img src="aliacut.png" alt="Alia Cut">
                <h3>ALIA CUT</h3>
            </div>
            <div class="image-container1">
                <img src="gown.png" alt="Gown Image">
                <h3>GOWN</h3>
            </div>
            <div class="image-container1">
                <img src="anarkali.png" alt="Anarkali Image">
                <h3>ANARKALI</h3>
            </div>
            <div class="image-container1">
                <img src="nairacut.png" alt="Naira Cut">
                <h3>NAIRA CUT</h3>
            </div>
        </div>
    </section>

    <section class="spage3">
        <div class="styles">
            <center><h1>Cool Looks for Cool Kids</h1></center>
        </div>
        <div class="image-row">
            <div class="image-container1">
                <img src="gownc.png" alt="Kids Gown">
                <h3>GOWN</h3>
            </div>
            <div class="image-container1">
                <img src="frock.png" alt="Kids Frock">
                <h3>FROCK</h3>
            </div>
            <div class="image-container1">
                <img src="dhotistyle.png" alt="Kids Chudi">
                <h3>CHUDI</h3>
            </div>
            <div class="image-container1">
                <img src="skirtandblouse.png" alt="Kids Leghna">
                <h3>LEGHNA</h3>
            </div>
        </div>
    </section>
    <!-- end trends -->
    <section class="about">
        <center><h1>About Us</h1></center>
        <center><p>
                Tailors Touch is where tradition meets innovation, blending the timeless art of tailoring with cutting-edge digital 
                solutions to offer a personalized and seamless clothing experience. Our journey began with a simple mission: to create
                custom-made outfits that reflect individuality and craftsmanship while embracing the convenience of modern technology.
                </p></center>
            <center><p>
                At Tailors Touch, we believe that every garment tells a story. Whether it’s an elegant gown, a traditional 
                salwar, or bespoke attire for a special occasion, we ensure that each piece is crafted with precision, care, and attention
                to detail. Our expert tailors bring years of experience to the table, working with luxurious fabrics and the finest materials to 
                design clothing that is unique to you.
                </p></center>
    </section>

    <script>
        let currentPage = 1;
        const totalPages = 3;
        function showNextPage() {
            document.querySelector('.spage1').classList.remove('active');
            document.querySelector('.spage2').classList.remove('active');
            document.querySelector('.spage3').classList.remove('active');
            currentPage++;
            if (currentPage > totalPages) {
                currentPage = 1;
            }
            document.querySelector('.spage' + currentPage).classList.add('active');
        }
        document.querySelector('.spage1').classList.add('active');
        setInterval(showNextPage, 3000);
    </script>
</body>
</html>
