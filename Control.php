
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Control</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>
</head>

<body>
  <header>
    <a href="adminHome.php" class="logo">Admin Page</a>
    <nav class="navigation">
      <ul>
        <li><a href="adminHome.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="carRegistration.php"><i class="fas fa-car"></i> Car Registration</a></li>
        <li><a href="ReservationCar.php"><i class="far fa-calendar-alt"></i> Reservation</a></li>
      </ul>
    </nav>
  </header>
  <section class="adminNav">
    <div class="report">
      <h1><span>Control</span></h1>
      <button id="customersButton">Customers</button>
      <button id="carsButton">Cars</button>
    </div>
  </section>

  <script>
    
    document.getElementById("customersButton").addEventListener("click", function() {
      window.location.href = "ControlCustomers.php"; 
    });

    document.getElementById("carsButton").addEventListener("click", function() {
      window.location.href = "ControlCar.php"; 
    });
  </script>
</body>

</html>
