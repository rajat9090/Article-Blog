<?php
$this->load->view('front/header');
?>

<div class="container-fluid" style="background-image: url(../public/images/ball-bright-close-up-clouds-207489.jpg);">

    <div class="row">
        
        <div class="col-md-12">
            <h1 class="text-center text-white pt-5">Contact Us</h1>
        </div>


        <div class="container mt-5 pb-5">
            <div class="row">
                <div class="col-md-7">
                    <div class="card mb-5 h-100">
                        <div class="card-header bg-secondary text-white">
                            Have question or comments?
                        </div>
                        <div class="card-body">
                            <?php
                            if (!empty($this->session->flashdata('msg'))) {
                                ?>
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('msg');?>
                                </div>
                                <?php
                            }
                            ?>
                            <form action="<?php echo base_url('page/contact');?>" method="post" id="contact-form" name="contact-form">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input value="<?php echo set_value('name');?>" type="text" name="name" id="name" class="form-control <?php echo (form_error('name') != "") ? 'is-invalid' : '';?>">
                                    <?php echo form_error('name');?>

                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input value="<?php echo set_value('email');?>" type="text" name="email" id="email" class="form-control <?php echo (form_error('email') != "") ? 'is-invalid' : '';?>">
                                    <?php echo form_error('email');?>
                                </div>

                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea name="message" id="message" class="form-control" rows="5"><?php echo set_value('message');?></textarea>
                                </div>

                                <button type="submit" id="submit" class="btn btn-primary">Send</button>   

                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    
                    <div class="card h-100">
                        <div class="card-header bg-secondary text-white">
                            Reach Us
                        </div>

                        <div class="card-body">
                            <p  class="mb-0"><strong>Customer service:</strong></p>
                            <p  class="mb-0">Phone: +91 129 209 XX</p>
                            <p class="mb-0">E-mail: support@mysite.com</p>

                            <p class="pt-3">&nbsp;</p>

                            <p  class="mb-0"><strong>Headquarter:</strong></p>
                            <p  class="mb-0">Company Inc,</p>
                            <p class="mb-0">Las vegas street 201</p>
                            <p class="mb-0">Phone: +91 145 000 XX</p>
                            <p class="mb-0">example@mysite.com</p>

                            <p class="pt-3">&nbsp;</p>

                            <p  class="mb-0"><strong>Headquarter:</strong></p>
                            <p  class="mb-0">Company Inc,</p>
                            <p class="mb-0">Las vegas street 201</p>
                            <p class="mb-0">Phone: +91 145 000 XX</p>
                            <p class="mb-0">example@mysite.com</p>



                        </div>
                    </div>

                </div>            
            </div>    
        </div>
        
    </div>

    
</div>

<?php
$this->load->view('front/footer');
?>