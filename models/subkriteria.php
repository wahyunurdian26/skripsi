<?php
class subkriteria
{
    var $id_kriteria, $id_sub_kriteria, $parameter, $nilai;
    function Setid_kriteria()
    {
        if (isset($_POST['id_kriteria'])) {
            $id_kriteria = $_POST['id_kriteria'];
        }
        $this->id_kriteria = $id_kriteria;
    }

    function Setid_sub_kriteria()
    {
        if (isset($_POST['id_sub_kriteria'])) {
            $id_sub_kriteria = $_POST['id_sub_kriteria'];
        }
        $this->id_sub_kriteria = $id_sub_kriteria;
    }

    function Setparameter()
    {
        if (isset($_POST['parameter'])) {
            $parameter = $_POST['parameter'];
        }
        $this->parameter = $parameter;
    }

    function Setnilai()
    {
        if (isset($_POST['nilai'])) {
            $nilai = $_POST['nilai'];
        }
        $this->nilai = $nilai;
    }

    function Getid_kriteria()
    {
        return $this->id_kriteria;
    }

    function Getid_sub_kriteria()
    {
        return $this->id_sub_kriteria;
    }

    function Getparameter()
    {
        return $this->parameter;
    }

    function Getnilai()
    {
        return $this->nilai;
    }
}
