<?php
class alternatif
{
    var $id_alternatif,  $nama_alternatif;

    function Setid_alternatif()
    {
        if (isset($_POST['id_alternatif'])) {
            $id_alternatif = $_POST['id_alternatif'];
        }
        $this->id_alternatif = $id_alternatif;
    }

    function Setnama_alternatif()
    {
        if (isset($_POST['nama_alternatif'])) {
            $nama_alternatif = $_POST['nama_alternatif'];
        }
        $this->nama_alternatif = $nama_alternatif;
    }

    function Getid_alternatif()
    {
        return $this->id_alternatif;
    }


    function Getnama_alternatif()
    {
        return $this->nama_alternatif;
    }
}
