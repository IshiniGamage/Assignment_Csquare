<?php
include 'connection.php';

$sql = "SELECT
            item.item_name,
            item_category.category AS item_category,
            item_subcategory.sub_category AS item_subcategory,
            item.quantity AS item_quantity
        FROM
            item
            INNER JOIN item_category ON item.item_category = item_category.id
            INNER JOIN item_subcategory ON item.item_subcategory = item_subcategory.id
        GROUP BY
            item.item_name";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Item Report</title>
    <link rel="stylesheet" href="report.css"> <!-- Replace with your CSS file -->

</head>
<body>
    <div class="container">
        <div class="card blue-card">
            <h2>Item Report</h2>
<hr>
            <table>
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Item Category</th>
                        <th>Item Subcategory</th>
                        <th>Item Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['item_name']; ?></td>
                            <td><?php echo $row['item_category']; ?></td>
                            <td><?php echo $row['item_subcategory']; ?></td>
                            <td><?php echo $row['item_quantity']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <hr>
<br>
            <div class="buttons">
                <a class="btn" href="invoice_report.php">Invoice Report</a>
                <a class="btn" href="item_report.php">Item Report</a>
                <a class="btn" href="invoice_item_report.php">Invoice Item Report</a>
                <a class="btn" href="customer.php">Home</a>

            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
