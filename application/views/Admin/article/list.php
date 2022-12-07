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
            <h1 class="m-0 text-dark">Articles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Articles</li>
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
          <?php
    if(!empty($this->session->flashdata('success')))
    {
        echo"<div class='alert alert-success'>".$this->session->flashdata('success')."</div>";
    }
    
    ?>

<?php
    if(!empty($this->session->flashdata('error')))
    {
        echo"<div class='alert alert-danger'>".$this->session->flashdata('error')."</div>";
    }
    
    ?>
            <div class="card">
            <div class="card-header">
            <div class="card-title">
                <form id="searchfrm" name="searchfrm" method="get" action="">
                    <div class="input-group mb-0">
                        <input type="text" value="<?php echo $q;?>" class="form-control" placeholder="Search" name="q">
                        <div class="input-ground-append">
                            <button class="input-group-text" id="basic-addon1">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-tools">
                <a href="<?php echo base_url().'admin/article/create' ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
            </div>
          </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="50">#</th>
                    <th width="100">Image</th>
                    <th >Title</th>
                    <th width="180">Author</th>
                    <th width="130">Created</th>
                    <th width="70">Status</th>
                    <th width="140" class="text-center">Action</th>
                </tr>
                
                <?php
                if(!empty($articles)){?>
               
                  <?php foreach($articles as $articleRow){ ?>
                
                <tr>
                    <td><?php echo $articleRow['id'];?></td>
                    <td>
                    <?php if($articleRow['image']!="" && file_exists('./public/uploads/articles/thumb_admin/'.$articleRow['image'])){?>
                    <img  class="w-100"  src="<?php echo base_url().'public/uploads/articles/thumb_admin/'.$articleRow['image'];?>">
                    <?php } else{ ?>
                    <img  class="w-100" src="<?php echo base_url().'public/uploads/articles/noimage.png';?>">
                    <?php } ?>

                    </td>
                    <td><?php echo $articleRow['title'];?></td>
                    <td><?php echo $articleRow['author'];?></td>
                    <td><?php echo date('Y-m-d',strtotime($articleRow['created_at']))?></td>
                    <td>
                    <?php if($articleRow['status']==1){?>
                        <span class="badge badge-success">Active</span>
                        <?php } else{?>
                          <span class="badge badge-danger">Inactive</span>
                          <?php }?>
                          
                    </td>
                    <td class="text-center">
                        <a href="<?php echo base_url().'admin/article/edit/'.$articleRow['id'];?>" class= "btn btn-primary btn-sm">
                            <i class="far fa-edit"></i></a>
                        <a href="javascript:void(0);" onclick="deleteArticle(<?php echo $articleRow['id'];?>)" class= "btn btn-danger btn-sm">
                        <i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php }?>
                <?php } else {?>
                  <tr>
                    <td colspan="7">Records Not Found</td>
                </tr>
                   
                  <?php } ?>
            </table>
            <nav>
                      <?php echo $pagination_links?>
                  </nav>
        </div>
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
<script>
  function deleteArticle(id){
    // alert(id);
    if(confirm("Are you sure you want to delete aticle?"))
    {
      window.location.href='<?php echo base_url().'admin/article/delete/';?>'+id;
    }
  }

</script>