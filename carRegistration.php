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
      <form method="POST" action="RegistCar.php" onsubmit="return validateForm()" enctype="multipart/form-data">
        <h1>Register a car</h1>

        <div class="form-group">
          <input type="text" placeholder="Name" name="name" id="name" class="cname" required>
          <span id="nameError" class="error"></span>
        </div>

        <div class="form-group">
          <input type="text" placeholder="Price" name="CPrice" id="CPrice" required>
          <span id="priceError" class="error"></span>

          <input type="text" placeholder="Model" name="CModel" id="CModel" required>
          <span id="modelError" class="error"></span>
        </div>

        <div class="form-group">
          <input type="text" placeholder="Color" name="CColor" id="CColor" required>
          <span id="colorError" class="error"></span>

          <input type="text" placeholder="Plate ID" name="PID" id="PID" required>
        </div>

        <div class="form-group">
          <input type="text" placeholder="Office ID" name="OID" id="OID" required>
          <span id="oidError" class="error"></span>
        </div>

        <div>
          <select id="state" name="state">
            <option selected="selected" value=1>Available</option>
            <option value=0>Not Available</option>
          </select>
        </div>

        <input type="file" name="photo" id="photo" accept="image/*">

        <div class="signRegist">
          <button type="submit" name="submit" class="registbtn">Register</button>
        </div>



        
      </form>
    </div>
  </section>

  <script>
    function validateForm() {
      var name = document.getElementById('name').value;
      var price = document.getElementById('CPrice').value;
      var model = document.getElementById('CModel').value;
      var color = document.getElementById('CColor').value;
      var oid = document.getElementById('OID').value;

      
      if (!isString(name)) {
        document.getElementById('nameError').innerHTML = 'Name must be a string';
        return false;
      } else {
        document.getElementById('nameError').innerHTML = '';
      }

      
      if (!isNumeric(price)) {
        document.getElementById('priceError').innerHTML = 'Price must be numeric';
        return false;
      } else {
        document.getElementById('priceError').innerHTML = '';
      }

      
      if (!isString(model)) {
        document.getElementById('modelError').innerHTML = 'Model must be a string';
        return false;
      } else {
        document.getElementById('modelError').innerHTML = '';
      }

      
      if (!isString(color)) {
        document.getElementById('colorError').innerHTML = 'Color must be a string';
        return false;
      } else {
        document.getElementById('colorError').innerHTML = '';
      }

      
      if (!isNumeric(oid)) {
        document.getElementById('oidError').innerHTML = 'Office ID must be numeric';
        return false;
      } else {
        document.getElementById('oidError').innerHTML = '';
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