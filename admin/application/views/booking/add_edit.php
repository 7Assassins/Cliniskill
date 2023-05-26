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
        <?php
        if(!empty($this->session->flashdata('flash'))){
            echo $this->session->flashdata('flash');
            unset($_SESSION['flash']);
        }
        ?>
        <form method="POST" action="<?php echo base_url('user/save-booking/'.$booking[0]->b_id);?>">
      <div class="row">
        <div class="input-field col s6">
            <p for="first_name">Check In *</p>
          <input name="b_checkin_time" value="<?php echo $b_checkin_time;?>" type="datetime-local" id="b_checkin_time" class="form-control" readonly>
        </div>

        <div class="input-field col s6">
            <p for="first_name">Check Out *</p>
          <input name="b_checkout_time" value="<?php echo $b_checkout_time;?>" type="datetime-local" id="b_checkout_time" class="form-control" readonly>
        </div>

        <div class="input-field col s6">
            <p for="first_name">Name *</p>
          <input  type="text" value="<?php if(!empty($booking[0]->b_name)){ echo $booking[0]->b_name; }?>" id="" name="b_name" class="form-control" required>
        </div>

        <div class="input-field col s6">
            <p for="first_name">Mobile *</p>
          <input type="text" value="<?php if(!empty($booking[0]->b_mobile)){ echo $booking[0]->b_mobile; }?>" id="" name="b_mobile" class="form-control" required>
        </div>

        <div class="input-field col s6">
            <p for="first_name">Agency Name *</p>
          <input  type="text" value="<?php if(!empty($booking[0]->b_agency_name)){ echo $booking[0]->b_agency_name; }?>" name="b_agency_name" id="b_checkout_time" class="form-control" required>
        </div>
        <div class="input-field col s12">
            <h4>Rooms Availability*</h4><br>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>Room Type</th>
                                            <th>Available Rooms</th>
                                            <th>Room Cost</th>
                                            <th>Enter Rooms to be booked</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 0;
                                        if(!empty($available_rooms)){
                                            $roomcost = 0;
                                          foreach($available_rooms as $row){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo ++$sno;?></td>
                                            <td><?php echo $row->rt_name;?></td>
                                            <td><?php if(($row->rt_number_of_rooms)-($row->rooms_booked)!=0) { echo ($row->rt_number_of_rooms)-($row->rooms_booked); }else{ echo "1"; }?></td>
                                            <td><?php echo $row->rt_cost;?></td>
                                            <input type="hidden" name="rb_room_type_id[]" value="<?php echo $row->rt_id;?>">
                                            <td><select onchange="manipulateTotalAmount(this.value,<?php echo $row->rt_cost;?>);" name="rb_rooms_booked[]" class="form-control roomsBooked">
                                                <?php 
                                                if(($row->rt_number_of_rooms)-($row->rooms_booked)!=0)
                                                {
                                                    $iteration = ($row->rt_number_of_rooms)-($row->rooms_booked);
                                                }
                                                else
                                                {
                                                    $iteration = 1;
                                                }
                                                for($k=0;$k<=$iteration;$k++){?>
                                                    <option <?php for($j=0;$j<count($rooms_booked);$j++){ if($rooms_booked[$j]->rb_room_type_id==$row->rt_id && $k==$rooms_booked[$j]->rb_rooms_booked){ echo "selected"; } }?> value="<?php echo $k;?>"><?php echo $k;?></option>
                                                <?php } ?>
                                                ?>
                                            </select></td>
                                        </tr>
                                      <?php $roomcost = $roomcost+($row->rt_cost*0);
                                      } } ?>
                                        
                                
                                    </tbody>
                                </table>


                            </div>
        <div class="input-field col s6">
            <p for="first_name">Total Amount *</p>
          <input  type="number" readonly name="b_cost" id="totalAmount" value="<?php if(empty($booking)) { echo $roomcost; }else{ echo $booking[0]->b_cost; }?>" class="form-control" required>
        </div>

        <div class="input-field col s6">
            <p for="first_name">Select Discount Type *</p>
            <select name="b_discount_type" id="b_discount_type" onchange="discountManipulation();" class="form-control">
                <option value="0">No Discount</option>
                <option <?php if(!empty($booking[0]->b_discount_type)){ if($booking[0]->b_discount_type==1){ echo "selected"; } }?> value="1">Percentage Discount</option>
                <option value="2">Amount Discount</option>
            </select>
        </div>

        <div class="input-field col s12">
            <p for="first_name">Discount in Percentage or Amount *</p>
          <input  type="number" name="b_discount" id="b_discount" value="<?php if(empty($booking)){ echo $roomcost; }else{ echo $booking[0]->b_discount;} ;?>" class="form-control" required>
        </div>

      </div>


      
       <div class="input-field col s12">
          <button onclick="return validateRoomBokings();" class="waves-effect waves-light btn">Book Now</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    function manipulateTotalAmount(quantity,amount)
    {
        var getDiscount = $("#b_discount").val();
        var getTotalAmount = document.getElementById("totalAmount").value;
        var finalAmount = parseInt(getTotalAmount)+parseInt(quantity*amount);
        if(quantity==0)
        {
            finalAmount = finalAmount-amount;
        }
        document.getElementById("totalAmount").value = finalAmount;
        <?php 
        if(empty($booking)){
        ?>
        localStorage.removeItem("finalAmount");
        <?php } ?>
        localStorage.setItem("finalAmount",finalAmount);
    }
    $(document).ready(function(){
        <?php 
        if(empty($booking)){
        ?>
        localStorage.removeItem("finalAmount");
        <?php }else{?>
        localStorage.removeItem("finalAmount");
        localStorage.setItem("finalAmount",<?php echo $booking[0]->b_cost;?>);
        <?php } ?>
        validateRoomBokings();
        discountManipulation();
    });
    function validateRoomBokings()
    {
        var sum = 0;
        $('.roomsBooked').each(function(){
            sum += parseFloat($(this).val());
        });
        if(sum==0)
        {
            alert("Select atleast one room to register a booking..");
            return false;
        }
        else
        {
            return true;
        }
    }
    $("#b_discount").keyup(function()
        {
            var getTotalAmount = localStorage.getItem("finalAmount");
            var discount_amount = this.value;
            if(discount_amount=='')
            {
                alert("You have entered non numeric value or empty value detected!!");
                location.reload();
            }
            else
            {
                var b_discount_type = $("#b_discount_type").val();
                var finalAmount = 0;
                if(b_discount_type==1)
                {
                    finalAmount = parseInt(getTotalAmount)-(discount_amount*getTotalAmount/100);
                }
                else
                {
                    finalAmount = parseInt(parseInt(getTotalAmount)-parseInt(discount_amount));
                }
                $("#totalAmount").val(finalAmount.toFixed(0));
            }
        });
    function discountManipulation()
    {
        var b_discount_type = $("#b_discount_type").val();
        if(b_discount_type==0){
            $("#b_discount").attr('readonly',true);
            $("#b_discount").val('');
        }
        else{
            <?php 
            if(empty($booking)){
            ?>
            $("#totalAmount").val(localStorage.getItem("finalAmount"));
            $("#b_discount").attr('readonly',false);
            $("#b_discount").val('');
            <?php }else{?>
            $("#totalAmount").val(localStorage.getItem("finalAmount"));
            $("#b_discount").attr('readonly',false);
            $("#b_discount").val(<?php echo $booking[0]->b_discount_amount;?>);
            <?php } ?>
        }
    }
</script>