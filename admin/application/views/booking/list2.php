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
                <div class="row">
                    <div class="col-lg-12">
             <div class="card">
                        
                        <div class="card-content">
                            Filter using Mobile Number*
                            <div class="table-responsive">
                                <?php
                                if(!empty($this->session->flashdata('flash'))){
                                    echo $this->session->flashdata('flash');
                                    unset($_SESSION['flash']);
                                }
                                ?>
                                <form method="POST" action="<?php echo base_url('user/filter-bookings');?>">

                                    <div class="col-md-3">
                                        
                                        <input type="number" value="<?php if(!empty($b_mobile)) { echo $b_mobile; }?>" id="" name="b_mobile" required class="form-control">
                                    </div>


                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-primary">
                                    
                                </div>



                                </form><br><br><br>


                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Checkin</th>
                                            <th>Checkout</th>
                                            <th>Cost</th>
                                            <th>Due</th>
                                            <th>Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 0;
                                        if(!empty($bookings)){
                                          foreach($bookings as $row){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo ++$sno;?></td>
                                            <td><?php echo $row->b_name;?></td>
                                            <td><?php echo $row->b_mobile;?></td>
                                            <td><?php echo $row->b_checkin_time;?></td>
                                            <td><?php echo $row->b_checkout_time;?></td>
                                            <td><?php echo $row->b_cost;?></td>
                                            <td><?php echo $row->b_due;?></td>
                                            <td>
                                                <div class="btn-group">
                                              <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Actions <span class="caret"></span></button>
                                              <ul class="dropdown-menu">
                                              <li><a href="<?php echo base_url('user/edit-booking/'.str_replace(' ','T',$row->b_checkin_time).'/'.str_replace(' ','T',$row->b_checkout_time).'/'.$row->b_id);?>">Edit</a></li>
                                              <li><a onclick="return confirm('Are you sure?');" href="<?php echo base_url('user/delete-booking/'.$row->b_id);?>">Delete / Cancel</a></li>
                                              </ul>
                                            </div>
                                            </td>
                                            
                                        </tr>
                                      <?php } } ?>
                                        
                                
                                    </tbody>
                                </table>
                            </div>
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
    
    <?php $this->load->view('user_includes/scripts/datatables.js.php');?>
    <!-- Custom Js -->
    <?php $this->load->view('user_includes/scripts/custom-scripts.js.php');?> 
</body>
</html>