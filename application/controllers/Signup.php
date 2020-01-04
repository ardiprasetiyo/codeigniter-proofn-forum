<?php  


	class Signup extends CI_Controller{


		public function index(){

			if( $this->session->has_userdata('userinfo') == TRUE ){
				redirect( site_url() . '/profile/');
			}

			$this->load->view('signup');
		}

		public function daftarakun(){
			$this->form_validation->set_rules('new-username', 'username', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('new-password', 'password', 'trim|min_length[8]|required');
			$this->form_validation->set_rules('new-email', 'email', 'trim|required|valid_email');
			$this->form_validation->set_rules('new-birthdate', 'tanggal lahir', 'trim|required');
			$this->form_validation->set_rules('new-gender', 'jenis kelamin', 'trim|required');
			$this->form_validation->set_rules('new-bio', 'bio', 'trim|required');


			if ( $this->form_validation->run() == FALSE ){

				$this->session->set_flashdata('signin_report', validation_errors());
				redirect('signup');
				die;

			}

			$this->load->model('Signup_model');

			// Verifikasi Duplikasi Data

			$verifikasi = $this->Signup_model->verifikasiDuplikasi();

			if ( !$verifikasi ) {
				
				$this->session->set_flashdata('signin_report', "Username atau Email Telah Digunakan Sebelumnya");
				redirect('signup');

			}

			// Verifikasi Usia Pengguna

			$usia = explode('-', $this->input->post('new-birthdate') );
			$usia = date('Y') -  $usia[0];

			if ( $usia < 6 ) {
				$this->session->set_flashdata('signin_report', "Tanggal Lahir Yang Anda Masukan Tidak Diterima");
				redirect('signup');
			}


			$result = $this->Signup_model->daftar();

			if( $result == FALSE ){
				$this->session->set_flashdata('signin_report', "Terjadi Kesalahan Saat Mendaftar, Hubungi Admin Website");
				redirect('signup');
			}

			$this->session->set_flashdata('signin_report', "Akun Berhasil Di Daftarkan!, Silahkan Login Menggunakan Akun Anda");
			redirect('signup');



		}

		public function login(){

			$this->form_validation->set_rules('username', 'username', 'trim|required');
			$this->form_validation->set_rules('password', 'password', 'trim|required');

			if( $this->form_validation->run() == FALSE ){
				$this->session->set_flashdata('login_report', validation_errors());
				redirect('signup');
			}

			$this->load->model('Signup_model');
			$result = $this->Signup_model->login();


			if( !$result ){
				$this->session->set_flashdata('login_report', 'Akun Tidak Ditemukan.');
				redirect('signup');
			}

			$data = ['id' => $result[0]['id'],
					 'username' => $result[0]['username'],
					 'previlege' => $result[0]['previlege'],
					 'login_stats' => TRUE];

			$this->session->set_userdata('userinfo', $data);
			$this->session->set_flashdata('notification', 
					['notif_title' => 'Anda Sudah Bergabung', 
					 'notif_text' => 'Hai <b>' . strtoupper($data["username"]) . '</b>! Selamat begabung kembali bersama kami!', 
					 'notif_image' => base_url() . 'asset/images/illustration/people-hole.png',
					 'config' => FALSE]);

				redirect( site_url() . '/beranda' );

			}

		}


?>