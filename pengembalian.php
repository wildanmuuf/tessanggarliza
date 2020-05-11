<?php
    include_once ('config/connection.php');
    $transaksi_id = $_GET['bit'];
    if(!empty($transaksi_id)){
        $sql_baca_qty = "SELECT transaksi.qty, transaksi.busana_id, transaksi.status, detail_busana.stok_busana, detail_busana.ukuran_id 
            FROM transaksi, detail_busana where transaksi_id='$transaksi_id' 
            and detail_busana.busana_id = transaksi.busana_id";
        $baca_qty = mysqli_query($connection,$sql_baca_qty);
        $data_qty = mysqli_fetch_assoc($baca_qty);
        echo mysqli_error($connection);
        if($data_qty['status'] == "Disewa"){
            if($data_qty['qty'] > 0){
                $sql_update_status = "UPDATE transaksi SET status = 'Selesai' 
                where transaksi_id='$transaksi_id'";
                $update_status = mysqli_query($connection, $sql_update_status);
                $busana_id = $data_qty['busana_id'];
                $ukuran_id = $data_qty['ukuran_id'];
                $stok = $data_qty['qty']+$data_qty['stok_busana'];
                $sql_update_stok = "UPDATE detail_busana SET stok_busana = '$stok' 
                    where busana_id = '$busana_id' and ukuran_id = '$ukuran_id'";
                $update_stok = mysqli_query($connection, $sql_update_stok);
                if($update_stok){
                    header('Location:index.php');
                }
            }
        }else{
            echo '<script language="JavaScript">';
                echo 'alert("Transaksi sudah selesai!");';
                echo 'window.location.href = "riwayat.php";';
            echo '</script>';
        }
    }
?>