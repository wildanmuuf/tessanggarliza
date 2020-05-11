<?php
    date_default_timezone_set('Asia/Jakarta');
    include_once ('config/connection.php');
    include_once ('config/custom_id.php');
    
    if($_POST['simpan']){
        //Membuat customize id
        // $query = "SELECT SUBSTRING(MAX(client_id),2,4) as maxKode FROM klien ";
        // $hasil = mysqli_query($connection,$query);
        // $data = mysqli_fetch_array($hasil);
        // $count = (int) $data['maxKode'];
        // $count++;
        // $char = "C";
        // $client_id = $char . sprintf("%04s", $count);

        //membuat variabel dari data yang dimasukkan
        $client_id = customId("klien", "client_id", "C", $connection);
        $busana_id = 1;
        $ukuran_id = 3;
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $lama_sewa = $_POST['lama_sewa'];
        $qty = $_POST['jumlah'];
        $tanggal_transaksi = date('d-m-Y H:i:s');
        $tanggal_awal = date("d-m-Y", strtotime($_POST['tanggal']));
        $first_date = new DateTime($_POST['tanggal']);
        $iv = new DateInterval('P'.($lama_sewa-1).'D');
        $date = $first_date->add($iv);
        $tanggal_akhir = $date->format('d-m-Y');
        $disewa = "Disewa";
        $transaksi_id = customId("transaksi", "transaksi_id", "T", $connection);
        //menyimpan data ke database
        $sql_baca_stok = "SELECT stok_busana from detail_busana where busana_id = '$busana_id' and ukuran_id = '$ukuran_id'";
        $baca_stok = mysqli_query($connection,$sql_baca_stok);
        $data_stok = mysqli_fetch_assoc($baca_stok);
        if($data_stok['stok_busana'] >= $qty){
            $stok = $data_stok['stok_busana'] - $qty;
            $sql_klien = "INSERT INTO klien (client_id, client_name) VALUES ('$client_id', '$nama_pelanggan')";
            $simpan_klien = mysqli_query($connection, $sql_klien);
            if($simpan_klien){
                $sql_update_stok = "UPDATE detail_busana SET stok_busana = '$stok' where busana_id = '$busana_id' and ukuran_id = '$ukuran_id'";
                $update_stok = mysqli_query($connection, $sql_update_stok);
                $sql_transaksi = "INSERT INTO transaksi (transaksi_id, tanggal_transaksi, tanggal_sewa, tanggal_kembali, qty, status, busana_id, client_id) 
                VALUES ('$transaksi_id','$tanggal_transaksi', '$tanggal_awal', '$tanggal_akhir', '$qty','$disewa', '$busana_id', '$client_id')"; 
                $simpan = mysqli_query($connection, $sql_transaksi);
                
                if($simpan){
                    header('Location:riwayat.php');
                }
            }
        }else{
            echo '<script language="JavaScript">';
                echo 'alert("Jumlah permintaan melebihi jumlah stok yang tersedia");';
                echo 'window.location.href = "penyewaan_busana.php";';
            echo '</script>';
           
        }
    }
?>