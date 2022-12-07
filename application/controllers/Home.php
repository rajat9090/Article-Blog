<?php

class Home extends CI_controller{

    function index() {

        $this->load->model('Article_model');

        $param['offset'] = 4;
        $param['limit'] = 0;
        $articles = $this->Article_model->getArticlesFront($param);

        // echo "<pre>";
        // print_r($articles);
        // echo "</pre>";
        // exit;

        $data['articles'] = $articles;
        $this->load->view('front/home',$data);
    }
}

?>
