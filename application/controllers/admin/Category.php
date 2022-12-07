<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public function index()
	{   $this->load->model('Category_model');  
$q=$this->input->get('q');
$params['q']=$q;

		$categories=$this->Category_model->getCategories($params);
		
		$data['categories']=$categories;
		$data['q']=$q;
		$this->load->view('admin/category/list',$data);
	}
    public function create()
	{
		$this->load->helper('common_helper');
		$config['upload_path']='./public/uploads/category/';
		$config['allowed_types']='gif|jpg|png|jpeg';
		$config['encrypt']=true;
		$config['max_size']='200000';
		// $config['max_width']='1024';
		
		// $config['max_height']='768';
		$this->load->library('upload',$config);

		$this->load->model('Category_model');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
		$this->form_validation->set_rules('name','Name', 'trim|required');
		if($this->form_validation->run()==true)
        {
			if(!empty($_FILES['image']['name'])){
if($this->upload->do_upload('image')){
    $data=$this->upload->data();

	resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],300,270);

	$formArray['image']=$data['file_name'];
	$formArray['name']=$this->input->post('name');
	$formArray['status']=$this->input->post('status');
	$formArray['created_at']=date('Y-m-d H:i:s');
	$admin =  $this->Category_model->create($formArray);
	$this->session->set_flashdata('success','Category Added Sucessfullly..');
	redirect(base_url().'admin/category/index');
}
else{
	$error=$this->upload->display_errors("<p class='invalid-feedback'>" ,'</p>');
	$data['errorImageUpload']=$error;
	$this->load->view('admin/category/create',$data);
}
			}
			else{
				$formArray['name']=$this->input->post('name');
				$formArray['status']=$this->input->post('status');
				$formArray['created_at']=date('Y-m-d H:i:s');
				$admin =  $this->Category_model->create($formArray);
				$this->session->set_flashdata('success','Category Added Sucessfullly..');
				redirect(base_url().'admin/category/index');
			}
			
        }
        else{
            $this->load->view('admin/category/create');
        }
		
    }
		
	
    public function edit($id)
	{
		// echo $id;
		$this->load->model('Category_model'); 
		$categories=$this->Category_model->getCategory($id);
		if(empty($categories))
		{
			$this->session->set_flashdata('error','Category not found');
				redirect(base_url().'admin/category/index');
		}
		$this->load->helper('common_helper');
		$config['upload_path']='./public/uploads/category/';
		$config['allowed_types']='gif|jpg|png|jpeg';
		$config['encrypt']=true;
		$config['max_size']='200000';
		// $config['max_width']='1024';
		
		// $config['max_height']='768';
		$this->load->library('upload',$config);

		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
		$this->form_validation->set_rules('name','Name', 'trim|required');
		if($this->form_validation->run()==true)
        {
			if(!empty($_FILES['image']['name'])){
if($this->upload->do_upload('image')){
    $data=$this->upload->data();

	resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],300,270);

	$formArray['image']=$data['file_name'];
	$formArray['name']=$this->input->post('name');
	$formArray['status']=$this->input->post('status');
	$formArray['updated_at']=date('Y-m-d H:i:s');
	$admin =  $this->Category_model->update($id,$formArray);

	if(file_exists('./public/uploads/category/'.$categories['image']))
	{
		unlink('./public/uploads/category/'.$categories['image']);
	}
	if(file_exists('./public/uploads/category/thumb/'.$categories['image']))
	{
		unlink('./public/uploads/category/thumb/'.$categories['image']);
	}
	$this->session->set_flashdata('success','Category Updated Sucessfullly..');
	redirect(base_url().'admin/category/index');
}
else{
	$error=$this->upload->display_errors("<p class='invalid-feedback'>" ,'</p>');
	$data['errorImageUpload']=$error;
	$data['categories']=$categories;
	$this->load->view('admin/category/edit',$data);
}
			}
			else{
				$formArray['name']=$this->input->post('name');
				$formArray['status']=$this->input->post('status');
				$formArray['updated_at']=date('Y-m-d H:i:s');
				$admin =  $this->Category_model->update($id,$formArray);
				$this->session->set_flashdata('success','Category Updated Sucessfullly..');
				redirect(base_url().'admin/category/index');
			}
			
        }
		else{
			$data['categories']=$categories;
			$this->load->view('admin/category/edit',$data);
		}

		
	}
    public function delete($id)
	{
		$this->load->model('Category_model'); 
		$categories=$this->Category_model->getCategory($id);
		if(empty($categories))
		{
			$this->session->set_flashdata('error','Category not found');
				redirect(base_url().'admin/category/index');
		}
		if(file_exists('./public/uploads/category/'.$categories['image']))
	{
		unlink('./public/uploads/category/'.$categories['image']);
	}
	if(file_exists('./public/uploads/category/thumb/'.$categories['image']))
	{
		unlink('./public/uploads/category/thumb/'.$categories['image']);
	}
		$this->Category_model->delete($id);
		$this->session->set_flashdata('success','Category deleted Sucessfully');
				redirect(base_url().'admin/category/index');
	}

	public function __construct()
    {
        parent::__construct();
       
        if(!$this->session->userdata('admin'))
        return redirect('admin/login');
        
    }
}