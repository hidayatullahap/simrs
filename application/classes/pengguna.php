<?php

class Pengguna{
    private $pengguna_id;
    private $nama;
    private $nip;
    private $username;
    private $role;

    public function __construct(
    $pengguna_id=null,
    $nama=null,
    $nip=null,
    $username=null,
    $role=null) {
        $this->pengguna_id = $pengguna_id;
        $this->nama = $nama;
        $this->nip = $nip;
        $this->username = $username;
        $this->role = $role;
    }

    function setPengguna_id($pengguna_id) { $this->pengguna_id = $pengguna_id; }
    function getPengguna_id() { return $this->pengguna_id; }
    function setNama($nama) { $this->nama = $nama; }
    function getNama() { return $this->nama; }
    function setNip($nip) { $this->nip = $nip; }
    function getNip() { return $this->nip; }
    function setUsername($username) { $this->username = $username; }
    function getUsername() { return $this->username; }
    function setRole($role) { $this->role = $role; }
    function getRole() { return $this->role; }
}
?>