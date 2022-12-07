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
            <h1 class="m-0 text-dark">Dashoard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/category/index'?>">Categories</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
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
              Edit Category "<?php  echo $categories['name'];?> "
            </div>
           
          </div>
          <form name="categoryform" id="categoryform" method="post" action="<?php echo base_url().'admin/category/edit/'.$categories['id'];?>" enctype="multipart/form-data">
        <div class="card-body">
        
<div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control <?php echo (form_error('name')!="")?'is-invalid':'' ;?> "  name="name" id="name" value="<?php echo set_value('name',$categories['name']); ?>">
    <?php  echo form_error('name');?>
</div>
<div class="form-group">
    <label>Image</label><br>
    <input type="file" class="form-control <?php echo (!empty($errorImageUpload))?'is-invalid':'' ;?> "  name="image" id="image" value="<?php echo set_value('image',$categories['image']); ?>">
    <?php  echo (!empty($errorImageUpload))?$errorImageUpload : '';?>
    <?php if($categories['image']!="" && file_exists('./public/uploads/category/thumb/'.$categories['image'])){?>
<img  class="mt-3"src="<?php echo base_url().'public/uploads/category/thumb/'.$categories['image'];?>">
        <?php } else{ ?>
            <img  class="mt-3" width="200"src="<?php echo base_url().'public/uploads/category/noimage.png';?>">
            <?php } ?>
</div>
<div class="custom-control custom-radio float-left">
<input class="custom-control-input" value="1" type="radio" id="statusActive" name="status" <?php echo($categories['status']==1) ?'checked':'';?>>
    <label for="statusActive" class="custom-control-label">Active</label>

</div>
<div class="custom-control custom-radio float-left ml-3">
<input class="custom-control-input" value="0 " type="radio" id="statusBlock" name="status" <?php echo($categories['status']==0) ?'checked':'';?>>
    <label for="statusBlock" class="custom-control-label">Block</label>

</div>
        
        </div>
        <div class="card-footer">
        <button type="submit" class="btn btn-primary"  name="submit">
                      Submit</button>
                      <a href="<?php echo base_url().'admin/category/index'?>" class="btn btn-secondary">Back</a>
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