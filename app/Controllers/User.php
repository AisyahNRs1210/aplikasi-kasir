<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MUser;

class User extends BaseController
{

    public function index()
    {
        return view('Layout/dashboard');
    }

    public function login()
    {
        $validasiForm = [
            'email' => 'required',
            'password' => 'required'
        ];
        
        if ($this->validate($validasiForm)) {
            $email = $this->request->getPost('email');
            $password = md5($this->request->getPost('password'));
            $whereLogin = [
                'email' => $email,
                'password' => $password
            ];

            //select * from tbl_user where email='$email' and password='$password'
            $cekLogin = $this->user->where($whereLogin)->findAll();
            if (count($cekLogin) == 1) {
                // Check if the user is active
                if ($cekLogin[0]['status'] == 'aktif') {

                //jika ditemukan data
                // 1. buat session email, nama, level
                $dataSession = [
                    'email' => $cekLogin[0]['email'],
                    'nama_user' => $cekLogin[0]['nama_user'], // Add this line to store the user's name
                    'password' => $cekLogin[0]['password'],
                    'role' => $cekLogin[0]['role'],
                    'sudahkahLogin' => true
                ];
                
                session()->set($dataSession);
                return redirect()->to('/dashboard');
                } else {
                // User is not active, show an error message
                return redirect()->to('/form-login')->with('pesan', '<p class="text-danger text-center">
                    Gagal Login! <br> Akun tidak aktif!</p>');
            }

            } else {
                //jika tidak ditemukan apapun
                return redirect()->to('/form-login')->with('pesan', '<p class="text-danger text-center">
                Gagal Login! <br> Periksa Email atau Password!</p>');
            }
        }
        return view('layout/form-login');
    }

    public function logout(){
   	    session()->destroy();
   	    return redirect()->to('/form-login');
    }

    public function registrasi(){
         // Definisikan $data dengan nilai default
    $data = [];

        $validasiForm=[
        'email'=>'required',
        'password' => 'required',
        ];
        
        // jika tombol simpan ditekan
        if($this->validate($validasiForm)){
            $data=[
                'email' =>$this->request->getPost('email'),
                'nama_user' =>$this->request->getPost('nama_user'),
                'password' =>$this->request->getPost('password'),
                'role' =>$this->request->getPost('role')
            ];

            $cekRecord=$this->user->cariUser($data['email']);
                if(isset($cekRecord[0]->email)){
                    $this->user->updateUser($data);
                } else {
                    $this->user->tambahUser($data);

                    // Log in the user after registration
                    $this->loginAfterRegistration($data['email'], $data['password']);
                    session()->setFlashdata('pesan','Data berhasil ditambahkan');
                }
            return redirect()->to('/dashboard');
        }
            return view('layout/form-registrasi',$data);
    }

    // Helper function to log in the user after registration
private function loginAfterRegistration($email, $password)
{
    $whereLogin = [
        'email' => $email,
        'password' => md5($password)
    ];

    // Select * from tbl_user where email='$email' and password='$password'
    $cekLogin = $this->user->where($whereLogin)->findAll();
    
    if (count($cekLogin) == 1) {
        // Check if the user is active
        if ($cekLogin[0]['status'] == 'aktif') {
            // Create session data
            $dataSession = [
                'email' => $cekLogin[0]['email'],
                'password' => $cekLogin[0]['password'],
                'role' => $cekLogin[0]['role'],
                'nama_user' => $cekLogin[0]['nama_user'],
                'sudahkahLogin' => true
            ];

            // Set session data
            session()->set($dataSession);
        }
    }
}

    public function tampilUser(){
        if(!session()->get('sudahkahLogin')){
			return redirect()->to('login');
			exit;
			}
        $data =[
        'judulHalaman' =>'Master Data Pengguna',
        'introTeks'=>'Berikut ini data pengguna pada Yuzushi Gift Store',
        'listPengguna'=>$this->user->getAllUser(),
    ] ;

    return view('masterdata/list-user',$data); 
    }

    public function formtambah(){
        $data=[
        'judulHalaman' =>'Form Penambahan Data Pengguna',
        'introTeks'=>'Untuk menambah data baru, silakan masukkan data Pengguna baru pada form dibawah ini',
        ];

        return view('masterdata/tambah-user',$data);
    }

    public function tambah(){
        $validation = \Config\Services::validation();
        $validation->setRule('email', 'Email', 'required|valid_email|is_unique[tbl_user.email]', [
        'required' => '{field} tidak boleh kosong!',
        'is_unique' => '{field} sudah digunakan!',
        'valid_email' => '{field} harus merupakan alamat email yang valid!',
        ]);

        $validation->setRule('nama_user', 'Nama User', 'required', [
            'required' => '{field} tidak boleh kosong!',
        ]);
        $validation->setRule('password', 'Password', 'required', [
            'required' => '{field} tidak boleh kosong!',
        ]);
        $validation->setRule('role', 'Role', 'required', [
            'required' => '{field} tidak boleh kosong!',
        ]);
        $datavalid = [
            'email'=>$this->request->getPost('email'),
            'nama_user' =>$this->request->getPost('nama_user'),
            'password' =>$this->request->getPost('password'),
            'role' =>$this->request->getPost('role')
          ];
          if (!$validation->run($datavalid)) {
             // Custom error messages will be used if validation fails
             return redirect()->back()->withInput()->with('errors', $validation->getErrors());
         }
        

        
        // jika tombol simpan ditekanif($this->validate($validasiForm)){
            $data=[
                'email' =>$this->request->getPost('email'),
                'nama_user' =>$this->request->getPost('nama_user'),
                'password' =>$this->request->getPost('password'),
                'role' =>$this->request->getPost('role')
            ];

            $cekRecord=$this->user->cariUser($data['email']);
                if(isset($cekRecord[0]->email)){
                    $this->user->updateUser($data);
                } else {
                    $this->user->tambahUser($data);
                    session()->setFlashdata('pesan','Data berhasil ditambahkan');
                }
            return redirect()->to('/list-user');
        
            return view('masterdata/tambah-user',$data);
    }

    public function edit($email){
        $data =[
        'judulHalaman' =>'Form Perubahan Data Pengguna',
        'introTeks'=>'Untuk mengubah data silakan lakukan perubahan pada form dibawah ini',
        'detailPengguna'=>$this->user->detailUser($email),
        ] ;

        return view('masterdata/edit-user',$data);
    }

     public function update(){
            var_dump($_POST);
            
            $emailNya = $this->request->getPost('email');
            $roleNya = $this->request->getPost('role');
            $statusNya = $this->request->getVar('status');

            error_log('email: ' . $emailNya); // Log ID kategori
            // Log Nama kategori
            error_log('role: ' . $roleNya);
            error_log('status: ' . $statusNya);

            $data = [
                'email' => $emailNya,
                'role' => $roleNya,
                'status' => $statusNya,
            ];

            $this->user->updateUser($data);
            session()->setFlashdata('edit','Data berhasil diupdate');

    // Redirect ke halaman kategori setelah proses update selesai
    return redirect()->to('/list-user') ;
    }

     public function editpassUser(){

        // Ambil email dari session user yang sedang login
    $email = session()->get('email');

        $data =[
            'judulHalaman' =>'Form Perubahan Password Pengguna',
            'introTeks'=>'Untuk mengubah password silakan lakukan perubahan pada form dibawah ini',
            'detailPengguna'=>$this->user->detailUser($email),
            ] ;
    
            return view('masterdata/edit-password',$data);
        }
    
    public function updatepassUser(){

         $email = session()->get('email');
        
    
      var_dump($_POST);
                $validation = [
                    'passwordbaru'=>'required',
                    'repeat'=>'required|matches[passwordbaru]'
                ];
                if(!$this->validate($validation)){
                    return redirect()->to(base_url('/edit-password/'.$this->request->getVar('email')))->with('pesan', '<p class="text-danger pt-2" style="font-size:15px">
                    Password tidak sinkron!</p>');			
                }
                $data=[
                    'email'=>$this->request->getVar('email'),
                    'password' => $this->request->getVar('passwordbaru')
                    
                ];
    
                $this->user->updatePassword($email, $data);
                session()->setFlashdata('edit','Data berhasil diupdate');

            return redirect()->to('/list-user');
    }

    public function hapus($emailNya){
        $this->user->hapusUser($emailNya);
        session()->setFlashdata('hapus','Data berhasil dihapus');
        return redirect()->to('/list-user');
    }
   
}
