<?php
	defined('BASEPATH') OR exit ('no direct script access allowed');


	class Dashboard extends CI_Controller	{
		
		public function __Construct()
		{
			parent ::__Construct();
			$this->API="http://localhost/api/";
			
		}

		public function index()
		{
			$datas['link_dashboard'] = 'class="active"';
			if(isset($_FILES["image"]["tmp_name"]))  
			{  
				$config['upload_path'] = './uploads';  
				$config['allowed_types'] = 'jpg|jpeg|png|gif';  
				$this->load->library('upload', $config);  
				if(!$this->upload->do_upload('image'))  
				{  
					echo $this->upload->display_errors();  
				}  
				else  
				{  
					$data = $this->upload->data();  
					$config['image_library'] = 'gd2';  
					$config['source_image'] = './uploads/'.$data["file_name"];  
					$config['create_thumb'] = FALSE;  
					$config['maintain_ratio'] = FALSE;  
					$config['quality'] = '75%';  
					$config['width'] = 400;  
					$config['height'] = 540;  
					$config['new_image'] = './uploads/'.$data["file_name"];  
					$this->load->library('image_lib', $config);  
					$this->image_lib->resize();    
					$image_data = array(  
						'name'          =>     $data["file_name"]  
					);
					if (function_exists('curl_file_create')) {
						$cFile = curl_file_create($data['full_path'], $data["file_type"],$data["file_name"]);
					} else { 
						$cFile = '@' . realpath($data['full_path']);
					}
					$url = $this->API.'/uploadImage';
					$data = array(
						'username'	=> $this->input->post("username"),
						'email'		=> $this->input->post("email"),
						'image' 	=> $cFile
					);
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $this->API.'Auths/register');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt($ch, CURLOPT_HEADER, 1);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
					$result = curl_exec($ch);

					$headers=array();

					$data=explode("\n",$result);

					array_shift($data);

					foreach($data as $part){
						$middle=explode(":",$part);
						error_reporting(0);
						$headers[trim($middle[0])] = trim($middle[1]);
					}
					$resval = (array)json_decode(end($data), true);

					$psn = $resval['message'];
					$datas["message"] = $psn;
					$data_img = $resval['data']['image'];
					$datas["img"] = $data_img;
					if (unlink($cFile->name))
					{
						// echo json_encode(array("link"=>$data_img,"name"=>$data_img));  
					}
						// print_r($data);
				}  
				
			}
			$this->load->view('header',$datas);
			$this->load->view('dashboard');
			$this->load->view('footer');
			
		}

	}