<?php include "head.php"?>
    <body>
        <div class="center-bottom">
            <fieldset class="gold-border">
            <button>
                    <a href='index.php'>Home</a>
                </button> &nbsp;&nbsp;&nbsp;
                <button>
                    <a href='laporan.php'>Cetak Laporan</a>
                </button>
                <table class="gold-border">
                    <thead>
                        <tr class="table-border">
                            <th>Tanggal</th>
                            <th>Klien</th>
                            <th>Busana</th>
                            <th>Sewa</th>
                            <th>Selesai</th>
                            <th>Ukuran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once ('config/connection.php');
                            $sql = "SELECT busana.busana_id, busana.nama_busana, transaksi.transaksi_id,
                                    transaksi.tanggal_transaksi, transaksi.tanggal_sewa, 
                                    transaksi.tanggal_kembali, transaksi.qty,
                                    ukuran.ukuran, klien.client_name
                                    from busana, ukuran, detail_busana, transaksi, klien
                                    where busana.busana_id = detail_busana.busana_id 
                                    and ukuran.ukuran_id = detail_busana.ukuran_id
                                    and klien.client_id = transaksi.client_id
                                    and transaksi.busana_id = busana.busana_id group by transaksi.transaksi_id";
                            $query = mysqli_query($connection,$sql);
                            while($datas = mysqli_fetch_assoc($query)){
                                echo "<tr>";
                                echo "<td style='width: 200px'>".$datas['tanggal_transaksi']."</td>";
                                echo "<td style='width: 200px'>".$datas['client_name']."</td>";
                                echo "<td style='width: 200px'>".$datas['nama_busana']."</td>";
                                echo "<td style='width: 200px'>".$datas['tanggal_sewa']."</td>";
                                echo "<td style='width: 200px'>".$datas['tanggal_kembali']."</td>";
                                echo "<td style='width: 200px'>".$datas['ukuran']."</td>";
                                echo "<td style='width: 200px'><a href = 'pengembalian.php?bit=".$datas['transaksi_id']."';'>Selesai </a> </td>";
                                echo "</tr>";
                            }
                            ?>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </body>
</html>