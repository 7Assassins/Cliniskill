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
                                        <?php
                                        if(!empty($available_rooms)){
                                            $totalroomsavailable = 0;
                                          foreach($available_rooms as $row){
                                        ?>
                                        <?php $totalroomsavailable = $totalroomsavailable+($row->rt_number_of_rooms-$row->rooms_booked);} } ?>
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
                            Filter using dates*
                            <div class="table-responsive">
                                <?php
                                if(!empty($this->session->flashdata('flash'))){
                                    echo $this->session->flashdata('flash');
                                    unset($_SESSION['flash']);
                                }
                                ?>
                                <form method="POST" action="<?php echo base_url('user/check-available-rooms');?>">

                                    <div class="col-md-3">
                                        
                                        <input onclick="hideAddBookingButton();" type="datetime-local" value="<?php echo $b_checkin_time;?>" id="b_checkin_time" name="b_checkin_time" required class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        
                                        <input onclick="hideAddBookingButton();" type="datetime-local" value="<?php echo $b_checkout_time;?>" id="b_checkout_time" name="b_checkout_time" required class="form-control">
                                    </div>

                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-primary">
                                    <?php if(!empty($b_checkin_time) && !empty($b_checkout_time)){?>
                                    <a <?php if($totalroomsavailable>0){?> href="<?php echo base_url('user/add-booking/'.$b_checkin_time.'/'.$b_checkout_time);?>" <?php }else{?> onclick="alert('No rooms available!!');" <?php } ?> id="bookingBtn" class="btn btn-success">Add Booking</a>
                                    <?php } ?>
                                </div>



                                </form><br><br><br>


                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>Room Type</th>
                                            <th>Available Rooms</th>
                                            <th>Room Cost</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 0;
                                        if(!empty($available_rooms)){
                                            $totalroomsavailable = 0;
                                          foreach($available_rooms as $row){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo ++$sno;?></td>
                                            <td><?php echo $row->rt_name;?></td>
                                            <td><?php echo ($row->rt_number_of_rooms)-($row->rooms_booked);?></td>
                                            <td><?php echo $row->rt_cost;?></td>
                                            
                                        </tr>
                                      <?php $totalroomsavailable = $totalroomsavailable+($row->rt_number_of_rooms-$row->rooms_booked);} } ?>
                                        
                                
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

<script type="text/javascript">
    function hideAddBookingButton()
    {
        document.getElementById("bookingBtn").style.display = 'none';
    }
</script>