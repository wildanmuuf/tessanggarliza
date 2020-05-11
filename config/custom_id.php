<?php
    function customId($table, $col, $letter, $connection){
        include_once ('connection.php');
        $query = "SELECT SUBSTRING(MAX(".$col."),2,4) as maxKode FROM ".$table;
        $hasil = mysqli_query($connection,$query);
        $data = mysqli_fetch_array($hasil);
        $count = (int) $data['maxKode'];
        $count++;
        $id = $letter . sprintf("%04s", $count);
        return $id;
    }
?>