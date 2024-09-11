<?php
class bobot
{
    var $id_alternatif, $id_bobot_alternatif, $nilai;

    function Setid_alternatif()
    {
        if (isset($_POST['id_alternatif'])) {
            $id_alternatif = $_POST['id_alternatif'];
        }
        $this->id_alternatif = $id_alternatif;
    }

    function Setid_bobot_alternatif()
    {
        if (isset($_POST['id_bobot_alternatif'])) {
            $id_bobot_alternatif = $_POST['id_bobot_alternatif'];
        }
        $this->id_bobot_alternatif = $id_bobot_alternatif;
    }

    function Setnilai()
    {
        if (isset($_POST['nilai'])) {
            $nilai = $_POST['nilai'];
        }
        $this->nilai = $nilai;
    }

    function Getid_alternatif()
    {
        return $this->id_alternatif;
    }

    function Getid_bobot_alternatif()
    {
        return $this->id_bobot_alternatif;
    }

    function Getnilai()
    {
        return $this->nilai;
    }
}
