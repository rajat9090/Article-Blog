<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

  
	public function index($page=1)
    {
        $perpage = 5;
        $param['offset'] = $perpage;
        $param['limit'] = ($page*$perpage)-$perpage;
        $param['q'] = $this->input->get('q');

        $this->load->model('Article_model');
        
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/article/index');
        $config['total_rows'] = $this->Article_model->getArticlesCount($param);
        $config['per_page'] = $perpage;
        $config['use_page_numbers'] = true;

        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled page-item'><li class='active page-item'><a href='#' class=\"page-link\">";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li class=\"page-item\">";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li  class=\"page-item\">";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li  class=\"page-item\">";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li  class=\"page-item\">";
        $config['last_tagl_close'] = "</li>";
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        $pagination_links = $this->pagination->create_links();


        $articles = $this->Article_model->getArticles($param);

        $data['q'] = $this->input->get('q');
        $data['articles'] = $articles;
        $data['pagination_links'] = $pagination_links;
        
        $data['mainModule'] = 'article';
        $data['subModule'] = 'viewArticle';

        $this->load->view("admin/article/list",$data);
    }



    public function create()
	{
        $this->load->helper('common_helper');
        $this->load->model('Article_model'); 
        $this->load->model('Category_model');
        $data['mainModule']='article';
        $data['subModule']='createArticle';
        $categories=$this->Category_model->getCategories();
        $data['categories']=$categories;


        $config['upload_path']='./public/uploads/articles/';
		$config['allowed_types']='gif|jpg|png|jpeg';
		$config['encrypt']=true;
        $this->load->library('upload',$config);
		
        $this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
		$this->form_validation->set_rules('category_id','Category', 'trim|required');
        $this->form_validation->set_rules('title','Title', 'trim|required|max_length[20]');
       
        $this->form_validation->set_rules('author','Author', 'trim|required|max_length[20]');
        if($this->form_validation->run()==true)
        {
            if(!empty($_FILES['image']['name'])){
                if($this->upload->do_upload('image')){
                    $data=$this->upload->data();
                
                    resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb_front/'.$data['file_name'],1120,800);
                    resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb_admin/'.$data['file_name'],300,250);
                
                    $formArray['image']=$data['file_name'];
                    $formArray['title']=$this->input->post('title');
                                $formArray['description']=$this->input->post('description');
                                $formArray['category']=$this->input->post('category_id');
                                $formArray['author']=$this->input->post('author');
                                $formArray['status']=$this->input->post('status');
                                $formArray['created_at']=date('Y-m-d H:i:s');
                    $admin =  $this->Article_model->addArticle($formArray);
                    $this->session->set_flashdata('success','Article Added Sucessfullly..');
                    redirect(base_url().'admin/article/index');
                }
                else{
                    $error=$this->upload->display_errors("<p class='invalid-feedback'>" ,'</p>');
                    $data['errorImageUpload']=$error;
                    $this->load->view('admin/article/create',$data);
                }
                            }
                            else{
                               
                               
                                $formArray['title']=$this->input->post('title');
                                $formArray['description']=$this->input->post('description');
                                $formArray['category']=$this->input->post('category_id');
                                $formArray['author']=$this->input->post('author');
                                $formArray['status']=$this->input->post('status');
                                $formArray['created_at']=date('Y-m-d H:i:s');
                                $admin =  $this->Article_model->addArticle($formArray);
                                $this->session->set_flashdata('success','Article Added Sucessfullly..');
                                redirect(base_url().'admin/article/index');
                            }
        }
        else
        {
            $this->load->view('admin/article/create',$data);
        }
	}
    
    public function edit($id)
	{

        $this->load->model('Category_model');
        $this->load->library('form_validation');
        $this->load->helper('common_helper');
		$this->load->model('Article_model'); 
        $data['mainModule']='article';
        $data['subModule']='viewArticle';
		$articles=$this->Article_model->getArticle($id);
		if(empty($articles))
		{
			$this->session->set_flashdata('error','Article not found');
				redirect(base_url().'admin/article/index');
		}

        $categories=$this->Category_model->getCategories();
        $data['categories']=$categories;
        $data['articles']=$articles;



		
		$config['upload_path']='./public/uploads/articles/';
		$config['allowed_types']='gif|jpg|png|jpeg';
		$config['encrypt']=true;
		// $config['max_size']='200000';
		// $config['max_width']='1024';
		
		// $config['max_height']='768';
		$this->load->library('upload',$config);

		
		
		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
		$this->form_validation->set_rules('category_id','Category', 'trim|required');
        $this->form_validation->set_rules('title','Title', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('author','Author', 'trim|required|max_length[20]');
		if($this->form_validation->run()==true)
        {
			if(!empty($_FILES['image']['name'])){
            if($this->upload->do_upload('image')){
             $data=$this->upload->data();

  if(file_exists('./public/uploads/articles/'.$articles['image']))
	{
		unlink('./public/uploads/articles/'.$articles['image']);
	}
	if(file_exists('./public/uploads/articles/thumb_front/'.$articles['image']))
	{
		unlink('./public/uploads/articles/thumb_front/'.$articles['image']);
	}
    if(file_exists('./public/uploads/articles/thumb_admin/'.$articles['image']))
	{
		unlink('./public/uploads/articles/thumb_admin/'.$articles['image']);
	}

             resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb_front/'.$data['file_name'],1120,800);
             resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb_admin/'.$data['file_name'],300,250);

	$formArray['image']=$data['file_name'];
	 $formArray['title']=$this->input->post('title');
                                $formArray['description']=$this->input->post('description');
                                $formArray['category']=$this->input->post('category_id');
                                $formArray['author']=$this->input->post('author');
                                $formArray['status']=$this->input->post('status');
                                $formArray['updated_at']=date('Y-m-d H:i:s');
	                            $this->Article_model->updateArticle($id,$formArray);

	
	$this->session->set_flashdata('success','Article Updated Sucessfullly..');
	redirect(base_url().'admin/article/index');
}
else{
	$error=$this->upload->display_errors("<p class='invalid-feedback'>" ,'</p>');
	$data['errorImageUpload']=$error;
	
	$this->load->view('admin/article/edit',$data);
}
			}
			else{
                $formArray['title']=$this->input->post('title');
                $formArray['description']=$this->input->post('description');
                $formArray['category']=$this->input->post('category_id');
                $formArray['author']=$this->input->post('author');
                $formArray['status']=$this->input->post('status');
                $formArray['updated_at']=date('Y-m-d H:i:s');
				$this->Article_model->updateArticle($id,$formArray);
				$this->session->set_flashdata('success','Article Updated Sucessfullly..');
				redirect(base_url().'admin/article/index');
			}
			
        }
		else{
			// $data['articles']=$articles;
			$this->load->view('admin/article/edit',$data);
		}

		
	}
    public function delete($id)
	{
       
		$this->load->model('Article_model'); 
		$articles=$this->Article_model->getArticle($id);
		if(empty($articles))
		{
			$this->session->set_flashdata('error','Article not found');
				redirect(base_url().'admin/article/index');
		}
		if(file_exists('./public/uploads/articles/'.$articles['image']))
	{
		unlink('./public/uploads/articles/'.$articles['image']);
	}
	if(file_exists('./public/uploads/articles/thumb_admin/'.$articles['image']))
	{
		unlink('./public/uploads/articles/thumb_admin/'.$articles['image']);
	}
    if(file_exists('./public/uploads/articles/thumb_front/'.$articles['image']))
	{
		unlink('./public/uploads/articles/thumb_front/'.$articles['image']);
	}
		$this->Article_model->deleteArticle($id);
		$this->session->set_flashdata('success','Article deleted Sucessfully');
				redirect(base_url().'admin/article/index');
	}

    public function __construct()
    {
        parent::__construct();
       
        if(!$this->session->userdata('admin'))
        return redirect('admin/login');
        
    }

}
