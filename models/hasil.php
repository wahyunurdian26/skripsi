<?php
class hasil
{
    var $id_alternatif,  $nilai_hasil;

    function Setid_alternatif()
    {
        if (isset($_POST['id_alternatif'])) {
            $id_alternatif = $_POST['id_alternatif'];
        }
        $this->id_alternatif = $id_alternatif;
    }

    function Setnilai_hasil()
    {
        if (isset($_POST['nilai_hasil'])) {
            $nilai_hasil = $_POST['nilai_hasil'];
        }
        $this->nilai_hasil = $nilai_hasil;
    }

    function Getid_alternatif()
    {
        return $this->id_alternatif;
    }


    function Getnilai_hasil()
    {
        return $this->nilai_hasil;
    }
}
