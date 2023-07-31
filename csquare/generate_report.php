<?php
require_once __DIR__ . '/vendor/autoload.php';

function getInvoiceReportData() {
   
    $tableData = array(
        array('INV-001', '2023-07-30', 'John Doe', 'District A', '5', '$100'),
        array('INV-002', '2023-07-31', 'Jane Smith', 'District B', '3', '$50'),
    );

    return $tableData;
}

function generatePDFReport($tableData) {
    $mpdf = new \Mpdf\Mpdf();

    $mpdf->AddPage();

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

    $mpdf->WriteHTML($html);

    $mpdf->Output('report.pdf', 'D');
}

$invoiceReportData = getInvoiceReportData();

generatePDFReport($invoiceReportData);
