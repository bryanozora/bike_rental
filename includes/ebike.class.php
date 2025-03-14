<?php
    class akun
    {
        public function __construct($db = '')
        {
            $this->setConnect($db);
        }

        public function setConnect($db)
        {
            $this->db = $db;
        }

        public function getAkunByEmail($email)
        {
            $get_akun = "SELECT id, password, id_role FROM akun WHERE email = ?";
            $get_akun = $this->db->prepare($get_akun);
            $get_akun->execute([$email]);

            return $get_akun;
        }
    }

    class penyewaan
    {
        public function __construct($db = '')
        {
            $this->setConnect($db);
        }

        public function setConnect($db)
        {
            $this->db = $db;
        }

        public function getIDAkun($id){
            $get = "SELECT * FROM penyewaan WHERE id = ?";
            $get = $this->db->prepare($get);
            $get->execute([$id]);

            return $get;
        }

        public function setStatus($status, $id){
            $set = "UPDATE penyewaan SET status = ? WHERE id = ?";
            $set = $this->db->prepare($set);
            $set->execute([$status, $id]);

            return $set;

        }

        public function check_data(){
            $check_data = "SELECT * FROM penyewaan";
            $check_data = $this->db->prepare($check_data);
            $check_data->execute();

            return $check_data;
        }

        public function getAll(){
            $get_all = "SELECT * FROM penyewaan ORDER BY id ASC";
            $get_all = $this->db->prepare($get_all);
            $get_all->execute();

            return $get_all;
        }

        public function getEbikeID($id){
            $get = "SELECT * FROM penyewaan WHERE id = ?";
            $get = $this->db->prepare($get);
            $get->execute([$id]);

            return $get;
        }

        public function getPenyewaanByDetil($harga, $jam_sewa, $id_akun){
            $get = "SELECT * FROM penyewaan WHERE harga = ? AND jam_sewa = ? AND id_akun = ?";
            $get = $this->db->prepare($get);
            $get->execute([$harga, $jam_sewa, $id_akun]);

            return $get;
        }

        public function insertPenyewaan($harga, $jam, $id_akun){
            $sewa = "INSERT INTO penyewaan SET status = 1, harga = ?, jam_sewa = ?, id_akun = ?";
            $sewa = $this->db->prepare($sewa);
            $sewa->execute([$harga, $jam, $id_akun]);
        }

        public function cekSewa($id_akun){
            $cek = "SELECT * FROM penyewaan WHERE id = ? AND status != 3";
            $cek = $this->db->prepare($cek);
            $cek->execute([$id_akun]);

            return $cek;
        }

        public function editPenyewaan($id, $status, $harga, $jam_sewa){
            $edit = "UPDATE penyewaan SET status = ?, harga = ?, jam_sewa = ? WHERE id = ?";
            $edit = $this->db->prepare($edit);
            $edit->execute([$status, $harga, $jam_sewa, $id]);

            return $edit;
        }
    }

    class ebike 
    {
        public function __construct($db = '')
        {
            $this->setConnect($db);
        }

        public function setConnect($db)
        {
            $this->db = $db;
        }

        public function check_data($id_station){
            $check_data = "SELECT * FROM ebike WHERE id_estation = ?";
            $check_data = $this->db->prepare($check_data);
            $check_data->execute([$id_station]);

            return $check_data;
        }

        public function getAll(){
            $get_all = "SELECT * FROM ebike ORDER BY id ASC";
            $get_all = $this->db->prepare($get_all);
            $get_all->execute();

            return $get_all;
        }

        public function getBikeById($id){
            $get = "SELECT * FROM ebike WHERE id = ?";
            $get = $this->db->prepare($get);
            $get->execute([$id]);

            return $get;
        }

        public function insertEbike($baterai, $status_sewa, $status_keamanan, $id_station){
            $add = "INSERT INTO ebike SET baterai = ?, status_sewa = ?, status_keamanan = ?, id_estation = ?";
            $add = $this->db->prepare($add);
            $add->execute([$baterai, $status_sewa, $status_keamanan, $id_station]);

            return $add;
        }

        public function editEbike($id, $baterai, $status_sewa, $status_keamanan, $id_station){
            $edit = "UPDATE ebike SET baterai = ?, status_sewa = ?, status_keamanan = ?, id_estation = ? WHERE id = ?";
            $edit = $this->db->prepare($edit);
            $edit->execute([$baterai, $status_sewa, $status_keamanan, $id_station, $id]);

            return $edit;
        }

        public function deleteEbike($id){
            $delete = "DELETE FROM ebike WHERE id = ?";
            $delete = $this->db->prepare($delete);
            $delete->execute([$id]);

            return $delete;
        }

        public function getList($id_station){
            $count = "SELECT* FROM ebike WHERE id_estation = ?";
            $count = $this->db->prepare($count);
            $count->execute([$id_station]);

            return $count;
        }

        public function setStatusSewa($status, $id){
            $set = "UPDATE ebike SET status_sewa = ? WHERE id = ?";
            $set = $this->db->prepare($set);
            $set->execute([$status, $id]);

            return $set;
        }

        public function setStatusPengaman($status, $id){
            $set = "UPDATE ebike SET status_keamanan = ? WHERE id = ?";
            $set = $this->db->prepare($set);
            $set->execute([$status, $id]);

            return $set;
        }
    }

    class estation 
    {
        public function __construct($db = '')
        {
            $this->setConnect($db);
        }

        public function setConnect($db)
        {
            $this->db = $db;
        }

        public function check_data(){
            $check_data = "SELECT * FROM estation";
            $check_data = $this->db->prepare($check_data);
            $check_data->execute();

            return $check_data;
        }

        public function getAll()
        {
            $get_all = "SELECT * FROM estation ORDER BY id ASC";
            $get_all = $this->db->prepare($get_all);
            $get_all->execute();

            return $get_all;
        }

        public function insertEstation($alamat)
        {
            $add = "INSERT INTO estation SET alamat = ?";
            $add = $this->db->prepare($add);
            $add->execute([$alamat]);

            return $add;
        }

        public function deleteEstation($id)
        {
            $delete = "DELETE FROM estation WHERE id = ?";
            $delete = $this->db->prepare($delete);
            $delete->execute([$id]);

            return $delete;
        }

        public function editEstation($id, $alamat){
            $edit = "UPDATE estation SET alamat = ? WHERE id = ?";
            $edit = $this->db->prepare($edit);
            $edit->execute([$alamat, $id]);

            return $edit;
        }
    }

    Class detail_penyewaan {
        public function __construct($db = '')
        {
            $this->setConnect($db);
        }

        public function setConnect($db)
        {
            $this->db = $db;
        }

        public function getCount($idpenyewaan){
            $count = "SELECT * FROM detail_penyewaan WHERE id_penyewaan = ? AND status = 1";
            $count = $this->db->prepare($count);
            $count->execute([$idpenyewaan]);

            return $count->rowCount();
        }

        public function insertDetail($idpenyewaan, $idebike)
        {
            $insert = "INSERT INTO detail_penyewaan SET status = 1, id_penyewaan = ?, id_ebike = ?";
            $insert = $this->db->prepare($insert);
            $insert->execute([$idpenyewaan, $idebike]);

            return $insert;
        }

        public function setStatus($status, $id){
            $set = "UPDATE detail_penyewaan SET status = ? WHERE id = ?";
            $set = $this->db->prepare($set);
            $set->execute([$status, $id]);

            return $set;
        }

        public function getAll(){
            $get_all = "SELECT * FROM detail_penyewaan ORDER BY id ASC";
            $get_all = $this->db->prepare($get_all);
            $get_all->execute();

            return $get_all;
        }

        public function getDetailPenyewaan($id){
            $get = "SELECT * FROM detail_penyewaan WHERE id = ?";
            $get = $this->db->prepare($get);
            $get->execute([$id]);

            return $get;
        }

        public function check_data(){
            $check_data = "SELECT * FROM detail_penyewaan";
            $check_data = $this->db->prepare($check_data);
            $check_data->execute();

            return $check_data;
        }

        public function editDetailPenyewaan($status, $id){
            $edit = "UPDATE detail_penyewaan SET status = ? WHERE id = ?";
            $edit = $this->db->prepare($edit);
            $edit->execute([$status, $id]);

            return $edit;
        }
    }

    Class role
    {
        public function __construct($db = '')
        {
            $this->setConnect($db);
        }

        public function setConnect($db)
        {
            $this->db = $db;
        }

        public function getRoleByID($id)
        {
            $get_role = "SELECT * FROM role WHERE id = ?";
            $get_role = $this->db->prepare($get_role);
            $get_role->execute([$id]);

            return $get_role;
        }
    }