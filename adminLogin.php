
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login admin</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>

</head>

<body>
  <header>
    <a href="index.php" class="logo">Admin</a>

    <nav class="navigation">
      <ul>
        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="frontSignup.php">Sign Up</a></li>
      </ul>
    </nav>
  </header>

  <section class="adminNav">
    <div class="sign">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h1>Admin Login</h1>
        <input type="text" placeholder="Email" id="email" name="email" required>

        <input type="password" placeholder="Password" id="password" name="password" required>
        <label>
          <input class="chkbox" type="checkbox" checked="checked" name="remember"> Remember me
        </label>
        <button type="submit" name="submit" class="Loginbtn">Login</button>

        <a href=frontLogin.php>Customer</a>
      </form>
    </div>
  </section>
  

  <?php
  include "connection.php";
if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    
      $sql="SELECT * FROM `admin`";
      $result=mysqli_query($con,$sql);
      
      if($row=mysqli_fetch_row($result)){
        
        if($email==$row['4']&&$password==$row['5'])

        header("Location: adminHome.php");
        exit();
      }
     else {
        header("Location: adminLogin.php?error=wrongAdminLogin");
        exit();
    }
}
?>


</body>

</html>