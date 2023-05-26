<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php $this->load->view('user_includes/utilities/page-title');?>
	<?php $this->load->view('user_includes/styles/google-material-font-api.css.php');?>
	<?php $this->load->view('user_includes/styles/materialize.min.css.php');?>
    <?php $this->load->view('user_includes/styles/bootstrap.css.php');?>
    <?php $this->load->view('user_includes/styles/font-awesome.css.php');?>
	<?php $this->load->view('user_includes/styles/custom-styles.css.php');?>
</head>

<body>
    <div id="wrapper">
        <?php $this->load->view('user_includes/navbar');?>
        <?php $this->load->view('user_includes/dropdown-structure');?>
        <?php $this->load->view('user_includes/sidebar');?>
		<div id="page-wrapper">
		  <?php $this->load->view('user_includes/utilities/breadcrumbs');?>
            <div id="page-inner">

			<div class="dashboard-cards"> 
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
					
						<div class="card horizontal cardIcon waves-effect waves-dark">
						<div class="card-image red">
						<i class="fa fa-users"></i>
						</div>
						<div class="card-stacked red">
						<div class="card-content">
						<h3><?php echo $this->db->select('cd_id')->from('certificate_details')->get()->num_rows();?></h3> 
						</div>
						<div class="card-action">
						<strong>Certificates</strong>
						</div>
						</div>
						</div>
	 
                    </div>
                    
                    <div class="col-xs-12 col-sm-6 col-md-3">
					
						<div class="card horizontal cardIcon waves-effect waves-dark">
						<div class="card-image red">
						<i class="fa fa-users"></i>
						</div>
						<div class="card-stacked red">
						<div class="card-content">
						<h3><?php echo $this->db->select('cr_id')->from('certificates_received')->get()->num_rows();?></h3> 
						</div>
						<div class="card-action">
						<strong>Certificates</strong>
						</div>
						</div>
						</div>
	 
                    </div>
                    
                  
                </div>

			   </div>

		
			


				<?php $this->load->view('user_includes/footer');?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <?php $this->load->view('user_includes/scripts/jquery-1.10.2.js.php');?>
	<?php $this->load->view('user_includes/scripts/bootstrap.min.js.php');?>
	<?php $this->load->view('user_includes/scripts/materialize.min.js.php');?>
	<?php $this->load->view('user_includes/scripts/jquery.metisMenu.js.php');?>
	<?php $this->load->view('user_includes/scripts/custom-scripts.js.php');?>
	
</body>
</html>