<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Signin</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>

</head>

<body>
  <header>
    <a href="index.php" class="logo">CAR RENTAL SYSTEM</a>

    <nav class="navigation">
      <ul>
        <li><a href="frontSignup.php">Sign Up</a></li>
      </ul>
    </nav>
  </header>

  <section class="sign_background">
    <div class="sign">
      <form method="POST" action="backLogin.php" onsubmit="return validateForm();">
        <h1>Login</h1>
        <input type="text" placeholder="Email" id="email" name="email" required>

        <input type="password" placeholder="Password" id="password" name="password" required>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
        <button type="submit" name="submit" class="Loginbtn">Login</button>

  <?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emailNotFound") {
        echo '<p class="alertmsg">Email does not exist.</p>';
    } elseif ($_GET["error"] == "invalidPassword") {
        echo '<p class="alertmsg">Wrong password.</p>';
    }
}
?>


      </form>

      <a href=adminLogin.php>Admin</a>
    </div>

  </section>




  <script>
    function validateForm() {

      var email = document.getElementById("email").value;
      var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (!email.match(emailPattern)) {
        alert("Please enter a valid email address.");
        return false;
      }

      return true;
    }
  </script>
</body>

</html>