<?php include "head.php"?>
    <body>
        <form action="tambah_transaksi.php" method="POST">
            <div class="center-bottom">
                <fieldset>
                    <ol>
                    <h2>BUSANA&nbsp;A</h2>
                        <li>
                            Nama Pelanggan &nbsp; :
                            <input type="text" class="input-form" name="nama_pelanggan" placeholder="Nama Pelanggan" required/>
                        </li>
                        <li>
                            Tanggal Sewa &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                            <input type="date" class="input-form" id="tgl" name="tanggal" required/>
                        </li>
                        <li>
                            Lama Sewa &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                            <input type="text" class="input-form" onkeypress="return onlynumber(event)" name="lama_sewa" placeholder="Lama Sewa" maxlength="2" required/> &nbsp;&nbsp;hari
                        </li>
                        <li>
                            Jumlah &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                            <input type="text" class="input-form" onkeypress="return onlynumber(event)" maxlength="4" name="jumlah" placeholder="Jumlah" required/>
                        </li>
                    </table>
                    <li>
                        <input type="submit" name="simpan" class="gold-button gold-border" value="Pesan" />
                    </li>
                    </ol>
                </fieldset>
            </div>
        </form>
    </body>

    <script type="text/javascript">
        document.getElementById('tgl').valueAsDate = new Date();

        function onlynumber(e){
    		var numChar = (e.which) ? e.which : event.keyCode
    		if(numChar > 31 && (numChar < 48 || numChar > 57))
    		    return false;
    	    return pue;
    	}
    </script>
</html>