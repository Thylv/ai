<?php
require('relat/fpdf/fpdf.php');

class MeuPDF extends FPDF {
    function Header() {
        
        $this->SetFont('Arial','B',16);
        $this->Cell(0,10,utf8_decode('Relatório da Tabela de Usuários'),0,1,'C');
    }

    function Footer() {
        
        $this->SetY(-15);
        $this->SetFont('Arial','I',10);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');
    }
}
?>
