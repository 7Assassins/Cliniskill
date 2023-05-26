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
    <?php 
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $getGrades = $this->db->select('*')->from('certificate_details')->where('cd_id',$segment)->get()->result();
        $grades = $getGrades[0]->cd_grades;
        $explodeGrades = explode('.#$-',$grades);
        
    ?>
    <div id="wrapper">
        <?php $this->load->view('user_includes/navbar');?>
        <?php $this->load->view('user_includes/dropdown-structure');?>
        <?php $this->load->view('user_includes/sidebar');?>
        <div id="page-wrapper">
          <?php $this->load->view('user_includes/utilities/breadcrumbs');?>
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
             <div class="card">
                        
                        <div class="card-content">
    <form target="_blank" method="POST" action="<?php echo base_url('user/generatecertificate/'.$this->uri->segment(3));?>" class="col s12">
        <?php
        if(!empty($this->session->flashdata('flash'))){
            echo $this->session->flashdata('flash');
            unset($_SESSION['flash']);
        }
        ?>
      <div class="row">
        <div class="input-field col s6">
            <p for="first_name">Candidate Name *</p>
          <input  id="first_name" value="<?php echo set_value('cr_name');?>" name="cr_name" type="text" class="validate">
        </div>
        <div class="input-field col s6">
            <p for="first_name">Registration Number *</p>
          <input id="last_name" value="<?php echo set_value('cr_reg_number');?>" name="cr_reg_number" type="text" class="validate">
        </div>
         <div class="input-field col s6">
            <p for="first_name">Location *</p>
          <input  id="first_name" value="<?php echo set_value('cr_location');?>" name="cr_location" type="text" class="validate">
        </div>
        <div class="input-field col s6">
            <p for="first_name">Date of Completion *</p>
          <input id="last_name" value="<?php echo set_value('cr_date_of_completion');?>" name="cr_date_of_completion" type="date" class="validate">
        </div>
        
        <?php 
            for($i=0;$i<count($explodeGrades);$i++){
        ?>
        
        <div class="input-field col s6">
            <p for="first_name"><?php echo $explodeGrades[$i];?> Grade *</p>
          <input id="last_name" value="<?php if($post_data['grades'][$i]){ echo $post_data['grades'][$i]; };?>" name="grades[]" type="text" class="validate" required>
        </div>
        <?php } ?>
        <div class="input-field col s12">
          <button onclick="return confirm('Are you sure?');" type="submit" class="waves-effect waves-light btn">Submit</button>
        </div>
      </div>
    </form>
    <div class="clearBoth"></div>
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