<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>admin page</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>
</head>

<body>
  <header>
    <a href="adminHome.php" class="logo">Admin</a>

    <nav class="navigation">
      <ul>
        <li><a href="adminHome.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="index.php"><i class="far fa-calendar-alt"></i> Log-OUT</a></li>
      </ul>
    </nav>
  </header>

  <section class="adminNav">
    <div class="signRegist">
      <form method="POST" action="RegistOffice.php" onsubmit="return validateForm()">
        <h1>Register an Office</h1>

        <div class="form-group">
          <input type="text" placeholder="Capacity" name="capacity" id="capacity" required>
          <span id="capacityError" class="error"></span>

          <input type="text" placeholder="Location" name="location" id="location" required>
          <span id="locationError" class="error"></span>
        </div>

        <div class="signRegist">
          <button type="submit" name="submit" class="registbtn">Register</button>
        </div>

        <?php
        if (isset($_GET["error"])) {
    if ($_GET["error"] == "invalidOffice") {
        echo '<p class="alertmsg">Office does not exist.</p>';
    } 
    
}?>
      </form>
    </div>
  </section>

  <script>
    function validateForm() {
      var capacity = document.getElementById('capacity').value;
      var location = document.getElementById('location').value;

      
      if (!isNumeric(capacity)) {
        document.getElementById('capacityError').innerHTML = 'Capacity must be numeric';
        return false;
      } else {
        document.getElementById('capacityError').innerHTML = '';
      }

      
      if (!isString(location)) {
        document.getElementById('locationError').innerHTML = 'Location must be a string';
        return false;
      } else {
        document.getElementById('locationError').innerHTML = '';
      }

      return true;
    }

    function isNumeric(value) {
      return /^-?\d+$/.test(value);
    }

    function isString(value) {
      return isNaN(value);
    }
  </script>
</body>

</html>
