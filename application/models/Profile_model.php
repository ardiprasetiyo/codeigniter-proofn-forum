<?php 


	class Profile_model extends CI_Model{

		public function getUserInfo( $id ){
			$this->db->select('*');
			$this->db->from('account');
			$this->db->where('id = ', $id);
			return $this->db->get()->result_array();
		}

		public function updateProfileInfoById($imgName, $userId){
			$email = $this->input->post('email', true);
			$gender = $this->input->post('gender', true);
			$bio = $this->input->post('bio', true);

			if( !$imgName ){

				$data = ['email' => $email,
					 	 'gender' => $gender,
					 	 'bio' => $bio];

			$this->db->where('id = '. $userId) ;
			$result = $this->db->update('account', $data);
			return $result;
			die;

			}

			$imgName = base_url() . 'asset/images/profilepic/' . $imgName;

			$data = ['email' => $email,
					 'gender' => $gender,
					 'bio' => $bio,
					 'profile_picture' => $imgName];

			$this->db->where('id = '. $userId) ;
			$result = $this->db->update('account', $data);
			return $result;

		}

	}