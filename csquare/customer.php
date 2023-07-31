<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Csquare Pvt(Ltd) - Customer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>


<body>
<nav class="navbar navbar-expand-lg navbar-info" style="background-color: black;">
        <div class="container d-flex justify-content-between">
            <div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                        <a class="nav-link text-white" href="#">
                            <img src="img/logo1.png" alt="Logo" width="100" height="40" class="d-inline-block align-top">
                            <span class="sr-only"></span>
                        </a>                        </li>
                    </ul>
                </div>
            </div>

            <div>
                <a class="navbar-brand text-white" href="#">Csquare Pvt (Ltd)</a>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</br>


<div class="container" >
    <div class="row mt-4">
        
        <div class="col-md-12">
            <div class="card"style="width:100%, height:100px">
                <div  class="card-header text-dark" style="background-color:gray;">
                    <h4>Functions</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a class="text-decoration-none text-white" href="">
                                <div class="card my-card shadow text-center p-3" style="background-color:rgb(11,109,202);">
                                    <h4>Customers <i class="fas fa-users"></i></h4>
                                </div>
                            </a>
                        </div>
              
                       
                        <div class="col-md-4" >
                            <a class="text-decoration-none text-white" href="item.php">
                                <div class="card my-card shadow text-center p-3" style="background-color:rgb(11,109,202); ">
                                    <h4>Items <i class="fas fa-box"></i></h4>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-4">
                  
                        <form id="reportForm" action="item_report.php" method="post" target="_blank" style="display: none;">
                        <button type="submit" name="generate_report"></button>
                    </form>

                    <a class="text-decoration-none text-white" href="item_report.php" onclick="generateReport();">
                        <div class="card my-card shadow text-center p-3" style="background-color: rgb(11, 109, 202);">
                            <h4>Generate Report <i class="fas fa-file"></i></h4>
                        </div>
                    </a>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</br>
    <div class="container">
    <div class="row mt-4">
        <div class="col-md-4 border p-3">
            <h4><u>Add Customer</u></h4>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <select class="form-control" name="title" required="">
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Miss">Miss</option>
                            <option value="Dr">Dr</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" class="form-control" name="first_name" required="">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" required="">
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact Number:</label>
                        <input type="text" class="form-control" name="contact_number" required="">
                    </div>
                    <div class="mb-3">
                        <label for="district" class="form-label">District:</label>
                        <select class="form-control" name="district" required="">
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "Gamage@1998";
                            $dbname = "csquare";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql = "SELECT * FROM district WHERE active = 'yes'";
                            $result = $conn->query($sql);

                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["district"] . "'>" . $row["district"] . "</option>";
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success" name="add_customer">Add Customer</button>
                </form>
            </div>
            <div class="col-md-8 border p-3">
                <h4><u>Customer Details</u></h4>
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search by Name" name="search">
                        <button type="submit" class="btn btn-primary" name="search_submit">Search</button>
                    </div>
                </form>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "Gamage@1998";
                $dbname = "csquare";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if (isset($_POST["add_customer"])) {
                    $title = $_POST["title"];
                    $first_name = $_POST["first_name"];
                    $last_name = $_POST["last_name"];
                    $contact_number = $_POST["contact_number"];
                    $district = $_POST["district"];

                    $sql = "INSERT INTO customers (title, first_name, last_name, contact_number, district)
                            VALUES ('$title', '$first_name', '$last_name', '$contact_number', '$district')";

                    if ($conn->query($sql) === true) {
                        echo "<p class='text-success'>Customer added successfully!</p>";
                    } else {
                        echo "<p class='text-danger'>Error: " . $sql . "<br>" . $conn->error . "</p>";
                    }
                }

                if (isset($_POST["search_submit"])) {
                    $search = $_POST["search"];
                    $sql = "SELECT * FROM customers WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%'";
                } else {
                    $sql = "SELECT * FROM customers";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table table-striped table-bordered'>";
                    echo "<thead><tr><th>ID</th><th>Title</th><th>First Name</th><th>Last Name</th><th>Contact Number</th><th>District</th><th>Activity</th></tr></thead>";
                    echo "<tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["customer_id"] . "</td>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["first_name"] . "</td>";
                        echo "<td>" . $row["last_name"] . "</td>";
                        echo "<td>" . $row["contact_number"] . "</td>";
                        echo "<td>" . $row["district"] . "</td>";
                        echo "<td>";
                        echo "<a href='update_customer.php?customer_id=" . $row["customer_id"] . "' class='btn btn-info btn-sm'>Update</a>";
                        echo "<a href='delete_customer.php?id=" . $row["customer_id"] . "' onclick=\"return confirm('Are you sure you want to delete this customer?')\"><button type='submit' class='btn btn-danger btn-sm' name='delete_customer'>Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<p>No customers found</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>
            </br>
    <footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <h6>About</h6>
        <p class="text-justify">Welcome to Csquare Pvt(Ltd), your trusted partner in providing comprehensive ERP (Enterprise Resource Planning) solutions tailored to streamline and optimize your business processes. With a focus on innovation and efficiency, we strive to empower businesses of all sizes to achieve their full potential.</p>
      </div>

      <div class="col-xs-6 col-md-3">
        <h6>Contact Us</h6>
        <ul class="footer-links">
          <li>NO:689</li>
          <li>Union Place</li>
          <li>Colombo</li>
          <li>+94112895367</li>
          <li>csquare@gmail.com</li>


        </ul>
      </div>

      <div class="col-xs-6 col-md-3">
        <h6>Quick Links</h6>
        <ul class="footer-links">
          <li><a href="about.html">About Us</a></li>
          <li><a href="contact.html">Contact Us</a></li>
        </ul>
      </div>
    </div>
    <hr>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-6 col-xs-12">
        <p>&copy; 2023 Csquare Pvt(Ltd). All rights reserved.</p>
        </p>
      </div>

      <div class="col-md-4 col-sm-6 col-xs-12">
        <ul class="social-icons">
          <li><a class="facebook" href="#"><i class="fab fa-facebook"></i></a></li>
          <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
          <li><a class="dribbble" href="#"><i class="fab fa-dribbble"></i></a></li>
          <li><a class="linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
        </ul>
        
      </div>
    </div>
  </div>
</footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
function generateReport() {
    document.getElementById('reportForm').submit();
}
</script>
</body>
</html>
