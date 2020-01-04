<?php

	
	class Feedback extends CI_Controller{

		public function __CONSTRUCT(){
			parent::__CONSTRUCT();
			$this->load->model('Feedback_model');
		}

		public function index(){

			if( !$this->session->has_userdata('userinfo') ){

				$this->session->set_flashdata('notification', 
					['notif_title' => 'Belum Gabung?', 
					 'notif_text' => 'Ayo gabung sekarang, agar kami dapat mengenali anda. Atau klik tutup untuk melanjutkan pengiriman feedback dengan mode <i>Guest</i> <br> <br> <a href="signup" class="btn">Gabung Sekarang!</a>', 
					 'notif_image' => base_url() . 'asset/images/illustration/people-hole.png',
					 'config' => FALSE]);
			}
			
			$category['category'] = $this->Feedback_model->getFeedCategory();
			$this->load->view('feedback', $category);

		}

		public function kirim(){

			// Validasi Data

			$this->form_validation->set_rules('feed-type', 'Feedback Type', 'trim|required');
			$this->form_validation->set_rules('feed-description', 'Feedback Description', 'trim|required');

			if( $this->input->post('feed-type') == 2 ){
				$this->form_validation->set_rules('device-brand', 'Device Brand', 'trim|required');
				$this->form_validation->set_rules('brand-model', 'Brand Model', 'trim|required');
				$this->form_validation->set_rules('os-version', 'OS Version', 'trim|required');
				$this->form_validation->set_rules('err-category', 'OS Version', 'trim|required');
			}

			if ( $this->form_validation->run() == FALSE ){
				$this->session->set_flashdata('feed-notif', validation_errors());
				redirect('feedback');
			}

			// Mendapatkan Informasi User


			if( $this->session->has_userdata('userinfo') ){
				$user = $this->session->userdata('userinfo')['id'];
			} else {
				$user = 0;
			}



			// Mendapatkan Tanggal

			date_default_timezone_set("Asia/Jakarta");
			$date = date("Y-m-d H:i:s");





			// Mengupload Gambar

			if( $_FILES['feed-attach']['error'] == 0 ){

				$config['upload_path'] = './asset/images/feed-attach/';
				$config['allowed_types'] = 'jpg|png|bmp';
				$config['max_size'] = '5000';
				$config['encrypt_name'] = TRUE;


				$this->upload->initialize($config);
				$result = $this->upload->do_upload('feed-attach', $config);

				if( !$result ){
					$this->session->set_flashdata('feed-notif', $this->upload->display_errors());
					redirect('feedback');
				}

				$filename = $this->upload->data()['file_name'];
				$feedDir = base_url() . 'asset/images/feed-attach/' . $filename; // Feedback Directory Files
 
			} else {
				$feedDir = FALSE;
			}


			// Proses Pengiriman Data

				if( $this->input->post('feed-type') == 2 ){
					
					// Suggestion

					$result = $this->Feedback_model->errorSend($user, $date, $feedDir);
					

				} else if ( $this->input->post('feed-type') == 1 ){

					// Error Reporting

					$result = $this->Feedback_model->suggestSend($user, $date, $feedDir);

				} else { 

					$result = FALSE;

				}
			
				

				if ( !$result ){

					$this->session->set_flashdata('feed-notif',"Terjadi kesalahan saat mengirim feedback, harap coba lagi");
					redirect('feedback');

				}

				$this->session->set_flashdata('notification', 
					['notif_title' => 'Feedback Diterima!', 
					 'notif_text' => 'Terimakasih sudah berpartisipasi dalam pengembangan layanan aplikasi kami <br> <br> <a href="' . site_url() . '/profile#feedbackStatus" class="btn">Lihat Status Feedback Anda</a>', 
					 'notif_image' => base_url() . 'asset/images/illustration/feed-accepted.png',
					 'config' => ['width' => '5'] ]);

				redirect('beranda');

		}

	}