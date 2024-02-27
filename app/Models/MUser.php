<?php

namespace App\Models;

use CodeIgniter\Model;

class MUser extends Model
{
 protected $table            = 'tbl_user';
    protected $primaryKey       = 'email';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['email','nama_user','password','role','status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAllUser(){
        $user= NEW MUser;
        $queryUser = $user->query("CALL lihat_user()")->getResult();
        return $queryUser;
    }

    public function tambahUser ($data){
        $user = NEW MUser;
        $email = $data['email'];
        $namaUser = $data['nama_user'];
        $pass = $data['password'];
        $role = $data['role'];

        $user->query("CALL tambah_user('$email', '$namaUser', '$pass', '$role')");
    }

    public function cariUser($email){
        $user= NEW MUser;
        $queryUser = $user->query("CALL cari_user('".$email."')")->getResult();
        return $queryUser;
    }

    public function detailUser($email){
        $user= NEW MUser;
        $queryUser = $user->query("CALL detail_user('".$email."')")->getResult();
        return $queryUser;
    } 

    public function updateUser($data){          
        if (is_array($data) && isset($data['email'])  && isset($data['role']) && isset($data['status'])) {
            $user = new MUser;
            $email = $data['email'];
            $role = $data['role'];
            $status = $data['status'];

            $user->query("CALL update_user('$email', '$role','$status')");
        }
    }
 
    public function updatePassword($email, $data)
{
    $this->set('password', md5($data['password']))
        ->where('email', $email)
        ->update();
}

    public function hapusUser($email){
        $user = NEW MUser;
        $user->query("CALL hapus_user('".$email."')");
    }

    public function countTotalUsers(){
        return $this->countAll();
    }

//     public function countActiveUsers() {
//     // Menghitung jumlah pengguna yang aktif dari database
//     $this->db->where('status', 'active'); // Misalnya, Anda memiliki kolom status yang menunjukkan status pengguna
//     $activeUsers = $this->db->count_all_results('users'); // 'users' adalah nama tabel pengguna dalam contoh ini
//     return $activeUsers;
// }

// public function countInactiveUsers() {
//     // Menghitung jumlah pengguna yang nonaktif dari database
//     $this->db->where('status', 'inactive'); // Misalnya, Anda memiliki kolom status yang menunjukkan status pengguna
//     $inactiveUsers = $this->db->count_all_results('users'); // 'users' adalah nama tabel pengguna dalam contoh ini
//     return $inactiveUsers;
// }

}
