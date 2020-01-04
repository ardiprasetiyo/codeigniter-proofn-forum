<?php 	

class Signup_model extends CI_Model{


		public function verifikasiDuplikasi(){

			// Cek Keberadaan Duplikasi Akun

			$username = $this->input->post('new-username', true);
			$email = $this->input->post('new-email', true);

			$this->db->select('username, email');
			$this->db->from('account');
			$this->db->where("username = '$username' OR email = '$email'");
			$hasDuplicate = $this->db->get()->result_array();



			if( !empty($hasDuplicate) ){

				return FALSE;
				die;

			}

			return TRUE;


		}


		public function daftar(){

			$data = ["id" => "",
					 "username" => $this->input->post('new-username', true), 
	  				 "password" => hash("sha256", $this->input->post('new-password', true) . $this->input->post('new-username', true) ),
					 "email" => $this->input->post('new-email', true),
					 "gender" => $this->input->post('new-gender', true),
					 "birthdate" => $this->input->post('new-birthdate', true),
					 "profile_picture" => base_url() . 'asset/images/profilepic/no-pic.png',
					 "bio" => $this->input->post('new-bio'),
					 "previlege" => 0,
					 "join_date" => date("Y-m-d")
					];

			return $this->db->insert('account', $data);
		}

		public function login(){

			$data = ['username =' => $this->input->post('username', true),
					 'password =' => hash('sha256', $this->input->post('password', true) . $this->input->post('username') )];

		 	$this->db->select('id, username, previlege');
		 	$this->db->from('account');
		 	$this->db->where($data);
		 	return $data = $this->db->get()->result_array();

	}

}