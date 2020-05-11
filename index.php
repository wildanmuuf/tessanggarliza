<?php include "head.php"?>
    <body>
        <div class="center-bottom">
            <fieldset class="gold-border">
                <button>
                    <a href='riwayat.php'>Riwayat</a>
                </button>
                <table class="gold-border">
                    <thead>
                        <tr class="table-border">
                            <th>Busana</th>
                            <th>Stok</th>
                            <th>Ukuran</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once ('config/connection.php');
                            $sql = "SELECT busana.busana_id, busana.nama_busana,
                                    detail_busana.stok_busana, ukuran.ukuran, kategori.kategori
                                    from busana, ukuran, detail_busana, kategori
                                    where busana.busana_id = detail_busana.busana_id 
                                    and ukuran.ukuran_id = detail_busana.ukuran_id
                                    and kategori.kategori_id = busana.kategori_id";
                            $query = mysqli_query($connection,$sql);
                            while($datas = mysqli_fetch_assoc($query)){
                                echo "<tr>";
                                echo "<td style='width: 120px'>".$datas['nama_busana']."</td>";
                                echo "<td style='width: 120px'>".$datas['stok_busana']."</td>";
                                echo "<td style='width: 120px'>".$datas['ukuran']."</td>";
                                echo "<td style='width: 120px'>".$datas['kategori']."</td>";
                                echo "<td style='width: 120px'><a href='penyewaan_busana.php?bid=".$datas['busana_id']."'>Pilih</td>";
                                echo "</tr>";
                            }
                            ?>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </body>
</html>