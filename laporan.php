<?php
    require('fpdf/fpdf.php');
    include('config/connection.php');
    error_reporting(0);

    $pdf = new FPDF("L","cm","A4");
    $pdf->SetMargins(0.5,1,1);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','B',11);
    $pdf->SetX(4);            
    $pdf->MultiCell(22,5,'LAPORAN TRANSAKSI',0,'C');
    $pdf->ln(1);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
    $pdf->Cell(5, 0.8, 'CLIENT ID', 1, 0, 'C');
    $pdf->Cell(5, 0.8, 'NAMA BUSANA', 1, 0, 'C');
    $pdf->Cell(5.5, 0.8, 'UKURAN', 1, 0, 'C');
    $pdf->Cell(5.5, 0.8, 'TANGGAL SEWA', 1, 0, 'C');
    $pdf->Cell(2.5, 0.8, 'Qty KELUAR', 1, 0, 'C');
    $pdf->Cell(2.5, 0.8, 'STOK TERSISA', 1, 1, 'C');
    $pdf->SetFont('Arial','',9);
    $no=1;
    $sql = "SELECT klien.client_id, busana.nama_busana, ukuran.ukuran, 
    transaksi.tanggal_sewa, transaksi.qty, detail_busana.stok_busana 
    from transaksi, klien, busana, ukuran, detail_busana
    where klien.client_id = transaksi.client_id and
    busana.busana_id = transaksi.busana_id and
    ukuran.ukuran_id = detail_busana.ukuran_id and
    busana.busana_id = detail_busana.busana_id group by transaksi.transaksi_id ";
    $query=mysqli_query($connection, $sql);
    while($lihat=mysqli_fetch_array($query)){
    
        $pdf->Cell(1, 0.8, $no, 1, 0, 'C');
        $pdf->Cell(5, 0.8, $lihat['client_id'], 1, 0,'C');
        $pdf->Cell(5, 0.8, $lihat['nama_busana'], 1, 0,'C');
        $pdf->Cell(5.5, 0.8, $lihat['ukuran'],1, 0, 'C');
        $pdf->Cell(5.5, 0.8, $lihat['tanggal_sewa'],1, 0, 'C');
        $pdf->Cell(2.5, 0.8, $lihat['qty'], 1, 0,'C');
        $pdf->Cell(2.5, 0.8, $lihat['stok_busana'], 1, 1,'C');
        $no++;
    }

    $pdf->Output("laporan.pdf","I");
?>