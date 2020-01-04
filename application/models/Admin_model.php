<?php 


	class Admin_model extends CI_Model{

		public function loginAuth(){
			$data = ['username' => $this->input->post('username', true),
					 'password' => hash("sha256", $this->input->post('password', true) . $this->input->post('username', true))];

			$this->db->select('*');
			$this->db->from('admin');
			$this->db->where($data);

			return $this->db->get()->result_array();

		}

		// Getting Data

		public function getAllMember(){
			$this->db->select('id, username, email, gender, birthdate, profile_picture, bio, join_date');
			$this->db->from('account');
			return $this->db->get()->result_array();
		}


		public function getDetailMember($id){
			$this->db->select('id, username, email, gender, birthdate, profile_picture, bio, join_date');
			$this->db->from('account');
			$this->db->where('id', $id);
			return $this->db->get()->result_array();
		}


		public function getSuggestByUserId($id){
			$this->db->select('feedback_suggest.id, feedback_suggest.feed_description, feedback_suggest.date');
			$this->db->from('feedback_suggest');
			$this->db->where('user_feed', $id);
			return $this->db->get()->result_array();
		}


		public function getErrReportByUserId($id){
			$this->db->select('feedback_error.id, feedback_error.feed_description, feedback_error.date');
			$this->db->from('feedback_error');
			$this->db->where('user_feed', $id);
			return $this->db->get()->result_array();
		}

		public function getForumPostByUserId($id){
			$this->db->select('*');
			$this->db->from('thread');
			$this->db->where('moderator', $id);
			return $this->db->get()->result_array();
		}


		public function getForumRepliesByUserId($id){
			$this->db->select('*');
			$this->db->from('post');
			$this->db->where('pengirim', $id);
			return $this->db->get()->result_array();
		}


		public function getAllCategories(){
			$this->db->select('*');
			$this->db->from('feedback_type');
			return $this->db->get()->result_array();
		}

		public function getAllErrorReport($sort = null){
			$this->db->select('feedback_error.id, feedback_error.attachment_id, feedback_error.date, feedback_error.feed_description, feedback_error.status_feedback, account.username, feedback_type.feed_categoryname, feedback_type.priority');
			$this->db->from('feedback_error');
			$this->db->join('account', 'feedback_error.user_feed = account.id', 'left');
			$this->db->join('feedback_type', 'feedback_error.feed_category = feedback_type.id', 'left');

			if( !is_null($sort) ){
				if( $sort['sort-target'] == 'priority' ){
					$this->db->order_by('feedback_type.' . $sort['sort-target'], $sort['sort-property']);
				} else {
				$this->db->order_by('feedback_error.' . $sort['sort-target'], $sort['sort-property']);
				}
			} else {
				$this->db->order_by('feedback_error.status_feedback', 'DESC');
				$this->db->order_by('feedback_error.date', 'ASC');
			}

			return $this->db->get()->result_array();
		}


		public function getReportById($id){
			$this->db->select('account.username, account.profile_picture,
							   feedback_error.id, feedback_error.status_feedback , feedback_error.date, feedback_error.feed_description, 
							   feedback_error.attachment_id, feedback_error.device_brand, feedback_error.brand_model,
							   feedback_error.os_version, feedback_attachment.link_file');
			$this->db->from('feedback_error');
			$this->db->join('account', 'feedback_error.user_feed = account.id', 'left');
			$this->db->join('feedback_attachment', 'feedback_error.attachment_id = feedback_attachment.attach_id', 'left');
			$this->db->where('feedback_error.id = ', $id);
			return $this->db->get()->result_array();
		}


		public function getAllSuggest($sort = null){
			$this->db->select('username, feedback_suggest.id, status_feedback , date, feed_description, attachment_id');
			$this->db->from('feedback_suggest');
			$this->db->join('account','feedback_suggest.user_feed = account.id', 'left');

			if( !is_null($sort) ){
				$this->db->order_by('feedback_suggest.' . $sort['sort-target'], $sort['sort-property']);
			} else {
				$this->db->order_by('feedback_suggest.status_feedback', 'DESC');
				$this->db->order_by('feedback_suggest.date', 'ASC');
			}

			return $this->db->get()->result_array();
		}


		public function getSuggestById($id){
			$this->db->select('username, feedback_suggest.id, status_feedback , date, feed_description, attachment_id, profile_picture, link_file');
			$this->db->from('feedback_suggest');
			$this->db->join('account', 'feedback_suggest.user_feed = account.id', 'left');
			$this->db->join('feedback_attachment', 'feedback_suggest.attachment_id = feedback_attachment.attach_id', 'left');
			$this->db->where('feedback_suggest.id = ', $id);
			return $this->db->get()->result_array();
		}

		// Adding New Data

		public function addCategory($title, $priority){
			$data = ['id' => 0,
					 'feed_categoryname' => $title,
					 'priority' => $priority];

			$result = $this->db->insert('feedback_type', $data);
			return $result;
		}

		// Removing Data

		public function removeCategory($id){
			$result = $this->db->delete('feedback_type', ['id' => $id]);
			return $result;
		}


		// Update Data

		public function updateSuggestStatus($status, $id){

			if( $status > 1 || $status < 0 ){
				return FALSE;
				die;
			}

			$this->db->where('id =', $id);
			return $this->db->update('feedback_suggest', ['status_feedback' => $status]);
		}

		public function updateReportStatus($status, $id){

			if( $status > 1 || $status < 0 ){
				return FALSE;
				die;
			}

			$this->db->where('id =', $id);
			return $this->db->update('feedback_error', ['status_feedback' => $status]);
		}

}