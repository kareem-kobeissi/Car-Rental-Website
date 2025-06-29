<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer List</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <a href="adminHome.php" class="logo">Admin</a>
    <nav class="navigation">
      <ul>
        <li><a href="adminHome.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="index.php">Log-OUT</a></li>
      </ul>
    </nav>
  </header>

  <section class="CustomerNav">
    <div class="Ab-cust">
      <div class="reservation-form">
        <table id="carTable">
          <thead>
            <tr>
              <th>Customer ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Country</th>
              <th>City</th>
              <th>Street</th>
              <th>Phone Number</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
            require_once 'connection.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customer_id'])) {
                $customerID = $_POST['customer_id'];
                
                
                
                $delPO=mysqli_query($con,"delete from payment_operation where Customer_ID=$customerID");
                $delP=mysqli_query($con,"delete from payment_card where Customer_ID=$customerID");
                $delR=mysqli_query($con,"delete from reserve where Customer_ID=$customerID");
                $deleteQuery = "DELETE FROM Customer WHERE Customer_ID = $customerID";
                $result = mysqli_query($con, $deleteQuery);
                if ($result) {
                  header("Location: ControlCustomers.php");
                  exit;
              } else {
                  $error = "Error deleting customer.";
                  echo "<script>alert('$error');</script>";
              }
          
      }
      

            $sql = "SELECT Customer_ID, Fname, Lname, Gender, Country, City, Street, PhoneNum FROM Customer";
            $result = mysqli_query($con, $sql);


            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                  <td><?php echo $row['Customer_ID']; ?></td>
                  <td><?php echo $row['Fname']; ?></td>
                  <td><?php echo $row['Lname']; ?></td>
                  <td><?php echo $row['Country']; ?></td>
                  <td><?php echo $row['City']; ?></td>
                  <td><?php echo $row['Street']; ?></td>
                  <td><?php echo $row['PhoneNum']; ?></td>
                  <td>
                  <form action="" method="post">
                      <input type="hidden" name="customer_id" value="<?php echo $row['Customer_ID']; ?>">
                      <button type="submit">Delete</button>
                    </form>
                  </td>
                </tr>
            <?php
              }
            } else {
            ?>
              <tr><td colspan="9">No customers available</td></tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</body>
</html>