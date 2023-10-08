<?php
require('MeuPDF.php');


$pdf = new MeuPDF();
$pdf->AddPage('P', 'A4', 'utf-8');


$servername = "localhost";
$db_name = 'mysql:host=localhost;dbname=shop_db';
$user_name = 'root';
$user_password = '';

try {

    $conn = new PDO($db_name, $user_name, $user_password);

    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    $sql = "SELECT id, name, email, password FROM users";
    $result = $conn->query($sql);

    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',12);

    

    
    $pdf->Cell(10, 10, 'Id', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Nome', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Email', 1, 0, 'C');
    $pdf->Cell(80, 10, 'Senha', 1, 1, 'C');
    
    $pdf->SetFont('Arial', '', 10);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(10, 10, utf8_decode($row['id']), 1, 0, 'C');  
        $pdf->Cell(40, 10, utf8_decode($row['name']), 1, 0, 'C');  
        $pdf->Cell(50, 10, utf8_decode($row['email']), 1, 0, 'C');  
        $pdf->Cell(80, 10, utf8_decode($row['password']), 1, 1, 'C');  
    }


    

} 





catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}




$pdf->Output();
?>
