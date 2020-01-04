<?php 


	class Admin extends CI_Controller{

		public function __CONSTRUCT(){
			parent::__CONSTRUCT();
			header('Access-Control-Allow-Origin: *'); 
			$this->load->model('Admin_model');
		}

		public function index(){

			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$this->login_view();
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){
					$this->load->view('admin/template/header-admin');
					$this->load->view('admin/template/footer-admin');

					
				} else {
					$this->session->sess_destroy();
					redirect( site_url() . "/admin/" );
				}
			}

		}





		// Authentication

		public function login_view(){

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){
					redirect( site_url() . "/admin/" );
				}
			}

			$this->load->view('admin/login-admin');
		}






		public function login_auth(){

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){
					redirect( site_url() . "/admin/" );
				}
			}

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if( !$this->form_validation->run() ){
				$this->session->set_flashdata('login_status', validation_errors() );
				redirect( site_url() . "/admin/" );
			}

			$result = $this->Admin_model->loginAuth();

			if( empty( $result ) ){
				$this->session->set_flashdata('login_status', 'Username Yang Anda Masukan Salah' );
				redirect( site_url() . "/admin/" );
			}

			$data = ['id_admin' => $result[0]['id_admin'],
					 'username' => $result[0]['username'],
					 'admin_session' => hash('sha256', $result[0]['username']) ];

			if( $this->session->has_userdata('userinfo') == TRUE){
				$this->session->unset_userdata('userinfo');
			}

			$this->session->set_userdata('adminAuth', $data);

			redirect( site_url() . "/admin/" );

		}






		public function feedback_view(){

			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$this->login_view();
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){

					$data = ['feed_suggest' => 
							count($this->Admin_model->getAllSuggest()),
							'feed_error' => 
							 count($this->Admin_model->getAllErrorReport())
						];

					$this->load->view('admin/feedback-admin', $data);
					
				} else {
					$this->session->sess_destroy();
					redirect( site_url() . "/admin/" );
				}
			}

		}






		public function tambahKategori(){
			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$return = ['status' => '503', 'status-msg' => 'Unauthorized'];
				echo json_encode($return, true);
				die;
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){

					$this->form_validation->set_rules('cat-title', 'Judul Kategori', 'trim|required');
					$this->form_validation->set_rules('priority', 'Judul Kategori', 'trim|required');

					if( $this->form_validation->run() == FALSE){
						$return = ['status' => '300', 'status_msg' => 'Property Validation Error'];
						echo json_encode($return, true);
						die;
					}

					$title = $this->input->post('cat-title', true);
					$allowedPriority = ['sedang', 'rendah', 'tinggi'];

					if( in_array(strtolower($this->input->post('priority')), $allowedPriority) ){
						$priority = $this->input->post('priority', true);
					} else {
						$priority = 'rendah';
					}

					$result = $this->Admin_model->addCategory($title, $priority);

					if( !($result) ){
						$return = ['status' => '100', 'status_msg' => 'Unknown Error'];
						echo json_encode($return, true);
						die;
					}

					$return = ['status' => '200', 'status_msg' => 'Success'];
					echo json_encode($return, true);

					
				} else {
					$return = ['status' => '503', 'status-msg' => 'Unauthorized'];
					echo json_encode($return, true);
					die;
				}
			}
		}




		public function hapusKategori(){


			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
				echo json_encode($return, true);
				die;
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){

					$this->form_validation->set_rules('id', 'ID Kategori', 'trim|required');

					if( $this->form_validation->run() == FALSE){
						$return = ['status' => '300', 'status_msg' => 'Property Validation Error'];
						echo json_encode($return, true);
						die;
					}

					$id = $this->input->post('id', TRUE);

					$result = $this->Admin_model->removeCategory($id);

					if( !($result) ){
						$return = ['status' => '100', 'status_msg' => 'Unknown Error'];
						echo json_encode($return, true);
						die;
					}

					$return = ['status' => '200', 'status_msg' => 'Success'];
					echo json_encode($return, true);

					
				} else {
					$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
					echo json_encode($return, true);
					die;
				}
			}
		}






		public function getAllKategori(){
			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$return = ['status' => '503', 'status-msg' => 'Unauthorized'];
				echo json_encode($return, true);
				die;
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){

					$categories = $this->Admin_model->getAllCategories();

					$return = ['status' => '200', 'status_msg' => 'Success', 'result' => $categories];
					echo json_encode($return, true);
					die;

					
				} else {
					$return = ['status' => '503', 'status-msg' => 'Unauthorized'];
					echo json_encode($return, true);
					die;
				}
			}
		}






		public function getAllSuggest(){

			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$return = ['status' => '503', 'status-msg' => 'Unauthorized'];
				echo json_encode($return, true);
				die;
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){

					if( isset($_COOKIE['sort-target']) ){
						
						$allowedSortTarget = ['date', 'status_feedback'];
						$allowedProperty = ['asc', 'desc'];

						if( !in_array($_COOKIE['sort-target'], $allowedSortTarget) || !in_array($_COOKIE['sort-property'], $allowedProperty)){
							$suggest = $this->Admin_model->getAllSuggest();
							$return = ['status' => '200', 'status_msg' => 'Success', 'result' => $suggest];
							echo json_encode($return, true);
							die;
						} 
							$sort = ['sort-target' => $_COOKIE['sort-target'], 
									 'sort-property' => $_COOKIE['sort-property']];

							$suggest = $this->Admin_model->getAllSuggest($sort);
					} else {
						$suggest = $this->Admin_model->getAllSuggest();
					}
					

					$return = ['status' => '200', 'status_msg' => 'Success', 'result' => $suggest];
					echo json_encode($return, true);
					die;

					
				} else {
					$return = ['status' => '503', 'status-msg' => 'Unauthorized'];
					echo json_encode($return, true);
					die;
				}
			}
		}



		public function getAllReport(){
			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$return = ['status' => '503', 'status-msg' => 'Unauthorized'];
				echo json_encode($return, true);
				die;
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){


					if( isset($_COOKIE['sort-target']) ){
						$allowedSortTarget = ['date', 'status_feedback', 'priority'];
						$allowedProperty = ['asc', 'desc'];

						if( in_array($_COOKIE['sort-target'], $allowedSortTarget) || in_array($_COOKIE['sort-property'], $allowedProperty)){
							$sort = ['sort-target' => $_COOKIE['sort-target'], 
									 'sort-property' => $_COOKIE['sort-property']];

							$report = $this->Admin_model->getAllErrorReport($sort);
						} else {
							$return = ['status' => '504', 'status-msg' => 'Unauthorized Sort Property'];
							echo json_encode($return, true);
							die;
						}
					} else{
						$report = $this->Admin_model->getAllErrorReport();
					}

					$return = ['status' => '200', 'status_msg' => 'Success', 'result' => $report];
					echo json_encode($return, true);
					die;

					
				} else {
					$return = ['status' => '503', 'status-msg' => 'Unauthorized'];
					echo json_encode($return, true);
					die;
				}
			}
		}





		public function getDetailReport(){
			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
				echo json_encode($return, true);
				die;
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){

					$this->form_validation->set_rules('id', 'ID Kategori', 'trim|required');

					if( $this->form_validation->run() == FALSE){
						$return = ['status' => '300', 'status_msg' => 'Property Validation Error'];
						echo json_encode($return, true);
						die;
					}

					
					$result = $this->Admin_model->getReportById($this->input->post('id', true));

					if( !$result ){
						$return = ['status' => '500', 'status_msg' => 'Internal Server Error'];
						echo json_encode($return, true);
						die;
					}

					$return = ['status' => '200', 'status_msg' => 'Success', 'result' => $result];
					echo json_encode($return, true);

					
				} else {
					$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
					echo json_encode($return, true);
					die;
				}
			}
		}


		public function updateReportStatus(){


			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
				echo json_encode($return, true);
				die;
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){

					$this->form_validation->set_rules('id', 'ID Kategori', 'trim|required');

					if( $this->form_validation->run() == FALSE){
						$return = ['status' => '300', 'status_msg' => 'Property Validation Error'];
						echo json_encode($return, true);
						die;
					}

					// Cek Status Suggest

					$status = $this->Admin_model->getReportById($this->input->post('id', true));

					if( $status[0]['status_feedback'] > 0 ){
						$result = $this->Admin_model->updateReportStatus(0,$this->input->post('id', true));
					} else {
						$result = $this->Admin_model->updateReportStatus(1,$this->input->post('id', true));
					}

					if( !$result ){
						$return = ['status' => '504', 'status_msg' => 'Internal Server Error'];
					}

					$return = ['status' => '200', 'status_msg' => 'Success'];
					echo json_encode($return, true);

					
				} else {
					$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
					echo json_encode($return, true);
					die;
				}
			}
		}



		public function getDetailSuggest($id = NULL){


			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$return = ['status' => '503', 'status-msg' => 'Unauthorized'];
				echo json_encode($return, true);
				die;
			}

			if( is_null($id) == TRUE ){
				$return = ['status' => '300', 'status-msg' => 'Property Validation Error'];
				echo json_encode($return, true);
				die;
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){

					$data = $this->Admin_model->getSuggestById($id);

					$return = ['status' => '200', 'status_msg' => 'Success', 'result' => $data];
					echo json_encode($return, true);
					die;

					
				} else {
					$return = ['status' => '503', 'status-msg' => 'Unauthorized'];
					echo json_encode($return, true);
					die;
				}
			}
		}




		public function updateSuggestStatus(){


			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
				echo json_encode($return, true);
				die;
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){

					$this->form_validation->set_rules('id', 'ID Kategori', 'trim|required');

					if( $this->form_validation->run() == FALSE){
						$return = ['status' => '300', 'status_msg' => 'Property Validation Error'];
						echo json_encode($return, true);
						die;
					}

					// Cek Status Suggest

					$status = $this->Admin_model->getSuggestById($this->input->post('id', true));

					if( $status[0]['status_feedback'] > 0 ){
						$result = $this->Admin_model->updateSuggestStatus(0,$this->input->post('id', true));
					} else {
						$result = $this->Admin_model->updateSuggestStatus(1,$this->input->post('id', true));
					}

					if( !$result ){
						$return = ['status' => '504', 'status_msg' => 'Internal Server Error'];
					}

					$return = ['status' => '200', 'status_msg' => 'Success'];
					echo json_encode($return, true);

					
				} else {
					$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
					echo json_encode($return, true);
					die;
				}
			}
		}





		


		public function logout(){
			$this->session->unset_userdata('adminAuth');
			redirect( site_url() . '/admin/' );
		}



		public function countMemberStats($backMonth = 3){


			for( $i=$backMonth;$i>=0;$i--){
				$memberStats[date('m-Y', time() - (((60 * 60) * 24 ) * 30) * $i)] = ['tanggal' => date('m-Y', time() - (((60 * 60) * 24 ) * 30) * $i), 'member' => 0];
			}

			$memberData = $this->Admin_model->getAllMember();

			for( $i=0; $i<count($memberData);$i++ ){
				$joinDate = explode('-', $memberData[$i]['join_date']);
				$joinDate = $joinDate[1] . "-" . $joinDate[0];
				
				if( in_array( $joinDate, array_keys($memberStats) ) == TRUE ){
					$memberStats[$joinDate]['member']++;
				} else {
					continue;
				}

			}

			foreach( $memberStats as $data ){

				$result[] = ['date' => date( 'M Y', strtotime('1-' . $data['tanggal']) ),
							 'member' => $data['member']]; 
			}

			return $result;


		}	




		public function countFeedStats($backMonth = 3){


			for( $i=$backMonth;$i>=0;$i--){
				$feedStats[date('m-Y', time() - (((60 * 60) * 24 ) * 30) * $i)] = ['tanggal' => date('m-Y', time() - (((60 * 60) * 24 ) * 30) * $i), 'feedback' => 0];
			}

			$suggestData = $this->Admin_model->getAllSuggest();

			for( $i=0; $i<count($suggestData);$i++ ){
				$feedDate = explode('-', $suggestData[$i]['date']);
				$feedDate = $feedDate[1] . "-" . $feedDate[0];
				
				if( in_array( $feedDate, array_keys($feedStats) ) == TRUE ){
					$feedStats[$feedDate]['feedback']++;
				} else {
					continue;
				}

			}


			$errorData = $this->Admin_model->getAllErrorReport();

			for( $i=0; $i<count($errorData);$i++ ){
				$errorDate = explode('-', $errorData[$i]['date']);
				$errorDate = $errorDate[1] . "-" . $errorDate[0];
				
				if( in_array( $errorDate, array_keys($feedStats) ) == TRUE ){
					$feedStats[$errorDate]['feedback']++;
				} else {
					continue;
				}

			}

			foreach( $feedStats as $data ){

				$result[] = ['date' => date( 'M Y', strtotime('1-' . $data['tanggal']) ),
							 'feedback' => $data['feedback']]; 
			}
			

			return $result;


		}





		// Member

		public function member_view(){
			$this->load->view('admin/member-admin');
		}


		public function getAllMember(){
			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$return = ['status' => '503', 'status-msg' => 'Unauthorized'];
				echo json_encode($return, true);
				die;
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){
						
					$members = $this->Admin_model->getAllMember();

					$return = ['status' => '200', 'status_msg' => 'Success', 'result' => $members];
					echo json_encode($return, true);
					die;

					
				} else {
					$return = ['status' => '503', 'status-msg' => 'Unauthorized'];
					echo json_encode($return, true);
					die;
				}
			}
		}




			public function getDetailMember(){


			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
				echo json_encode($return, true);
				die;
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){

					$this->form_validation->set_rules('id', 'ID Kategori', 'trim|required');

					if( $this->form_validation->run() == FALSE){
						$return = ['status' => '300', 'status_msg' => 'Property Validation Error'];
						echo json_encode($return, true);
						die;
					}

					$id = $this->input->post('id', TRUE);

					$result = $this->Admin_model->getDetailMember($id);

					if( !($result) ){
						$return = ['status' => '100', 'status_msg' => 'Unknown Error'];
						echo json_encode($return, true);
						die;
					}

					$return = ['status' => '200', 'status_msg' => 'Success', 'result' => $result];
					echo json_encode($return, true);

					
				} else {
					$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
					echo json_encode($return, true);
					die;
				}
			}
		}






			public function getFeedbackMember(){


			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
				echo json_encode($return, true);
				die;
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){

					$this->form_validation->set_rules('id', 'ID Kategori', 'trim|required');

					if( $this->form_validation->run() == FALSE){
						$return = ['status' => '300', 'status_msg' => 'Property Validation Error'];
						echo json_encode($return, true);
						die;
					}

					$id = $this->input->post('id', TRUE);

					$result = ['member-suggest' => $this->Admin_model->getSuggestByUserId($id),
							   'member-errreport' => $this->Admin_model->getErrReportByUserId($id)];

					if( !($result) ){
						$return = ['status' => '100', 'status_msg' => 'Unknown Error'];
						echo json_encode($return, true);
						die;
					}

					$return = ['status' => '200', 'status_msg' => 'Success', 'result' => $result];
					echo json_encode($return, true);

					
				} else {
					$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
					echo json_encode($return, true);
					die;
				}
			}
		}






		public function getForumMember(){


			// Cek Ketiadaan Sesi

			if( !$this->session->has_userdata('adminAuth') ){
				$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
				echo json_encode($return, true);
				die;
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){

					$this->form_validation->set_rules('id', 'ID Kategori', 'trim|required');

					if( $this->form_validation->run() == FALSE){
						$return = ['status' => '300', 'status_msg' => 'Property Validation Error'];
						echo json_encode($return, true);
						die;
					}

					$id = $this->input->post('id', TRUE);

					$result = ['member-thread' => $this->Admin_model->getForumPostByUserId($id),
							   'member-replies' => $this->Admin_model->getForumRepliesByUserId($id)];

					if( !($result) ){
						$return = ['status' => '100', 'status_msg' => 'Unknown Error'];
						echo json_encode($return, true);
						die;
					}

					$return = ['status' => '200', 'status_msg' => 'Success', 'result' => $result];
					echo json_encode($return, true);

					
				} else {
					$return = ['status' => '503', 'status_msg' => 'Unauthorized'];
					echo json_encode($return, true);
					die;
				}
			}
		}






		// Dashboard

		public function dashboard(){

			if( !$this->session->has_userdata('adminAuth') ){
				$this->load->view('admin/login-admin');
			}

			// Cek Keberadaan Sesi

			if( $this->session->has_userdata('adminAuth') == true ){
				if( $this->session->userdata('adminAuth')['admin_session'] == hash( "sha256", $this->session->userdata('adminAuth')['username'] ) ){
					$data = ['memberStats' => ['stats' => $this->countMemberStats(), 
											   'total-member' => count($this->Admin_model->getAllMember())], 

							 'feedbackStats' => ['stats' => $this->countFeedStats(),
												 'total-feedback' => count($this->Admin_model->getAllErrorReport() ) + count($this->Admin_model->getAllSuggest() ) ]
												];

					$this->load->view('admin/dashboard', $data);
					
				} else {
					$this->session->sess_destroy();
					redirect( site_url() . "/admin/" );
				}
			}
		}


	}