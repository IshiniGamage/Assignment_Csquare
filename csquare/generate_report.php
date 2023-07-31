<?php
require_once __DIR__ . '/vendor/autoload.php';

// Function to fetch the invoice report data from the database
function getInvoiceReportData() {
    // Implement your database query here to fetch the required data for the report
    // Example data for demonstration
    $tableData = array(
        array('INV-001', '2023-07-30', 'John Doe', 'District A', '5', '$100'),
        array('INV-002', '2023-07-31', 'Jane Smith', 'District B', '3', '$50'),
        // Add more data as needed
    );

    return $tableData;
}

// Function to generate the PDF report
function generatePDFReport($tableData) {
    // Create new mPDF instance
    $mpdf = new \Mpdf\Mpdf();

    // Add a page
    $mpdf->AddPage();

    // Set HTML content
    $html = '
        <h1>Invoice Report</h1>
        <table border="1" cellspacing="0" cellpadding="5">
            <tr>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Customer District</th>
                <th>Item Count</th>
                <th>Invoice Amount</th>
            </tr>';

    foreach ($tableData as $row) {
        $html .= '
            <tr>
                <td>'.$row[0].'</td>
                <td>'.$row[1].'</td>
                <td>'.$row[2].'</td>
                <td>'.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[5].'</td>
            </tr>';
    }

    $html .= '</table>';

    // Write the HTML content to the PDF
    $mpdf->WriteHTML($html);

    // Output the PDF
    $mpdf->Output('report.pdf', 'D');
}

// Fetch the invoice report data
$invoiceReportData = getInvoiceReportData();

// Generate the PDF report
generatePDFReport($invoiceReportData);
