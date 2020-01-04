<?php


	class Forum_model extends CI_Model{

		public function getAllKategoriForum(){
			$this->db->select('id_kategori, judul_kategori, deskripsi');
			$this->db->from('kategori_forum');
			$result = $this->db->get()->result_array();
			return $result;
		}


		public function getAllThreadByKategori($id){
			$this->db->select('id_thread, status_thread, kategori_forum, judul_thread, moderator, username, , tanggal_dibuat, deskripsi_thread');
			$this->db->from('thread');
			$this->db->join('account', 'thread.moderator = account.id');
			$this->db->where(array('kategori_forum =' => $id, 'status_thread =' => 1));
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getThreadById($id){
			$this->db->select('id_thread, status_thread, kategori_forum, judul_thread, moderator, username, profile_picture , tanggal_dibuat, deskripsi_thread, id');
			$this->db->from('thread');
			$this->db->join('account', 'thread.moderator = account.id');
			$this->db->where(array('id_thread =' => $id, 'status_thread =' => 1));
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function searchThread( $idCat, $keyword ){
			$this->db->select('*');
			$this->db->from('thread');
			$this->db->join('account', 'thread.moderator = account.id');
			$this->db->where('thread.kategori_forum = ', $idCat);
			$this->db->like('judul_thread', $keyword);
			return $this->db->get()->result_array();
		}

		public function postSubmit($userId, $date){

			$idThread = $this->input->post('id-thread', true);
			$post = $this->input->post('post', true);

			$data = ['id_post' => '',
					 'id_thread' => $idThread,
					 'pengirim' => $userId,
					 'isi_post' => $post,
					 'tanggal_post' => $date,
					 'status_post' => 1];

			$result = $this->db->insert('post', $data);

			return $result;
		}



		// Member


		public function updateMemberInfoById($imgName, $userId){
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


		public function deletePostById($idPost){
			$data = ['status_post' => 0];

			$this->db->where('id_post = '. $idPost) ;
			$result = $this->db->update('post', $data);
			return $result;

		}

		public function deleteThreadById($idThread){
			$data = ['status_thread' => 0];
			$this->db->where('id_thread = '. $idThread) ;
			$result = $this->db->update('thread', $data);
			return $result;

		}


		public function getMemberById($id, $username){
			$this->db->select('id, username, email, gender, birthdate, profile_picture, bio, previlege, join_date');
			$this->db->from('account');
			$this->db->where('id = ' . $id . ' AND username = "' . $username . '"' );
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function countThreadByMemberId($id){
			$this->db->select('*');
			$this->db->from('thread');
			$this->db->where(array('moderator = ' => $id, 'status_thread =' => 1));
			$result = $this->db->get()->num_rows();
			return $result;
		}


		public function getAllThreadByMemberId($id){
			$this->db->select('*');
			$this->db->from('thread');
			$this->db->where(array('moderator = ' => $id, 'status_thread =' => 1 ));
			$result = $this->db->get()->result_array();	
			return $result;
		}


		public function getLatestPostByThreadId($id){
			$this->db->select('*');
			$this->db->from('post');
			$this->db->join('account', 'post.pengirim = account.id', 'left');
			$this->db->limit(1);
			$this->db->order_by('tanggal_post ASC');
			$this->db->where('id_thread = ' . $id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPostByThreadId($id){
			$this->db->select('id, username, profile_picture, id_post, tanggal_post, isi_post, status_post');
			$this->db->from('post');
			$this->db->join('account', 'post.pengirim = account.id', 'left');
			$this->db->order_by('tanggal_post ASC');
			$this->db->where('id_thread = ' . $id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPostById($id){
			$this->db->select('*');
			$this->db->from('post');
			$this->db->join('account', 'post.pengirim = account.id', 'left');
			$this->db->order_by('tanggal_post ASC');
			$this->db->where('id_post = ' . $id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function countPostByMemberId($id){
			$this->db->select('*');
			$this->db->from('post');
			$this->db->where('pengirim =' . $id );
			$result = $this->db->get()->num_rows();
			return $result;	

		}


		public function countPostByThread($id){
			$this->db->select('*');
			$this->db->from('post');
			$this->db->where('id_thread =' . $id );
			$result = $this->db->get()->num_rows();
			return $result;	

		}


		public function countVotesByPost($id){
			$this->db->select('*');
			$this->db->from('vote');
			$this->db->where('id_post =' . $id );
			$result = $this->db->get()->num_rows();
			return $result;	

		}

		public function makeThread($userId, $judul, $kategori, $deskripsi, $date){
			
			$data = ['id_thread' => '',
				  'kategori_forum' => $kategori,
				  'status_thread' => 1,
				  'judul_thread' => $judul,
				  'moderator' => $userId,
				  'deskripsi_thread' => $deskripsi,
				  'tanggal_dibuat' => $date]	;

			$result = $this->db->insert('thread', $data);
			return $result;
		}

		public function updateThread($threadId, $judul, $kategori, $deskripsi, $date){
			$data = ['kategori_forum' => $kategori,
					 'judul_thread' => $judul,
					 'deskripsi_thread' => $deskripsi,
					 'tanggal_dibuat' => $date];
			$this->db->where('id_thread = ',  $threadId);
			$result = $this->db->update('thread', $data);
			return $result;

		}

		public function sentVote ( $userId, $idPost, $idThread, $date ){

			$data = ['id_vote' => '',
					 'id_user' => $userId,
					 'id_thread' => $idThread,
					 'id_post' => $idPost,
					 'date' => $date];

			$result = $this->db->insert('vote', $data);


			return $result;
		}

		public function hasVote($idUser, $idPost){

			$this->db->select('id_user');
			$this->db->from('vote');
			$this->db->where(['id_user' => $idUser, 'id_post' => $idPost]);
			$result = $this->db->get()->num_rows();
			return $result;

		}

		public function hasVoteByThread($idUser, $idThread){

			$this->db->select('id_vote');
			$this->db->from('vote');
			$this->db->where(['id_user' => $idUser, 'id_thread' => $idThread]);
			$result = $this->db->get()->result_array();
			return $result;

		}

		public function markedPost($idUser, $idPost){
			$this->db->select('id_user');
			$this->db->from('vote');
			$this->db->where(['id_user' => $idUser, 'id_post' => $idPost]);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getVoteByPostAndUser($idPost, $idUser){

			$this->db->select('id_vote');
			$this->db->from('vote');
			$this->db->where(['id_user' => $idUser, 'id_post' => $idPost]);
			$result = $this->db->get()->result_array();
			return $result; 

		}

		public function unvote($voteId){
			$this->db->where('id_vote', $voteId);
			$result = $this->db->delete('vote');
			return $result;
		}

		public function threadTestConnect(){
			$this->db->select('id_post');
			$this->db->from('post');
			$post = $this->db->get()->num_rows();

			$this->db->select('id_post');
			$this->db->from('vote');
			$votes = $this->db->get()->num_rows();

			echo $post + $votes;
		}

	}