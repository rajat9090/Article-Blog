<?php
$this->load->view('front/header');
?>

<div class="container">
    <h3 class="pt-4 pb-4">Blog</h3>

    <div class="row">
        <div class="col-md-12">
            <h3><?php echo $article['title'];?></h3>

            <div class="d-flex justify-content-between">
                <p class="text-muted">Posted By <strong><?php echo $article['author'];?></strong> on <strong><?php echo date('d M Y',strtotime($article['created_at']));?></strong></p>
                <a href="#" class="text-muted p-2 bg-light text-uppercase"><strong><?php echo $article['category_name']?></strong></a>
            </div>


            <?php
            if ($article['image']!="" && file_exists('./public/uploads/articles/thumb_front/'.$article['image'])) {
                ?>
                <div class="mb-3 mt-3">
                    <img src="<?php echo base_url('public/uploads/articles/thumb_front/'.$article['image']);?>" alt="" class="w-100">
                </div>
                <?php
            }
            ?>

            <?php
                echo $article['description'];
            ?>
            
                <div class="col-md-9 pl-0" id="comment-box">
                    <?php 
                        if(validation_errors() != "") {
                            ?>
                            <div class="alert alert-danger">
                                <h4 class="alert-heading">Please fix the following errors!</h4>
                                <?php echo validation_errors();?>
                            </div>
                            <?php
                        }
                    ?>

                    <?php 
                        if(!empty($this->session->flashdata('message'))) {
                            ?>
                            <div class="alert alert-success">
                                <?php echo $this->session->flashdata('message');?>
                            </div>
                            <?php
                        }
                    ?>

                    <div class="card">
                        <div class="card-body">
                            <form name="commentForm" id="commentForm" action="<?php echo base_url('blog/detail/'.$article['id']);?>#comment-box" method="post">
                                <div id="comment-box">                                    
                                    <p>Comments</p>
                                    <div class="form-group">
                                        <textarea placeholder="Comment Here" name="comment" id="comment" class="form-control"><?php echo set_value('comment');?></textarea>
                                    </div>

                                    <div class="form-group">                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Your Name</label>
                                                <input placeholder="Name" type="text" name="name" id="name" value="<?php echo set_value('name');?>" class="form-control">
                                            </div>
                                        </div>                                        
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                </div>
                            </form> 


                            <?php 
                            if(!empty($comments)){
                                foreach($comments as $comment) {
                            ?>
                            <div class="user-comments mt-3">
                                <p class="text-muted"><strong><?php echo $comment['name']?></strong></p>

                                <p class="font-italic"><?php echo $comment['comment']?></p>

                                <small class="user-comments"><?php echo date('d/m/Y',strtotime($comment['created_at']))?></small>
                            </div>

                            <hr>
                            <?php
                                }
                            }
                            ?>

                        </div>
                        
                    </div>
                </div>
            
        </div>
    </div>
</div>


<?php
$this->load->view('front/footer');
?>