<?php


	class Forum extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('Forum_model');
			date_default_timezone_get('Asia/Jakarta');
		}

		public function index(){			

			// Get All Forum Category And Store Into Variable Threads
			$kategoriForum = $this->getAllKategoriForum();	


			$data = ['pageTitle' => 'Forum - Beranda',
					 'kategoriForum' => $kategoriForum];


			$this->load->view('forum/template/header',  $data);
			$this->load->view('forum/index');
			$this->load->view('forum/template/footer');
		}


		public function members($userId, $username){

			$memberData = $this->getMemberById($userId, $username);
			$forumData = $this->countActivityByUserId($userId);

			$data = ['pageTitle' => 'Forum - Member',
					 'pageData' => ['id' => $userId, 'username' => $username],
					 'forumData' => $forumData,
					 'memberData' => $memberData];
			$this->load->view('forum/template/header',  $data);
			$this->load->view('forum/member');
			$this->load->view('forum/template/footer');
		}

		public function getMemberById($id, $username){
			return $this->Forum_model->getMemberById($id, $username);
		}

		public function countActivityByUserId($id){
			$thread = $this->Forum_model->countThreadByMemberId($id);
			$post = $this->Forum_model->countPostByMemberId($id);

			$userActivity['forumActivity'] = ['thread' => $thread, 'post' => $post];

			return $userActivity;

		}

		public function thread($threadId){

			$dataThread = $this->Forum_model->getThreadById($threadId);

			if( empty($dataThread) ){
				redirect( site_url() . '/forum/' );
			}

			$dataPost = $this->Forum_model->getPostByThreadId($threadId);
			$highestVotes = $this->getHighestVotesFromPost($dataPost);


			$data = ['pageTitle' => 'Forum - Thread',
					 'dataThread' => $dataThread,
					 'highestVotes' => $highestVotes ];
			$this->load->view('forum/template/header',  $data);
			$this->load->view('forum/thread');
			$this->load->view('forum/template/footer');
		}

		public function hapusBalasan($idPost, $idThread){

			if( !$this->session->has_userdata('userinfo') ){
				redirect( site_url() . '/forum/' );
			}

			$dataPost = $this->Forum_model->getPostById($idPost);

			if( empty($dataPost) ){
				redirect( site_url() . '/forum/' );
			}

			if( $this->session->userdata('userinfo')['id'] != $dataPost[0]['id'] ){
				redirect( site_url() . '/forum/' );
			}

			$result = $this->Forum_model->deletePostById($idPost);

			if( !$result ){
				$this->session->set_flashdata('notif', "Gagal Mengedit Thread, Error Tidak Diketahui." );
				redirect( site_url() . '/forum/topik/id/' . $idThread);
			}

			redirect( site_url() . '/forum/topik/id/' . $idThread);

		}


		public function hapusThread($idThread){

			if( !$this->session->has_userdata('userinfo') ){
				redirect( site_url() . '/forum/' );
			}

			$dataThread = $this->Forum_model->getThreadById($idThread);

			if( empty($dataThread) ){
				redirect( site_url() . '/forum/' );
			}

			if( $this->session->userdata('userinfo')['id'] != $dataThread[0]['id'] ){
				redirect( site_url() . '/forum/' );
			}


			$result = $this->Forum_model->deleteThreadById($idThread);

			if( !$result ){
				$this->session->set_flashdata('notif', "Gagal Mengedit Thread, Error Tidak Diketahui." );
				redirect( site_url() . '/forum/topik/id/' . $idThread);
			}

			redirect( site_url() . '/forum/');

		}


		public function updatethread(){

			if( !$this->session->has_userdata('userinfo') ){
				redirect( site_url() . '/forum/' );
			}


			if( !$this->input->post() ) {
				redirect( site_url() . '/forum/');
			}

			$this->form_validation->set_rules('judul-thread', 'Judul Thread', 'trim|required');
			$this->form_validation->set_rules('kategori-forum', 'kategori Forum', 'trim|required');
			$this->form_validation->set_rules('deskripsi-thread', 'Deskripsi Thread', 'trim|required');
			$this->form_validation->set_rules('id-thread', 'ID Thread', 'trim|required');

			if(  !$this->form_validation->run() ){	

				$this->session->set_flashdata('valid_err', validation_errors() );
				redirect( site_url() . '/forum/topik/id/' . $this->input->post('id-thread') );
				die;

			}

			$judulThread = $this->input->post('judul-thread', true);
			$kategoriForum = $this->input->post('kategori-forum', true);
			$deskripsiThread = $this->input->post('deskripsi-thread', true);
			$threadId = $this->input->post('id-thread', true);
			$date = date('Y-m-d H:i:s');

			$result = $this->Forum_model->updateThread($threadId, $judulThread, $kategoriForum, $deskripsiThread, $date);

			if( !$result ){
				$this->session->set_flashdata('valid_err', "Gagal Mengedit Thread, Error Tidak Diketahui." );
				redirect( site_url() . '/forum/editthread/id/' . $this->input->post('id-thread') . '/' . $this->input->post('kategori-forum') );
			}

			redirect( site_url() . '/forum/topik/id/' . $threadId );

		}

		public function editthread($threadId, $kategoriSelected){

			$dataThread = $this->Forum_model->getThreadById($threadId);

			if( $dataThread[0]['id'] != $this->session->userdata('userinfo')['id'] ){
				redirect( site_url() . '/forum/');
			}

			$kategoriForum = $this->getAllKategoriForum();

			if( !$this->session->has_userdata('userinfo') ){
				redirect( site_url() .'/forum/' );
			}

			$data = ['pageTitle' => 'Forum - Thread',
					 'dataThread' => $dataThread,
					 'kategori' => ['listKategori' => $kategoriForum,
									'kategoriSelected' => $kategoriSelected]
					];

			$this->load->view('forum/template/header',  $data);
			$this->load->view('forum/edit-thread');
			$this->load->view('forum/template/footer');
		}

		public function appThreadBalasan($threadId){
			$dataPost = $this->Forum_model->getPostByThreadId($threadId);
			$highestVotes = $this->getHighestVotesFromPost($dataPost);
			$dataThread = $this->Forum_model->getThreadById($threadId);

			$data = ['dataPost' => $dataPost,
					 'highestVotes' => $highestVotes,
					 'dataThread' => $dataThread];
			$this->load->view('forum/app/thread-balasan', $data);
		}

		public function appSearch( $idCat ){

			$keyword = $this->input->get('keyword', true);
			$result = $this->Forum_model->searchThread( $idCat, $keyword );
			$data = ['searchResult' => $result];
			$this->load->view('forum/app/search', $data);
		}

		public function getHighestVotesFromPost($dataPost){
		
		$votes = 0; $latestVotes = 0; $highestVotes = 0;

		foreach( $dataPost as $post ) {

			$votes = $this->Forum_model->countVotesByPost($post['id_post']);
	 			if( $votes > $latestVotes ) {
				$highestVotes = ['id_post' => $post['id_post'], 'username' => $post['username'], 'profile_picture' => $post['profile_picture'], 'tanggal_post' => $post['tanggal_post'], 'isi_post' => $post['isi_post'], 'votes' => $votes];
				}

				$latestVotes = $votes; 
			}

			return $highestVotes;
		}


		public function postSent(){

			if( !$this->session->has_userdata('userinfo') ){
				redirect( site_url() . '/forum/' );
			}


			if( !$this->input->post() ) {
				redirect( site_url() . '/forum/');
			}

			$this->form_validation->set_rules('post', 'Balasan', 'trim|required');

			if( !$this->form_validation->run() ){
				//error
				die;
			}

			$userId = $this->session->userdata('userinfo')['id'];
			$date = date('Y-m-d H:i:s');

			$result = $this->Forum_model->postSubmit($userId, $date);

			if( !$result ){
				//error
				die;
			}


			redirect( site_url() . '/forum/topik/id/' . $this->input->post('id-thread') );
			

		}


		// Profile Management


		public function editProfile(){

			if( !$this->session->has_userdata('userinfo') ){
				redirect(site_url() . "/forum/");
			}

			$userID = $this->session->userdata('userinfo');

			$memberData = $this->getMemberById($userID['id'], $userID['username']);
			$data = ['pageTitle' => 'Forum - Edit Profile',
					 'userData' => $memberData];

			$this->load->view('forum/template/header',  $data);
			$this->load->view('forum/edit-profile');
			$this->load->view('forum/template/footer');
		}


		public function updateProfile(){
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');
			$this->form_validation->set_rules('bio', 'Biodata', 'required');

			if( !$this->form_validation->run() ){

				$this->session->set_flashdata('valid_result', validation_errors());
				redirect( site_url() . '/forum/editprofile' );
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
					redirect( site_url() . '/forum/editprofile' );
				}
				
				$imageName = $this->upload->data()['file_name'];

			} 

			$userId = $this->session->userdata('userinfo')['id'];

			$result = $this->Forum_model->updateMemberInfoById($imageName, $userId);

			if( !$result ){
				$this->session->set_flashdata('valid_result', 'Terjadi kesalahan saat mengubah informasi akun anda.');
				redirect( site_url() . '/forum/editprofile' );
			}

			redirect( site_url() . '/forum/member/id/' . $this->session->userdata('userinfo')['id'] . '/' . $this->session->userdata('userinfo')['username'] );

		}

		// Forum Management

		public function myThread(){

			if( !$this->session->has_userdata('userinfo') ){
				redirect(site_url() . '/forum/');
			}

			$userId = $this->session->userdata('userinfo')['id'];
			$threadData = $this->Forum_model->getAllThreadByMemberId($userId);

			$data = ['pageTitle' => 'Forum - Aktivitas Thread',
					 'threadData' => $threadData];
			$this->load->view('forum/template/header',  $data);
			$this->load->view('forum/mythread');
			$this->load->view('forum/template/footer');
		}
		

		public function newThread($kategori){

			if( !$this->session->has_userdata('userinfo') ){
				redirect(site_url() . '/forum/signin-required/');
			}

			$kategoriSelected = $kategori;
			$kategoriData = $this->getAllKategoriForum();

			if( $kategoriSelected > count($kategoriData) ){
				$kategoriSelected = 1;
			}

			$data = ['pageTitle' => 'Forum - Buat Thread',
					 'kategori' => ['listKategori' => $kategoriData,
									'selectedKategori' => $kategoriSelected]];
			$this->load->view('forum/template/header',  $data);
			$this->load->view('forum/create-thread');
			$this->load->view('forum/template/footer');
		}


		public function makeThread(){

			if( !$this->session->has_userdata('userinfo') ){
				redirect( site_url() . '/forum/' );
			}


			if( !$this->input->post() ) {
				redirect( site_url() . '/forum/');
			}

			$this->form_validation->set_rules('judul-thread', 'Judul Thread', 'trim|required');
			$this->form_validation->set_rules('kategori-forum', 'kategori Forum', 'trim|required');
			$this->form_validation->set_rules('deskripsi-thread', 'Deskripsi Thread', 'trim|required');

			if(  !$this->form_validation->run() ){	

				$this->session->set_flashdata('valid_err', validation_errors() );
				redirect( site_url() . '/forum/createthread/kategori/' . $this->input->post('kategori-forum') );
				die;

			}


			$userId = $this->session->userdata('userinfo')['id'];
			$judulThread = $this->input->post('judul-thread', true);
			$kategoriForum = $this->input->post('kategori-forum', true);
			$deskripsiThread = $this->input->post('deskripsi-thread', true);
			$date = date('Y-m-d H:i:s');

			$result = $this->Forum_model->makeThread($userId, $judulThread, $kategoriForum, $deskripsiThread, $date);

			if( !$result ){
				$this->session->set_flashdata('valid_err', "Gagal Membuat Thread, Error Tidak Diketahui." );
				redirect( site_url() . '/forum/createthread/kategori/' . $this->input->post('kategori-forum') );
			}

			redirect( site_url() . '/forum/' );
		}


		public function getAllKategoriForum(){
			return $this->Forum_model->getAllKategoriForum();
		}

		public function votePost($postId, $threadId){

			if( !$this->session->has_userdata('userinfo') ){
				redirect( site_url() . '/forum/' );
			}


			$idUser = $this->session->userdata('userinfo')['id'];
			$date = date('Y-m-d H:i:s');

			if( $this->Forum_model->hasVote($idUser, $postId) > 0 ){
				$this->session->set_flashdata('notif', 'Kesalahan Saat Melakukan Vote');
				redirect( site_url() . '/forum/topik/id/' . $threadId );
			}

			$result = $this->Forum_model->sentVote($idUser, $postId, $threadId, $date);

			if( !$result ){
				$this->session->set_flashdata('notif', 'Kesalahan Saat Melakukan Vote');
				redirect( site_url() . '/forum/topik/id/' . $threadId );
			}

			redirect( site_url() . 'forum/topik/id/' . $threadId );
		}

		public function markBestAnswer($postId, $threadId){

			if( !$this->session->has_userdata('userinfo') ){
				redirect( site_url() . '/forum/' );
			}


			$idUser = $this->session->userdata('userinfo')['id'];
			$date = date('Y-m-d H:i:s');
			$hasVote = $this->Forum_model->hasVoteByThread($idUser, $threadId);

			if(  count($hasVote) > 0 ){
				$this->Forum_model->unvote($hasVote[0]['id_vote']);
			}

			$result = $this->Forum_model->sentVote($idUser, $postId, $threadId, $date);
			
			if( !$result ){
				$this->session->set_flashdata('notif', 'Kesalahan Saat Melakukan Vote');
				redirect( site_url() . '/forum/topik/id/' . $threadId );
			}

			redirect( site_url() . 'forum/topik/id/' . $threadId );

		}


		public function unvotepost($idPost, $idThread){


			if( !$this->session->has_userdata('userinfo') ){
				redirect( site_url() . '/forum/' );
			}

			$voteId = $this->Forum_model->getVoteByPostAndUser($idPost, $this->session->userdata('userinfo')['id'])[0]['id_vote'];

			$result = $this->Forum_model->unvote($voteId);

			if( !$result ){
				$this->session->set_flashdata('notif', 'Kesalahan Saat Melakukan Vote');
				redirect( site_url() . '/forum/topik/id/' . $idThread );
			}


			redirect( site_url() . '/forum/topik/id/' . $idThread );
			
		}

		public function appThreadTest(){
			$this->Forum_model->threadTestConnect();
		}

	}