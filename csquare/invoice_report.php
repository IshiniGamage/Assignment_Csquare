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

// Define $result as null initially
$result = null;

// Check if the form is submitted with date range
if (isset($_POST['search'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
// Before executing the query

    // Write the SQL query for the Invoice Report based on date range
    $sql = "SELECT 
                invoice.invoice_no,
                invoice.date,
                customers.customer_name AS customer,
                customers.district,
                COUNT(invoice_master.item_id) AS item_count,
                SUM(invoice_master.amount) AS invoice_amount
            FROM
                invoice
                INNER JOIN customers ON invoice.customer = customers.id
                INNER JOIN invoice_master ON invoice.invoice_no = invoice_master.invoice_no
            WHERE
                invoice.date BETWEEN '$start_date' AND '$end_date'
            GROUP BY
                invoice.invoice_no";

    // Execute the query and fetch data
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Invoice Report</title>
    <link rel="stylesheet" href="report.css"> 

</head>
<body>
<div class="container">
<div class="card blue-card">
    <h2>Invoice Report</h2>
    <br>
    <br>
    <form method="POST">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" required>
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" required>
        <button class="btn" type="submit" name="search">Search</button>
    </form>

    <!-- Display the fetched data in a table -->
    <?php if ($result && $result->num_rows > 0) { ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Customer District</th>
                    <th>Item Count</th>
                    <th>Invoice Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['invoice_no']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['customer']; ?></td>
                        <td><?php echo $row['district']; ?></td>
                        <td><?php echo $row['item_count']; ?></td>
                        <td><?php echo $row['invoice_amount']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } elseif (isset($_POST['search'])) { ?>
        <p>No data found for the selected date range.</p>
    <?php } ?>

    <br>
    <a class="btn" href="invoice_report.php">Invoice Report</a>
    <a class="btn" href="item_report.php">Item Report</a>
    <a class="btn" href="invoice_item_report.php">Invoice Item Report</a>
    <a class="btn" href="customer.php">Home</a>


    </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
