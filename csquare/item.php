<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Item Page</title>
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
                            <a class="text-decoration-none text-white" href="customer.php">
                                <div class="card my-card shadow text-center p-3" style="background-color:rgb(11,109,202);">
                                    <h4>Customers <i class="fas fa-users"></i></h4>
                                </div>
                            </a>
                        </div>
              
                       
                             <div class="col-md-4" >
                                <a class="text-decoration-none text-white" href="">
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
    <br>
    <div class="container">
        <div class="row mt-4">
            <!-- Add Item Form -->
            <div class="col-md-4 border p-3">
                <h4><u>Add Item</u></h4>
                <form action="insert_item.php" method="POST">
                    <div class="mb-3">
                        <label for="item_code" class="form-label">Item Code:</label>
                        <input type="text" class="form-control" name="item_code" required>
                    </div>
                    <div class="mb-3">
                        <label for="item_name" class="form-label">Item Name:</label>
                        <input type="text" class="form-control" name="item_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="item_category" class="form-label">Category:</label>
                        <select class="form-control" name="item_category" required>
                            <?php
                            // PHP code to fetch categories from the database and generate options
                            include 'connection.php';

                            $sql = "SELECT * FROM item_category";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["id"] . "'>" . $row["category"] . "</option>";
                                }
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="item_subcategory" class="form-label">Subcategory:</label>
                        <select class="form-control" name="item_subcategory" required>
                            <?php
                            // PHP code to fetch subcategories from the database and generate options
                            include 'connection.php';

                            $sql = "SELECT * FROM item_subcategory";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["id"] . "'>" . $row["sub_category"] . "</option>";
                                }
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="text" class="form-control" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="unit_price" class="form-label">Unit Price:</label>
                        <input type="text" class="form-control" name="unit_price" required>
                    </div>
                    <button type="submit" class="btn btn-success" name="add_item">Add Item</button>
                </form>
            </div>

            <!-- Item List Table -->
            <div class="col-md-8 border p-3">
                <h4><u>Item List</u></h4>
                <form class="d-flex" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search by Item Code or Name" name="search">
                        <button class="btn btn-primary" type="submit" name="search_submit">Search</button>
                    </div>
                </form>
                <br>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Database connection and helper functions
                        include 'connection.php';

                        // Helper functions
                        function getCategoryName($conn, $category_id)
                        {
                            $sql = "SELECT * FROM item_category WHERE id = '$category_id'";
                            $result = $conn->query($sql);
                        
                            if ($result->num_rows == 1) {
                                $row = $result->fetch_assoc();
                                return $row["category"];
                            } else {
                                return "N/A";
                            }
                        }
                        
                        function getSubCategoryName($conn, $subcategory_id)
                        {
                            $sql = "SELECT * FROM item_subcategory WHERE id = '$subcategory_id'";
                            $result = $conn->query($sql);
                        
                            if ($result->num_rows == 1) {
                                $row = $result->fetch_assoc();
                                return $row["sub_category"];
                            } else {
                                return "N/A";
                            }
                        }
                        
                        
                        
                    // Handle adding an item to the database
                    if (isset($_POST["add_item"])) {
                        $item_code = $_POST["item_code"];
                        $item_name = $_POST["item_name"];
                        $item_category = $_POST["item_category"];
                        $item_subcategory = $_POST["item_subcategory"];
                        $quantity = $_POST["quantity"];
                        $unit_price = $_POST["unit_price"];

                        $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price)
                                VALUES ('$item_code', '$item_name', '$item_category', '$item_subcategory', '$quantity', '$unit_price')";

                        if ($conn->query($sql) === true) {
                            $_SESSION['success_message'] = "Item added successfully.";
                        } else {
                            $_SESSION['error_message'] = "Error adding item: " . $conn->error;
                        }

                        // Redirect back to the "item.php" page
                        header("Location: item.php");
                        exit();
                    }
                        // Handle the search functionality
                        if (isset($_POST["search_submit"])) {
                            $search = $_POST["search"];
                            $sql = "SELECT * FROM item WHERE item_code LIKE '%$search%' OR item_name LIKE '%$search%'";
                        } else {
                            $sql = "SELECT * FROM item";
                        }

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["item_code"] . "</td>";
                                echo "<td>" . $row["item_name"] . "</td>";
                                echo "<td>" . getCategoryName($conn, $row["item_category"]) . "</td>";
                                echo "<td>" . getSubCategoryName($conn, $row["item_subcategory"]) . "</td>";
                                echo "<td>" . $row["quantity"] . "</td>";
                                echo "<td>" . $row["unit_price"] . "</td>";
                                echo "<td>";
                                echo "<a href='update_item.php?id=" . $row["id"] . "' class='btn btn-info btn-sm'>Update</a>";
                                echo "<a href='delete_item.php?id=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this item?')\"><button type='submit' class='btn btn-danger btn-sm' name='delete_customer'>Delete</button>";
                                echo "</td>";
                                echo "</tr>";
                    } 
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No items found.</td></tr>";
                        }

                        // Close the database connection
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br>
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
    // Find the form and submit it
    document.getElementById('reportForm').submit();
}
</script>
</body>
</html>

