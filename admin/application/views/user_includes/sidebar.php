<style>
::-webkit-scrollbar {
  width: 5px;
}

::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
::-webkit-scrollbar-thumb {
  background: red; 
  border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover {
  background: #b30000; 
}
</style>
<nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">

                
                <div style="height:400px; overflow-y:scroll;">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="waves-effect waves-dark" href="<?php echo site_url('user/dashboard');?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>

                    <li>
                        <a class="waves-effect waves-dark" href="<?php echo site_url('user/profile');?>"><i class="fa fa-user"></i> Profile</a>
                    </li>
                    
                    <li>
                        <a href="#" class="waves-effect waves-dark"><i class="fa fa-gear"></i> Issue Certificate<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php 
                                $certificates = $this->db->select('cd_id,cd_name_of_the_certificate')->from('certificate_details')->get()->result();
                                if(!empty($certificates)){
                                    foreach($certificates as $c){
                            ?>
                            <li>
                                <a href="<?php echo site_url('user/certificateform/'.$c->cd_id);?>"><?php echo $c->cd_name_of_the_certificate;?></a>
                            </li>
                            <?php } }?>
                        </ul>
                    </li>
                    
                    

                    <li>
                        <a href="#" class="waves-effect waves-dark"><i class="fa fa-gear"></i> Settings<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo site_url('user/change-password');?>">Change Password</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('user/logout');?>">Logout</a>
                            </li>
                        </ul>
                    </li>
                   
                </ul>
                </div>

            

            </div>

        </nav>