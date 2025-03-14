<?php
    class ebikeui{
        public function __construct($db){
            $this->setConnect($db);
        }
        public function setConnect($db){
            $this->db = $db;
        }

        public function addEbike($ebike, $baterai, $status_sewa, $status_keamanan, $id_station){
            $insert_data = $ebike->insertEbike($baterai, $status_sewa, $status_keamanan, $id_station);
            if ($insert_data)
            {
                header('location: ebikeadmin.php?idstation=' . $id_station . '&msg=berhasil_ditambahkan');
                return 'Data berhasil ditambahkan!';
            }
            else
                return 'Data tidak berhasil ditambahkan!';
        }

        public function deleteEbike($ebike, $id){
            $delete = $ebike->deleteEbike($id);
            if ($delete) {
                header('location: ebikeadmin.php?idstation=' . $_GET['idstation'] . '&msg=berhasil_dihapus');
                return 'Data berhasil dihapus!';
            }
            else 
                return 'Data tidak berhasil dihapus!';
        }

        public function editEbike($ebike, $id, $baterai, $status_sewa, $status_keamanan, $id_station){
            $edit = $ebike->editEbike($id, $baterai, $status_sewa, $status_keamanan, $id_station);
            if ($edit) {
                header('location: ebikeadmin.php?idstation=' . $id_station . '&msg=berhasil_diedit');
                return 'Data berhasil diedit!';
            }
            else 
                return 'Data tidak berhasil diedit!';
        
        }

        public function sewaEbike($penyewaan, $ebike, $detail_penyewaan, $harga, $jam_sewa, $id_akun){
            $penyewaan->insertPenyewaan($harga*count($_SESSION['selected']), $jam_sewa, $id_akun);
            $getPenyewaan = ($penyewaan->getPenyewaanByDetil($harga*count($_SESSION['selected']), $jam_sewa, $id_akun))->fetch();
            for ($i = 0 ; $i < count($_SESSION['selected'])-1 ; $i++){
                $id_ebike = $_SESSION['selected'][$i];
                $id_penyewaan = $getPenyewaan['id'];
                $detail_penyewaan->insertDetail($id_penyewaan, $id_ebike);
                $ebike->setStatusSewa(1, $id_ebike);
            }
            header('location: ebikeuser.php?idstation='. $_GET['idstation'] .'&msg=berhasil_sewa');
        
            return 'Berhasil menyewa!';
        }

        public function cekSewa($penyewaan){
            $cekSewa = $penyewaan->cekSewa($_SESSION['login']);
            if ($cekSewa->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function addEstation($estation, $alamat){
            $insert_data = $estation->insertEstation($alamat);
            if ($insert_data)
            {
                header('location: estationadmin.php?msg=berhasil_ditambahkan');
                return 'Data berhasil ditambahkan!';
            }
            else
                return 'Data tidak berhasil ditambahkan!';
        }

        public function deleteEstation($ebike, $estation, $id){
            if ($ebike->getList($_GET['id'])->rowCount() == 0){
                $delete = $estation->deleteEstation($id);
                if ($delete) {
                    header('location: estationadmin.php?msg=berhasil_dihapus');
                    return 'Data berhasil dihapus!';
                } else 
                    return 'Data tidak berhasil dihapus!';
            } else {
                return 'ebike harus kosong';
            }
        }

        public function editEstation($estation, $id, $alamat){
            $edit = $estation->editEstation($id, $alamat);
            if ($edit) {
                header('location: estationadmin.php?msg=berhasil_diedit');
                return 'Data berhasil diedit!';
            }
            else 
                return 'Data tidak berhasil diedit!';
        
        }

        public function login($akun, $role, $username, $password){
            $_SESSION['selected'] = [];
            $fetch_akun = $akun->getAkunByEmail($username)->fetch();
            if ($password != $fetch_akun['password']) {
                return 'Email Atau Password Salah!';
            } else if ($username == '') {
                return 'username harus terisi!';
            } else if ($password == '') {
                return 'password harus terisi!';
            } else {
                $_SESSION['login'] = $fetch_akun['id'];
                $id_role = $fetch_akun['id_role'];
                $nama_role = $role->getRoleByID($id_role)->fetch()['nama'];
                if ($nama_role == 'admin') {
                    header('Location: homeadmin.php');
                    return 'Login Berhasil!';
                }
                else if ($nama_role == 'user') {
                    header('Location: homeuser.php');
                    return 'Login Berhasil!';
                }
            }
        }

        public function pay($detail_penyewaan, $penyewaan, $ebike, $id_detail_penyewaan, $id_ebike){
            $pay = $detail_penyewaan->setStatus(2, $id_detail_penyewaan);
            if ($pay) {
                $ebike->setStatusSewa('0',$id_ebike);
                $id_penyewaan = $detail_penyewaan->getDetailPenyewaan($id_detail_penyewaan)->fetch()['id_penyewaan'];
                if ($detail_penyewaan->getCount($id_penyewaan) == 0 || $detail_penyewaan->getCount($id_penyewaan) == '0'){
                    $penyewaan->setStatus('2', $id_penyewaan);
                }
                header('location: ongoing.php?msg=berhasil_dibayar');
                return 'berhasil dibayar!';
            }
            else 
                return 'tidak berhasil dibayar!';
        }

        public function aktifkanPengaman($ebike, $idebike){
            $pengaman = $ebike->setStatusPengaman(1, $idebike);
            if ($pengaman) {
                header('location: ongoing.php?msg=berhasil_aktifkan');
                return 'berhasil aktifkan pengaman!';
            } else {
                return 'tidak berhasil aktifkan pengaman!';
            }
        }

        public function nonaktifkanPengaman($ebike, $idebike){
            $pengaman = $ebike->setStatusPengaman(0, $idebike);
            if ($pengaman) {
                header('location: ongoing.php?msg=berhasil_nonaktifkan');
                return 'berhasil nonaktifkan pengaman!';
            } else {
                return 'tidak berhasil nonaktifkan pengaman!';
            }
        }

        public function editPenyewaan($penyewaan, $id, $status, $harga, $jam_sewa){
            $edit = $penyewaan->editPenyewaan($id, $status, $harga, $jam_sewa);
            if ($edit) {
                header('location: penyewaanadmin.php?msg=berhasil_diedit');
                return 'Data berhasil diedit!';
            }
            else 
                return 'Data tidak berhasil diedit!';
        }

        public function editDetailPenyewaan($detail_penyewaan, $id, $status){
            $edit = $detail_penyewaan->editDetailPenyewaan($status, $id);
            if ($edit) {
                header('location: detailpenyewaanadmin.php?idpenyewaan=' . $_GET['idpenyewaan'] . '&msg=berhasil_diedit');
                return 'Data berhasil diedit!';
            }
            else 
                return 'Data tidak berhasil diedit!';
        }
    }
?>