<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Update Customer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>


<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">Update Customer</h1>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "Gamage@1998";
                $dbname = "csquare";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if (isset($_POST["update_customer_submit"])) {
                    // Sanitize and retrieve form data
                    $customer_id = $_POST["customer_id"];
                    $title = $_POST["title"];
                    $first_name = $_POST["first_name"];
                    $last_name = $_POST["last_name"];
                    $contact_number = $_POST["contact_number"];
                    $district = $_POST["district"];

                    // Prepare and execute the SQL query to update customer data
                    $sql = "UPDATE customers SET title='$title', first_name='$first_name', last_name='$last_name', contact_number='$contact_number', district='$district' WHERE customer_id='$customer_id'";

                    if ($conn->query($sql) === true) {
                        echo "<p class='text-success text-center'>Customer updated successfully!</p>";
                        // Redirect to the customer page after a successful update
                        header("Location: customer.php");
                        exit;
                    } else {
                        echo "<p class='text-danger text-center'>Error: " . $sql . "<br>" . $conn->error . "</p>";
                    }
                }

                // Fetch customer data for the selected customer_id
                if (isset($_GET["customer_id"])) {
                    $customer_id = $_GET["customer_id"];
                    $sql = "SELECT * FROM customers WHERE customer_id='$customer_id'";
                    $result = $conn->query($sql);
                    $customer_data = $result->fetch_assoc();
                }

                // Fetch districts from the database
                $sql = "SELECT * FROM district WHERE active = 'yes'";
                $result = $conn->query($sql);
                $districts = array();
                while ($row = $result->fetch_assoc()) {
                    $districts[] = $row["district"];
                }

                // Close the database connection
                $conn->close();
                ?>
                <form action="" method="POST">
                    <input type="hidden" name="customer_id" value="<?php echo $customer_data['customer_id']; ?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <select class="form-control" name="title" required="">
                            <option value="Mr" <?php if ($customer_data['title'] == 'Mr') echo 'selected'; ?>>Mr</option>
                            <option value="Mrs" <?php if ($customer_data['title'] == 'Mrs') echo 'selected'; ?>>Mrs</option>
                            <option value="Miss" <?php if ($customer_data['title'] == 'Miss') echo 'selected'; ?>>Miss</option>
                            <option value="Dr" <?php if ($customer_data['title'] == 'Dr') echo 'selected'; ?>>Dr</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" class="form-control" name="first_name" value="<?php echo $customer_data['first_name']; ?>" required="">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" value="<?php echo $customer_data['last_name']; ?>" required="">
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact Number:</label>
                        <input type="text" class="form-control" name="contact_number" value="<?php echo $customer_data['contact_number']; ?>" required="">
                    </div>
                    <div class="mb-3">
                        <label for="district" class="form-label">District:</label>
                        <select class="form-control" name="district" required="">
                            <?php
                            foreach ($districts as $district_option) {
                                $selected = ($customer_data['district'] == $district_option) ? 'selected' : '';
                                echo "<option value='$district_option' $selected>$district_option</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" name="update_customer_submit">Update</button>
                        <a class="btn btn-secondary" href="customer.php">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
