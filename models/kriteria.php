<?php
class kriteria
{
    var $id_kriteria, $nama, $bobot;
    function Setid_kriteria()
    {
        if (isset($_POST['id_kriteria'])) {
            $id_kriteria = $_POST['id_kriteria'];
        }
        $this->id_kriteria = $id_kriteria;
    }

    function Setnama()
    {
        if (isset($_POST['nama'])) {
            $nama = $_POST['nama'];
        }
        $this->nama = $nama;
    }

    function Setbobot()
    {
        if (isset($_POST['bobot'])) {
            $bobot = $_POST['bobot'];
        }
        $this->bobot = $bobot;
    }

    function Getid_kriteria()
    {
        return $this->id_kriteria;
    }

    function Getnama()
    {
        return $this->nama;
    }

    function Getbobot()
    {
        return $this->bobot;
    }
}
