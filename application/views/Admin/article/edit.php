<?php 
$this->load->view('admin/header');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Update Articles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/article/index'?>">Articles</a></li>
              <li class="breadcrumb-item active"> Update Articles</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card-primary">
            <div class="card-header">
            <div class="card-title">
            Update existing articles "<?php  echo $articles['title'];?> "
            </div>
           
          </div>
          <form name="categoryform" id="categoryform" method="post" action="<?php echo base_url().'admin/article/edit/'.$articles['id']?>" enctype="multipart/form-data">
        <div class="card-body">
        <div class="form-group">
    <label>Category</label>
    <select class="form-control <?php echo (form_error('category_id')!="")?'is-invalid':'' ;?>" name="category_id" id="category_id" >

        <option value="">Select a Category</option>
        <?php 
        if(!empty($categories))
        {
           
           foreach( $categories as $row) {
            $selected=($articles['category']==$row['id'])? true :false;
            ?>
            <option <?php echo set_select('category_id',$row['id'],$selected); ?> value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
            <?php
           }
        }
        ?>
    </select>
    <?php  echo form_error('category_id');?>
   
</div>
        <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control <?php echo (form_error('title')!="")?'is-invalid':'' ;?> "  name="title" id="title" value="<?php echo set_value('title',$articles['title']); ?>">
    <?php  echo form_error('title');?>                                                                                                        
</div>
<div class="form-group">
    <label>Description</label>
    <textarea name="description" id="textarea" class="textarea" 
    style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
    <?php echo set_value('description',$articles['description']); ?>
    </textarea>
    
</div>

<div class="form-group">
    <label>Image</label><br>
    <input type="file" class="form-control <?php echo (!empty($errorImageUpload))?'is-invalid':'' ;?>"  name="image" id="image">
   

    <?php  echo (!empty($errorImageUpload))?$errorImageUpload : '';?>
    <?php if($articles['image']!="" && file_exists('./public/uploads/articles/thumb_admin/'.$articles['image'])){?>
<img  class="mt-3"src="<?php echo base_url().'public/uploads/articles/thumb_admin/'.$articles['image'];?>">
        <?php } else{ ?>
            <img  class="mt-3" width="200"src="<?php echo base_url().'public/uploads/articles/noimage.png';?>">
            <?php } ?>
</div>

<div class="form-group">
    <label>Author</label>
    <input type="text" class="form-control <?php echo (form_error('author')!="")?'is-invalid':'' ;?> "  name="author" id="author" value="<?php echo set_value('author',$articles['author']); ?>">
    <?php  echo form_error('author');?>
</div>
<div class="custom-control custom-radio float-left">
<input class="custom-control-input" value="1" type="radio" id="statusActive" name="status" <?php echo($articles['status']==1) ?'checked':'';?>>
    <label for="statusActive" class="custom-control-label">Active</label>

</div>
<div class="custom-control custom-radio float-left ml-3">
<input class="custom-control-input" value="0" type="radio" id="statusBlock" name="status"  <?php echo($articles['status']==0) ?'checked':'';?>>
    <label for="statusBlock" class="custom-control-label">Block</label>

</div>
        
        </div>
        <div class="card-footer">
        <button type="submit" class="btn btn-primary"  name="submit">
                      Submit</button>
                      <a href="<?php echo base_url().'admin/article/index'?>" class="btn btn-secondary">Back</a>
                      </div>      
        </form>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
    </div>
  <!-- /.content-wrapper -->
<?php 
$this->load->view('admin/footer');
?>