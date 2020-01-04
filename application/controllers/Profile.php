<?php 


	class Profile extends CI_Controller{

		public $userData;

		public function __CONSTRUCT(){
			parent::__CONSTRUCT();
			$this->userData = $this->session->userdata('userinfo');
			$this->load->model('Profile_model');
			$this->load->model('Forum_model');
			$this->load->model('Feedback_model');
		}

		public function index(){
			if( !$this->session->has_userdata('userinfo') ){
				redirect( site_url() . '/beranda/' );
			}

			$userInfo = $this->Profile_model->getUserInfo( $this->userData['id'] );
			$userData = ['username' => $userInfo[0]['username'],
						 'email' => $userInfo[0]['email'],
						 'gender' => $userInfo[0]['gender'],
						 'birthdate' => $userInfo[0]['birthdate'],
						 'profile_picture' => $userInfo[0]['profile_picture'],
						 'bio' => $userInfo[0]['bio'],
						 'join_date' => $userInfo[0]['join_date']
						];

			$forumData = ['num-thread' 
						   => $this->Forum_model->countThreadByMemberId( $this->userData['id']),
						  'num-post' 
						   => $this->Forum_model->countPostByMemberId( $this->userData['id'] )];

			$feedData = ['num-feed' => $this->Feedback_model->countFeedByUser( $this->userData['id'] ),
						 'num-pending' 
						 => $this->Feedback_model->countPendFeedByUser( $this->userData['id'] ),
						 'num-success'
						 => $this->Feedback_model->countSuccFeedByUser( $this->userData['id'] ),
						 'data-suggest'
						 => $this->Feedback_model->getSuggestByUser( $this->userData['id'] ),
						 'data-errorReport'
						 => $this->Feedback_model->getErrReportByUser( $this->userData['id'] )];

			$data = ['userData' => $userData,
					 'forumData' => $forumData,
					 'feedData' => $feedData];

			$this->load->view('profile', $data);

		}

		public function updateProfile(){

			if( !$this->session->has_userdata('userinfo') ){

				$this->session->set_flashdata('valid_result', $this->upload->display_errors() );
					redirect( site_url() . '/profile/' );
			}

			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');
			$this->form_validation->set_rules('bio', 'Biodata', 'required');

			if( !$this->form_validation->run() ){

				$this->session->set_flashdata('valid_result', validation_errors());
				redirect( site_url() . '/profile/' );
			}

			$imageName = FALSE;


			if( $_FILES['profile-pic']['error'] == 0 ){
				
				$config['upload_path'] = './asset/images/profilepic/';
				$config['allowed_types'] = 'jpg|jpeg|png|bmp|JPG|JPEG|PNG|BMP';
				$config['encrypt_name'] = TRUE;
				$this->upload->initialize($config);
				$result = $this->upload->do_upload('profile-pic', $config);
				
				if( !$result ){
					$this->session->set_flashdata('valid_result', $this->upload->display_errors() );
					redirect( site_url() . '/profile/' );
				}
				
				$imageName = $this->upload->data()['file_name'];

			} 

			$userId = $this->userData['id'];

			$result = $this->Profile_model->updateProfileInfoById($imageName, $userId);

			if( !$result ){
				$this->session->set_flashdata('valid_result', 'Terjadi kesalahan saat mengubah informasi akun anda.');
				redirect( site_url() . '/profile/' );
			}

			redirect( site_url() . '/profile/');

		}


		public function logout(){
			$this->session->unset_userdata('userinfo');
			redirect( site_url() . '/beranda/' );
		}

	}