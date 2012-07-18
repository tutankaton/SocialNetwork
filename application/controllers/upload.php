<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
		$config['upload_path'] = './members/'.$this->session->userdata('id').'/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '300';
		$config['max_height']  = '300';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$this->load->model('User_model');
			$error = array('error' => $this->upload->display_errors());
			$data['title'] = 'Error uploading';
			$data['discription'] = '';
			$data['keyword'] = '';
			$data['error'] = $error;
			$data['main_content'] = 'upload_form';
			$this->load->view('includes/template',$data);
		}
		else
		{
			$this->load->model('User_model');
			$data = array('upload_data' => $this->upload->data());
			foreach ($data as $item => $value):
				$this->User_model->update_photo('/socialNetwork/members/'.$this->session->userdata('id').'/'.$value['file_name']);
			endforeach; 
			$data['title'] = 'Account';
			$data['discription'] = '';
			$data['keyword'] = '';
			$data['main_content'] = 'user/account';
			$this->load->view('includes/template',$data);
		}
	}
}
?>