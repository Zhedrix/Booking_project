<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styles */
        body {
     font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('rhema-kallianpur-uocSnWMhnAs-unsplash (1).jpg');
    background-size: 70%; /* Adjust the image size to cover the background */
    background-position: center top; /* Position the image */
    background-repeat: no-repeat; /* Prevents the image from repeating */
    color: white;
    background-attachment: fixed; /* Keeps the background fixed during scroll */
    background-size: 100%;
    
    

}


        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.6));
            padding: 20px 50px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
        }

        header h1 {
            margin: 0;
            font-size: 36px;
            font-family: 'Poppins', sans-serif;
        }

        nav {
            display: flex;
            gap: 30px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        nav a:hover {
            background-color: #feb47b;
            color: #333;
            transform: scale(1.1);
            text-decoration: none;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            text-align: center;
            color: white;
            margin-top: 20px;
        }

        /* Search Bar */
        .container {
            max-width: 500px;
            margin: 150px auto;
            padding: 20px;
            background: linear-gradient(145deg, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8));
            border-radius: 50px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-out;
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

        .search-bar {
            background: linear-gradient(to right, #2b5876, #4e4376);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .search-bar h3 {
            margin-bottom: 20px;
            font-size: 28px;
            text-align: center;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }

        .search-bar input,
        .search-bar button {
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .search-bar input {
            width: 250px;
            background-color: #fff;
            color: #333;
        }

        .search-bar input:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(255, 165, 0, 0.8);
        }

        .search-bar button {
            background-color: #ff7e5f;
            color: white;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .search-bar button:hover {
            background-color: #feb47b;
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        /* Rooms Section */
        .w3-content {
            max-width: 1532px;
        }

        .w3-container {
            margin-top: 20px;
        }

        .room-img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease-in-out; /* Smooth transition */
        }

        .room-img:hover {
            transform: scale(1.1); /* Zoom in effect */
        }

        .w3-container {
            padding: 20px;
        }

        .w3-container h3 {
            font-size: 24px;
            font-weight: 500;
            margin-top: 10px;
        }

        .w3-container h6 {
            font-size: 18px;
            color: #feb47b;
            font-weight: 400;
        }

        .w3-container p {
            font-size: 16px;
            color: #ccc;
        }

        .w3-container p i {
            margin-right: 10px;
            color: #ff7e5f;
        }

    </style>
    <script>
        function updateTotalGuests() {
            const adults = parseInt(document.getElementById('adults').value) || 0;
            const kids = parseInt(document.getElementById('kids').value) || 0;
            document.getElementById('total-guests').value = adults + kids;
        }
    </script>
</head>

<body>
    <!-- Header -->
    <header>
        <h1>Welcome to Paradise Hotel</h1>
        <nav>
            <a href="homepage.php">Home</a>
            <a href="#rooms" class="w3-bar-item w3-button w3-mobile">Rooms</a>
            <a href="#about" class="w3-bar-item w3-button w3-mobile">About</a>
            <a href="#Contact" class="w3-bar-item w3-button w3-mobile">Contact</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <!-- Search Bar -->
    <div class="container">
        <section class="search-bar">
            <h3>Paradise</h3>
            <form action="search_results.php" method="GET">
                <label for="check-in">Check-in date</label><br>
                <input type="date" name="check_in" id="check-in" required><br>

                <label for="check-out">Check-out date</label><br>
                <input type="date" name="check_out" id="check-out" required><br>

                <label>Adults</label><br>
                <input type="number" id="adults" name="Adults" min="1" max="6" value="1" onchange="updateTotalGuests()"><br>

                <label>Kids</label><br>
                <input type="number" id="kids" name="Kids" min="0" max="6" value="0" onchange="updateTotalGuests()"><br>

                <br><button type="submit">Check Availability</button>
            </form>
        </section>
    </div>

   <!-- Rooms Section -->
<div class="w3-content">
    <div class="w3-container" id="rooms">
        <h3>Rooms</h3>
        <p>Make yourself at home. We offer the best beds in the industry. Sleep well and rest well.</p>
    </div>

    <div class="w3-row-padding w3-padding-16">
        <!-- Single Room -->
        <div class="w3-third w3-margin-bottom">
            <img src="andrew-neel-w84MOrTfbdw-unsplash.jpg" alt="Single Room" class="room-img">
            <div class="w3-container w3-white">
                <h3>Single Room</h3>
                <h6 class="w3-opacity">From $99</h6>
                <p>Single bed</p>
                <p class="w3-large"><i class="fa fa-bath"></i> <i class="fa fa-phone"></i> <i class="fa fa-wifi"></i></p>
            </div>
        </div>
        
        <div class="w3-third w3-margin-bottom">
            <img src="andrew-neel-w84MOrTfbdw-unsplash.jpg" alt="Quad Bedroom" class="room-img">
            <div class="w3-container w3-white">
                <h3>Double Room</h3>
                <h6 class="w3-opacity">From $149</h6>
                <p>Queen-size bed</p>
                <p class="w3-large"><i class="fa fa-bath"></i> <i class="fa fa-phone"></i> <i class="fa fa-wifi"></i> <i class="fa fa-tv"></i></p>
            </div>
        </div>
        
        <div class="w3-third w3-margin-bottom">
            <img src="andrew-neel-w84MOrTfbdw-unsplash.jpg" alt="Double Room" class="room-img">
            <div class="w3-container w3-white">
                <h3>Triple room</h3>
                <h6 class="w3-opacity">From $149</h6>
                <p>Three single beds</p>
                <p class="w3-large"><i class="fa fa-bath"></i> <i class="fa fa-phone"></i> <i class="fa fa-wifi"></i> <i class="fa fa-tv"></i></p>
            </div>
        </div>
        
        <div class="w3-third w3-margin-bottom">
            <img src="andrew-neel-w84MOrTfbdw-unsplash.jpg" alt="Quad Bedroom" class="room-img">
            <div class="w3-container w3-white">
                <h3>Quad Bedroom</h3>
                <h6 class="w3-opacity">From $149</h6>
                <p>Quad bed room</p>
                <p class="w3-large"><i class="fa fa-bath"></i> <i class="fa fa-phone"></i> <i class="fa fa-wifi"></i> <i class="fa fa-tv"></i></p>
            </div>
        </div>

        <div class="w3-third w3-margin-bottom">
            <img src="andrew-neel-w84MOrTfbdw-unsplash.jpg" alt="Deluxe Room" class="room-img">
            <div class="w3-container w3-white">
                <h3>Suite room</h3>
                <h6 class="w3-opacity">From $199</h6>
                <p>Luxurious room</p>
                <p class="w3-large"><i class="fa fa-bath"></i> <i class="fa fa-phone"></i> <i class="fa fa-wifi"></i> <i class="fa fa-tv"></i> <i class="fa fa-glass"></i> <i class="fa fa-cutlery"></i></p>
            </div>
        </div>
        
        <div class="w3-third w3-margin-bottom">
            <img src="andrew-neel-w84MOrTfbdw-unsplash.jpg" alt="Deluxe Room" class="room-img">
            <div class="w3-container w3-white">
                <h3>Deluxe Room</h3>
                <h6 class="w3-opacity">From $199</h6>
                <p>King-size bed</p>
                <p class="w3-large"><i class="fa fa-bath"></i> <i class="fa fa-phone"></i> <i class="fa fa-wifi"></i> <i class="fa fa-tv"></i> <i class="fa fa-glass"></i> <i class="fa fa-cutlery"></i></p>
            </div>
        </div>
    </div>
</div><br><br><br><br><br><br><br>

<div class="w3-row-padding" id="about">
    <div class="w3-col l4 12">
      <h3>About</h3>
      <h6>Our hotel is one of a kind. It is truely amazing. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</h6>
    <p>We accept: <i class="fa fa-credit-card w3-large"></i> <i class="fa fa-cc-mastercard w3-large"></i> <i class="fa fa-cc-amex w3-large"></i> <i class="fa fa-cc-cc-visa w3-large"></i><i class="fa fa-cc-paypal w3-large"></i></p>
    </div>
    <div class="w3-col l8 12">
      <!-- Image of location/map -->
      <img src="robert-bye-CoGRK1vlQHs-unsplash.jpg" class="w3-image w3-greyscale" style="width:100%;">
    </div>
  </div>
  
  <div class="w3-row-padding w3-large w3-center" style="margin:32px 0">
    <div class="w3-third"><i class="fa fa-map-marker w3-text-red"></i> 423 Some adr, Chicago, US</div>
    <div class="w3-third"><i class="fa fa-phone w3-text-red"></i> Phone: +00 151515</div>
    <div class="w3-third"><i class="fa fa-envelope w3-text-red"></i> Email: mail@mail.com</div>
  </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Paradise Hotel. All rights reserved.</p>
    </footer>
</body>

</html>
