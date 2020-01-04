<?php 

	class Feedback_model extends CI_Model{

		public function getFeedCategory(){
			$this->db->select('id, feed_categoryname');
			$this->db->from('feedback_type');
			return $this->db->get()->result_array();
		}


		public function errorSend($user, $date, $attachment){

			$deviceBrand = $this->input->post('device-brand', true);
			$brandModel = $this->input->post('brand-model', true);
			$osVersion = $this->input->post('os-version', true);
			$feedDesc = $this->input->post('feed-description', true);
			$errCategory = $this->input->post('err-category', true);

			if( !$attachment ){
				$attach_id = 'none';
			} else {
				$attach_id = hash('sha256', $attachment);
			}

			$data = ['id' => '',
					 'user_feed' => $user,
					 'feed_category' => $errCategory,
					 'feed_description' => $feedDesc,
					 'date' => $date,
					 'status_feedback' => 1,
					 'attachment_id' => $attach_id,
					 'device_brand' => $deviceBrand,
					 'brand_model' => $brandModel,
					 'os_version' => $osVersion];

			$attach = ['id' => '',
		 			   'attach_id' => $attach_id,
		 			   'link_file' => $attachment];

			$result = $this->db->insert('feedback_error', $data);

			if( $attachment != FALSE ){
				$this->db->insert('feedback_attachment', $attach);
			}

			return $result;
		}


		public function suggestSend($user, $date, $attachment){

			$feedDesc = $this->input->post('feed-description', true);

			if( !$attachment ){
				$attach_id = 'none';
			} else {
				$attach_id = hash('sha256', $attachment);
			}

			$data = ['id' => '',
					 'user_feed' => $user,
					 'feed_description' => $feedDesc,
					 'date' => $date,
					 'status_feedback' => 1,
					 'attachment_id' => $attach_id];

			$attach = ['id' => '',
		 			   'attach_id' => $attach_id,
		 			   'link_file' => $attachment];

			$result = $this->db->insert('feedback_suggest', $data);

			if( $attachment != FALSE ){
				$this->db->insert('feedback_attachment', $attach);
			}

			return $result;
		}

		public function countFeedByUser( $id ){
			$this->db->select('*');
			$this->db->from('feedback_suggest');
			$this->db->where('user_feed =', $id);
			$numSuggest = $this->db->get()->num_rows();

			$this->db->select('*');
			$this->db->from('feedback_error');
			$this->db->where('user_feed =', $id);
			$numError = $this->db->get()->num_rows();

			return $numSuggest + $numError;
		}

		public function countPendFeedByUser( $id ){
			$this->db->select('*');
			$this->db->from('feedback_suggest');
			$this->db->where(['user_feed' => $id, 'status_feedback' => 1]);
			$numSuggest = $this->db->get()->num_rows();

			$this->db->select('*');
			$this->db->from('feedback_error');
			$this->db->where(['user_feed' => $id, 'status_feedback' => 1]);
			$numError = $this->db->get()->num_rows();

			return $numSuggest + $numError;
		}

		public function countSuccFeedByUser( $id ){
			$this->db->select('*');
			$this->db->from('feedback_suggest');
			$this->db->where(['user_feed' => $id, 'status_feedback' => 0]);
			$numSuggest = $this->db->get()->num_rows();

			$this->db->select('*');
			$this->db->from('feedback_error');
			$this->db->where(['user_feed' => $id, 'status_feedback' => 0]);
			$numError = $this->db->get()->num_rows();

			return $numSuggest + $numError;
		}

		public function getSuggestByUser( $id ){
			$this->db->select('*');
			$this->db->from('feedback_suggest');
			$this->db->where('user_feed', $id);
			return $this->db->get()->result_array();

		}

		public function getErrReportByUser( $id ){
			$this->db->select('*');
			$this->db->from('feedback_error');
			$this->db->where('user_feed', $id);
			return $this->db->get()->result_array();

		}


	}