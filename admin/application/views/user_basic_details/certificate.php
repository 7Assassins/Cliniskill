<!DOCTYPE html>
<html lang="en">

<head>
    <title>Certificate</title>
    <link rel="stylesheet" href="<?php echo base_url();?>certificate_assets/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>certificate_assets/fonts/style.css">
</head>
<style>
    @media print {
  #printPageButton {
    display: none;
  }
}
</style>

<body>
<?php 
    $certificateDetails = $this->db->select('*')->from('certificate_details')->where('cd_id',$this->uri->segment(3))->get()->result();
    $c1 = explode('.#$-',$certificateDetails[0]->cd_grades);
    $candidateDetails = $this->db->select('*')->from('certificates_received')->where('cr_id',$details['candidate_id'])->get()->result();
    $c2 = explode('.#$-',$candidateDetails[0]->grades);
?>

<center><button id="printPageButton" onClick="window.print();">Print</button></center>
    <div class="certificate">
        <!-- <img src="assets/im" alt=""> -->
        <div class="content">
            <h3 style="font-family: 'Minion Pro Regular';"><?php echo $certificateDetails[0]->cd_name_of_the_certificate;?></h3>
            <br>
            <center>
            <span><strong>NAME :</strong> <strong style="border-bottom: 1px dotted #000;"><?php echo strtoupper($details['cr_name']);?></strong></span>
            </center>
            <br>
            <p><?php echo $certificateDetails[0]->cd_description;?></p>
            <br>
            <div class="rg-loc-date">
            <p><strong>Registration Number </strong> : <?php echo $details['cr_reg_number'];?></p>
            <p><strong>Location </strong>: <?php echo $details['cr_location'];?></p>
            <p><strong>Date of Completion </strong>: <?php echo Date('d-m-Y',strtotime($details['cr_date_of_completion']));?>
            </div>
            
            <br>
            <h3 style="text-align: left;">GRADES : </h3>
           <br>
           <div class="grades">
            <?php 
                for($i=0;$i<count($c1);$i++){
            ?>        
            <p><strong><?php echo $c1[$i];?></strong> :<strong><?php echo $c2[$i];?></strong></p> 
            <?php } ?>
            </div>      
            <br>
            <br>
            <div class="date-signature">
                <p style="font-weight: bold;">Date</p>
                <p style="margin-top: 25px; font-family: 'Alex Brush', cursive; font-weight: bold;">Signature of Authorized Officer</p>
            </div>
        </div>
    </div>
</body>

</html>