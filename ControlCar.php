<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
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
              <th>Car ID</th>
              <th>Plate ID</th>
              <th>Make</th>
              <th>Model</th>
              <th>Color</th>
              <th>Price</th>
              <th>Office ID</th>
              <th>State</th>
              <th>avilability</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
            require_once 'connection.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              if (isset($_POST['car_id']) && isset($_POST['current_state'])) {
                
                $carId = $_POST['car_id'];
                $currentState = $_POST['current_state'];

                $newState = $currentState === '1' ? '0' : '1';

                $updateQuery = "UPDATE Car SET State = '$newState' WHERE Car_ID = '$carId'";
                $result = mysqli_query($con, $updateQuery);

                if ($result) {
                  echo $newState; 
                  exit;
                } else {
                  echo "error";
                  exit;
                }
              } elseif (isset($_POST['delete_car'])) {
                
                $carId = $_POST['delete_car'];

                $deleteQuery = "DELETE FROM Car WHERE Car_ID = '$carId'";
                $result = mysqli_query($con, $deleteQuery);

                if ($result) {
                  echo "Car deleted"; 
                  exit;
                } else {
                  echo "Error deleting car";
                  exit;
                }
              }
            }

            $sql = "SELECT Car_ID, Plate_ID, Car_Name, Model, Color, Price, Office_ID, State, Img_Path FROM Car";
            $result = mysqli_query($con, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                  
                  <td><?php echo $row['Car_ID']; ?></td>
                  <td><?php echo $row['Plate_ID']; ?></td>
                  <td><?php echo $row['Car_Name']; ?></td>
                  <td><?php echo $row['Model']; ?></td>
                  <td><?php echo $row['Color']; ?></td>
                  <td><?php echo $row['Price']; ?></td>
                  <td><?php echo $row['Office_ID']; ?></td>
                  <td>
                    <?php
                    if ($row['State'] == 1) {
                      echo "Available";
                    } else if ($row['State'] == 0) {
                      echo "Unavailable";
                    } else {
                      echo "Unknown";
                    }
                    ?>
                  </td>
                  <td>
                    <button class="changeStateBtn" data-carid="<?php echo $row['Car_ID']; ?>" data-state="<?php echo $row['State']; ?>">
                      Change State
                    </button>
                  </td>
                  <td>
                    <button class="deleteBtn" data-carid="<?php echo $row['Car_ID']; ?>">
                      Delete
                    </button>
                  </td>
                </tr>
                <?php
              }
            } else {
              ?>
              <tr>
                <td colspan="10">No cars available</td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const buttons = document.querySelectorAll(".changeStateBtn");
      const deleteButtons = document.querySelectorAll(".deleteBtn");

      buttons.forEach(btn => {
        btn.addEventListener("click", function() {
          const carId = this.getAttribute("data-carid");
          const currentState = this.getAttribute("data-state");

          // AJAX request to update car state
          const xhr = new XMLHttpRequest();
          xhr.open("POST", "", true);
          xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
              if (xhr.status === 200) {
                
                const newState = xhr.responseText === "1" ? "0" : "1";
                btn.setAttribute("data-state", newState);
                btn.parentElement.previousElementSibling.textContent = newState === "1" ? "Available" : "Unavailable";
              } else {
                
                console.error('Error occurred while updating state');
              }
            }
          };

          
          xhr.send(`car_id=${carId}&current_state=${currentState}`);
        });
      });

      deleteButtons.forEach(btn => {
        btn.addEventListener("click", function() {
          const carId = this.getAttribute("data-carid");

          
          const xhr = new XMLHttpRequest();
          xhr.open("POST", "", true);
          xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
              if (xhr.status === 200) {
                
                const response = xhr.responseText;
                if (response === "Car deleted") {
                  btn.parentElement.parentElement.remove();
                } else {
                  
                  console.error('Error occurred while deleting the car');
                }
              }
            }
          };

          
          xhr.send(`delete_car=${carId}`);
        });
      });
    });
  </script>
</body>
</html>