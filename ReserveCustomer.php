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
        <li><a href="AvailableCars.php"><i class="fas fa-car"></i> Available Cars</a></li>
        <li><a href="index.php">Log OUT</a></li>
      </ul>
    </nav>
  </header>

  <section class="CustomerNav">
    <div class="Ab-cust">

      <div class="reservation-form">
        <h2>Make a Car Reservation</h2>

        <form action="Reserve.php" method="POST">
        <label for="officeLoc">Office Location:</label>
        <select name="officeLoc" id="officeLoc">
        </select>

        <label for="carType">Select Car (Available only Appears) :</label>
        <select name="carType" id="carType"></select>

        <label for="cardNum">Select Payment-Card:</label>
        <select name = "cardNum" id="cardNum"></select>



        <label for="startDate">Start Date:</label>
        <input name="startDate" type="date" id="startDate">

        <label for="endDate">End Date:</label>
        <input name="endDate" type="date" id="endDate">

        <div id="priceDisplay">
          Price: $0.00
        </div>
        <input type="hidden" name="price" id="hiddenPrice" value="">

        </div>
        <button type="submit" name="submit" id="submit">Reserve</button>
        <?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "nullCar") {
        echo '<p class="alertmsg">No Car selected</p>';
    } elseif ($_GET["error"] == "nullCard") {
      echo '<p class="alertmsg">No Card selected</p>';
    } elseif ($_GET["error"] == "nullSDate") {
      echo '<p class="alertmsg">Start Date is not selected</p>';
    }elseif ($_GET["error"] == "nullEDate") {
      echo '<p class="alertmsg">End Date is not selected</p>';
    }elseif ($_GET["error"] == "nullOffice") {
      echo '<p class="alertmsg">Office is not selected</p>';
    }
}
?>
        </form>
    </div>
    


  </section>

  <script>



          // Fetch data from the PHP file
          fetch('displayOffice.php')
            .then(response => response.json())
            .then(data => {
              // Get the select element
              const select = document.getElementById('officeLoc');

              // Loop through the data and create options
              data.forEach(option => {
                const optionElement = document.createElement('option');
                //optionElement.value = option;
                optionElement.value = option.Office_ID;
                optionElement.text = option.Location;
                select.add(optionElement);
              });

            // Get the selected value
            var selectedValue = document.getElementById('officeLoc').value;

            // Send the selected value to the PHP file using Fetch API
            fetch('displayCars.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: 'officeLoc=' + selectedValue, // Change to 'officeLoc' as it matches the PHP code
            })
              .then(response => response.json()) // Expecting JSON response
              .then(data => {


                const selectCarType = document.getElementById('carType');
                
                selectCarType.innerHTML = ""; // Clear existing options
                data.forEach(option => {
                  const optionElement = document.createElement('option');
                  optionElement.value = option.Car_ID;
                  optionElement.text = option.Car_Name;
                  selectCarType.add(optionElement);
                });
             
              var selectedCar = document.getElementById('carType').value;

              fetch('displayPrice.php', { // nested fetch to ensure the car is there to then get it's price
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: 'carType=' + selectedCar + '&startDate=' + document.getElementById('startDate').value + '&endDate=' + document.getElementById('endDate').value,
            })
            .then(response => response.json()) // Expecting JSON response
        .then(data => {
            const priceDisplay = document.getElementById('priceDisplay');
            const hiddenPrice = document.getElementById('hiddenPrice');

            if(data != null){
            priceDisplay.textContent = 'Price: $' + data; // Assuming 'data' is the price value
            hiddenPrice.value = data;
        } else {
          priceDisplay.textContent = 'Price: not Available'; // Assuming 'data' is the price value
          hiddenPrice.value = '';

        }
        })
        .catch(error => console.error('Error fetching price:', error));
      }) 
        .catch(error => console.error('Error fetching car types:', error));
      })
          
function fetchPrice(selectedCar){
  fetch('displayPrice.php', { // nested fetch to ensure the car is there to then get it's price
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: 'carType=' + selectedCar + '&startDate=' + document.getElementById('startDate').value + '&endDate=' + document.getElementById('endDate').value,
            })
            .then(response => response.json()) // Expecting JSON response
        .then(data => {
            const priceDisplay = document.getElementById('priceDisplay');
            const hiddenPrice = document.getElementById('hiddenPrice');

            if(data != null){
            priceDisplay.textContent = 'Price: $' + data; // Assuming 'data' is the price value
            hiddenPrice.value = data;
        } else {
          priceDisplay.textContent = 'Price: not Available'; // Assuming 'data' is the price value
          hiddenPrice.value = '';

        }
        })
        .catch(error => console.error('Error fetching price:', error));
      }


      document.getElementById('carType').addEventListener('change', function(){
        var selectedCar = this.value;
        fetchPrice(selectedCar);
      });

      document.getElementById('startDate').addEventListener('change', function(){
        var selectedCar = document.getElementById('carType').value;
        fetchPrice(selectedCar);
      });

      document.getElementById('endDate').addEventListener('change', function(){
        var selectedCar = document.getElementById('carType').value;
        fetchPrice(selectedCar);
      });

function fetchCars(selectedValue){
      fetch('displayCars.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: 'officeLoc=' + selectedValue, // Change to 'officeLoc' as it matches the PHP code
            })
              .then(response => response.json()) // Expecting JSON response
              .then(data => {
                const selectCarType = document.getElementById('carType');
                selectCarType.innerHTML = ""; // Clear existing options
                data.forEach(option => {
                  const optionElement = document.createElement('option');
                  optionElement.value = option.Car_ID;
                  optionElement.text = option.Car_Name;
                  selectCarType.add(optionElement);
                });
             
              var selectedCar = document.getElementById('carType').value;

              fetch('displayPrice.php', { // nested fetch to ensure the car is there to then get it's price
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: 'carType=' + selectedCar + '&startDate=' + document.getElementById('startDate').value + '&endDate=' + document.getElementById('endDate').value,
            })
            .then(response => response.json()) // Expecting JSON response
        .then(data => {
            const priceDisplay = document.getElementById('priceDisplay');
            const hiddenPrice = document.getElementById('hiddenPrice');

            if(data != null){
            priceDisplay.textContent = 'Price: $' + data; // Assuming 'data' is the price value
            hiddenPrice.value = data;
            
        } else {
          priceDisplay.textContent = 'Price: not Available'; // Assuming 'data' is the price value
          hiddenPrice.value = '';
        }
        })
        .catch(error => console.error('Error fetching price:', error));
      }) 
        .catch(error => console.error('Error fetching car types:', error));
      }
    

      document.getElementById('officeLoc').addEventListener('change', function(){
        var selectedValue = this.value;
        fetchCars(selectedValue);
      });


          

          fetch('displayCard.php')
            .then(response => response.json())
            .then(data => {
              // Get the select element
              const select = document.getElementById('cardNum');

              // Loop through the data and create options
              data.forEach(option => {
                const optionElement = document.createElement('option');
                //optionElement.value = option;
                optionElement.value = option.Card_ID;
                optionElement.text = option.Card_ID;
                select.add(optionElement);
              });
            })
            .catch(error => console.error('Error fetching data:', error));
  </script>
</body>

</html>