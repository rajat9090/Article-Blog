<?php $this->load->view('front/header');?>
    
    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="<?php echo base_url('public/images/slide1.jpg')?>" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item">
                <img src="<?php echo base_url('public/images/slide2.jpg')?>" class="d-block w-100" alt="">
            </div>
            <div class="carousel-item">
                <img src="<?php echo base_url('public/images/slide3.jpg')?>" class="d-block w-100" alt="">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container pt-4 pb-4">
        <h3 class="pb-3">About Company</h3>

        <p class="text-muted">
            Welcome to Codeigniter Application Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries
        </p>

        <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    </div>

    
    <div class="bg-light pb-4">
         <div class="container">

            <h3 class="pb-3 pt-4">OUR SERVICES</h3>

            <div class="row">
                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="<?php echo base_url('public/images/box1.jpg')?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">Website Development</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="<?php echo base_url('public/images/box2.jpg')?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">Digital Marketing</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="<?php echo base_url('public/images/box3.jpg')?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">Mobile App Development</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="<?php echo base_url('public/images/box4.jpg')?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">IT Consulting Services</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
   
   <?php if(!empty($articles)){?>

    <div class="pb-4 pt-4">
        <div class="container">
            <h3 class="pb-3 pt-4">LATEST BLOGS</h3>

            <div class="row">

                <?php foreach($articles as $article){?>
                
                <div class="col-md-3">
                    <div class="card h-100">
                        
                        <a href="<?php echo base_url('blog/detail/'.$article['id'])?>">
                        <?php if(file_exists('./public/uploads/articles/thumb_admin/'.$article['image'])){?>
                            <img src="<?php echo base_url('public/uploads/articles/thumb_admin/'.$article['image'])?>" class="card-img-top" alt="">    
                        <?php } ?>
                        </a>
                        
                        <div class="card-body">
                            <p class="card-text"><?php echo $article['title']?></p>

                            <a class="btn btn-primary btn-sm" href="<?php echo base_url('blog/detail/'.$article['id'])?>">Read More</a>
                        </div>
                    </div>
                </div>

                <?php } ?>

                


            </div>

        </div>
    </div>

    <?php } ?>
    
    <?php $this->load->view('front/footer');?>