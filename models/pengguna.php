<?php
class Pengguna
{
    var $id_user, $id_pengguna, $nik, $nama_lengkap, $gender, $no_hp, $alamat, $email, $password, $role;

    //Public Setfunction class user
    function Setid_user()
    {
        if (isset($_POST['id_user'])) {
            $id_user = $_POST['id_user'];
        }
        $this->id_user = $id_user;
    }
    function Setid_pengguna()
    {
        if (isset($_POST['idp'])) {
            $id_pengguna = $_POST['idp'];
        }
        $this->id_pengguna = $id_pengguna;
    }

    function Setnik()
    {
        if (isset($_POST['angka'])) {
            $nik = $_POST['angka'];
        }
        $this->nik = $nik;
    }

    function Setnama_lengkap()
    {
        if (isset($_POST['nama_lengkap'])) {
            $nama_lengkap = $_POST['nama_lengkap'];
        }
        $this->nama_lengkap = $nama_lengkap;
    }

    function Setgender()
    {
        if (isset($_POST['jk'])) {
            $gender = $_POST['jk'];
        }
        $this->gender = $gender;
    }

    function Setno_hp()
    {
        if (isset($_POST['no_hp'])) {
            $no_hp = $_POST['no_hp'];
        }
        $this->no_hp = $no_hp;
    }

    function Setalamat()
    {
        if (isset($_POST['alamat'])) {
            $alamat = $_POST['alamat'];
        }
        $this->alamat = $alamat;
    }

    function Setemail()
    {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }
        $this->email = $email;
    }

    function Setpassword()
    {
        if (isset($_POST['password'])) {
            $password = base64_encode($_POST['password']);
        }
        $this->password = $password;
    }

    function Setrole()
    {
        if (isset($_POST['role'])) {
            $role = $_POST['role'];
        }
        $this->role = $role;
    }

    //Public Getfunction class user
    function Getid_user()
    {
        return $this->id_user;
    }
    function Getid_pengguna()
    {
        return $this->id_pengguna;
    }
    function Getnik()
    {
        return $this->nik;
    }

    function Getnama_lengkap()
    {
        return $this->nama_lengkap;
    }

    function Getgender()
    {
        return $this->gender;
    }

    function Getno_hp()
    {
        return $this->no_hp;
    }

    function Getalamat()
    {
        return $this->alamat;
    }

    function Getemail()
    {
        return $this->email;
    }

    function Getpassword()
    {
        return $this->password;
    }

    function Getrole()
    {
        return $this->role;
    }
}
