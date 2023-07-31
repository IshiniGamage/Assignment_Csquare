<?php
// invoice_item_report.php
include 'connection.php';

// Check if the form is submitted with date range
if (isset($_POST['search'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Write the SQL query for the Invoice Item Report based on date range
    $sql = "SELECT 
    invoice.invoice_no,
    invoice.date AS invoiced_date,
    customers.first_name AS customer_first_name,
    customers.last_name AS customer_last_name,
    item.item_name,
    item.item_code,
    item_category.category AS item_category,
    item.unit_price AS item_unit_price
FROM
    invoice
    INNER JOIN customers ON invoice.customer = customers.customer_id
    INNER JOIN invoice_master ON invoice.invoice_no = invoice_master.invoice_no
    INNER JOIN item ON invoice_master.item_id = item.id
    INNER JOIN item_category ON item.item_category = item_category.id
WHERE
    invoice.date BETWEEN '$start_date' AND '$end_date'";

    // Execute the query and fetch data
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Invoice Item Report</title>
    <link rel="stylesheet" href="report.css"> 

</head>
<body>
<div class="container">
<div class="card blue-card">
    <h2>Invoice Item Report</h2>
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
    <?php if (isset($result) && $result->num_rows > 0) { ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Invoiced Date</th>
                    <th>Customer Name</th>
                    <th>Item Name</th>
                    <th>Item Code</th>
                    <th>Item Category</th>
                    <th>Item Unit Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['invoice_no']; ?></td>
                        <td><?php echo $row['invoiced_date']; ?></td>
                        <td><?php echo $row['customer_first_name'] . ' ' . $row['customer_last_name']; ?></td>
                        <td><?php echo $row['item_name']; ?></td>
                        <td><?php echo $row['item_code']; ?></td>
                        <td><?php echo $row['item_category']; ?></td>
                        <td><?php echo $row['item_unit_price']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else if (isset($result) && $result->num_rows === 0) { ?>
        <p>No data found for the selected date range.</p>
    <?php } ?>

    <!-- Add navigation links or buttons to other reports or pages -->
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
// Close the database connection at the end of the file
$conn->close();
?>
