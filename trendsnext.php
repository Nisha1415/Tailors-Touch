<!DOCTYPE html>
<html>
    <head>
        <title>Tailors Touch</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{
                 background-color: #FAF3F3;
                 padding: 20px;
                 margin: 0;
                 font-size: 20px;
                 
            }
            .delivery {
               
                margin-top: 20px;
                text-align: center;
            }
            
            input[type="radio"] {
                margin-right: 10px;
                margin-top: 30px;
            }
            
            .container{
                background-color: white;
                padding: 30px;
                margin: 0;
                font-size: 20px;
            }
            
            /*Header styling*/
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
                color: #D40000;
            }
            textarea {
        width: 90%;
        padding: 10px;
        font-size: 16px;
        border: 2px solid #2e7d32;
        border-radius: 8px;
        outline: none;
        resize: none; /* Prevent resizing */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: 'Roboto', sans-serif;
        margin-bottom: 20px;
    }

    textarea:focus {
        border-color: #4CAF50;
        background-color: #f2f9f2;
    }

    /* Styling for the image upload input */
    input[type="file"] {
        padding: 8px;
        font-size: 16px;
        border: 2px solid #2e7d32;
        border-radius: 8px;
        outline: none;
        cursor: pointer;
        font-family: 'Roboto', sans-serif;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    input[type="file"]:hover {
        border-color: #4CAF50;
        background-color: #f2f9f2;
    }

    /* Section container for description and image upload */
   

    button {
        background-color: #2e7d32;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
        margin-bottom: 20px;
        margin-top:20px;
    }

    button:hover {
        background-color: #4CAF50;
    }
        </style>
    </head>
    
    <body>
        <header>
    <nav>
        <ul>
            <li><a href="TThomepage.php">Home</a></li>
            <li><a href="">Order Details</a></li>
            <li><a href="">Profile</a></li>
            <li><a href="signupsignin">Login</a></li>
            <li><a href="">Logout</a></li>
            <li><a href="#aboutus">About Us</a></li>
        </ul>
    </nav>
</header>
<form id="deliveryForm" action="delivery.php" method="post" enctype="multipart/form-data">
       <section>
        <label for="description">Customize Details:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" placeholder="Type your description here..."></textarea><br><br>
        
        <label for="image">Select an image to upload:</label><br>
        <input type="file" id="image" name="image" accept="image/*"><br>
        
        
        </section>
        <section>
            <div class="container">
                <center><label>For your convenience, we can either deliver your clothes to your doorstep or have the ready for pick-up at the shop.which option works best for you
                    </label></center>
                    <br>
                <center><label>
                    <input type="radio" name="homedelivery" value="delivery"> Home Delivery
                </label>
                
                <label>
                    <input type="radio" name="homedelivery" value="pickup"> Pick up at shop
                </label></center>
                <center><button type="submit" class="order">Confirm order</button></center>
            </div>
        </section>
    </body>
</html>
