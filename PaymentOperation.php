<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve a Car</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</head>

<body>
<header>
    <a href="customerHome.php" class="logo">Customer Page</a>
    <nav class="navigation">
        <ul>
            <li><a href="customerHome.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="#reservation"><i class="far fa-calendar-alt"></i> Log OUT</a></li>
        </ul>
    </nav>
</header>

<section class="CustomerNav">
    <div class="Ab-cust">
        <div id="payment" class="payment-form">
            <form id="paymentForm">

        <div class="reservation-form">
            <h1>Payment Operation</h1>
            <label for="carType">CUSTOMER_ID</label>
            <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="16" required="">
            <label for="carType">CARD_ID</label>
            <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="16" required="">
            <div id="priceDisplay">Price: $0.00</div>

            <button onclick="reserveCar()">Submit Operation</button>
        </div>
    </div>
</section>

<script>
    function reserveCar() {
        
        alert("Car reserved! Payment process will start.");
        
    }
</script>
</body>

</html>
