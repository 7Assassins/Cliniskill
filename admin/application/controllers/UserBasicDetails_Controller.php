<?php
ob_start();
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
class UserBasicDetails_Controller extends CI_Controller
{
	public function __construct()
	{
		parent :: __construct();
		date_default_timezone_set('Asia/Kolkata');
	}
	function index()
	{
		$this->load->view('user_basic_details/login');
	}
	function Auth()
	{
		check_request_method($_SERVER['REQUEST_METHOD'],'POST');
		$this->form_validation->set_rules('ubd_email_mobile','Email / Mobile','required');
		$this->form_validation->set_rules('ubd_password','Password','required');
		if($this->form_validation->run()==FALSE)
		{
			get_flash_message('Email/Mobile and Password are mandatory',0);
		}
		else
		{
			$ubd_email_mobile = $this->input->post('ubd_email_mobile');
			$ubd_password = hash('sha512',$this->input->post('ubd_password'));
			$select = 'ubd_id,ubd_name';
			$where  = "(ubd_email=? OR ubd_mobile=?) AND ubd_password=? AND ubd_status=?";
			$params = [$ubd_email_mobile,$ubd_email_mobile,$ubd_password,1];
			$dbResult = $this->UserBasicDetails->SelectWhere($select,$where,$params);
			if(empty($dbResult))
			{
				get_flash_message('Invalid Credentials',0);
			}
			else
			{
				unsetRequiredSessions(['ubd_id','ubd_name']);
				$sessionArr = array('ubd_id' => $dbResult[0]->ubd_id, 'ubd_name' => $dbResult[0]->ubd_name);
				$this->session->set_userdata($sessionArr);
				redirect('user/dashboard');
			}
		}
		$this->LoginPage();
	}
	function dashboard()
	{
		__is_user_logged();
		$pageData = [
            'title'         =>      'Admin Dashboard',
            'breadcrumbs'   =>      ['Dashboard','Home','Dashboard','Data']
        ];
		$this->load->view('user_basic_details/dashboard',$pageData);
	}
	function changePasswordPage()
	{
		__is_user_logged();
		$pageData = [
            'title'         =>      'Change Password',
            'breadcrumbs'   =>      ['Change Password','Home','Change Password','Form'],
        ];
		$this->load->view('user_basic_details/change_password',$pageData);
	}
	function updatePassword()
	{
		__is_user_logged();
		check_request_method($_SERVER['REQUEST_METHOD'],'POST');
		$this->form_validation->set_rules('ubd_old_password','Old Password','required');
		$this->form_validation->set_rules('ubd_new_password','New Password','required|matches[ubd_confirm_password]|min_length[8]|max_length[15]');
		$this->form_validation->set_rules('ubd_confirm_password','Confirm Password','required|matches[ubd_new_password]|min_length[8]|max_length[15]');
		if($this->form_validation->run()==FALSE)
		{
			get_flash_message('Old Password, New Password, Confirm Password fields are required. New Password and Confirm Password should be same and length should be minimum 8 characters!!',0);
		}
		else
		{
			$ubd_old_password = $this->input->post('ubd_old_password');
			$ubd_new_password = $this->input->post('ubd_new_password');
			$ubd_confirm_password = $this->input->post('ubd_confirm_password');
			$ubd_id = $this->session->userdata('ubd_id');
			$selectOne = 'ubd_password';
			$whereOne = 'ubd_id=? AND ubd_password=? AND ubd_status=?';
			$paramsOne = [$ubd_id,hash('sha512',$ubd_old_password),1];
			$dbResultOne = $this->UserBasicDetails->SelectWhere($selectOne,$whereOne,$paramsOne);
			if(empty($dbResultOne))
			{
				get_flash_message('Old Password is incorrect!!',0);
			}
			else
			{
				$setTwo = 'ubd_password=?';
				$whereTwo = 'ubd_id=?';
				$paramsTwo = [hash('sha512',$ubd_new_password),$ubd_id];
				$this->UserBasicDetails->SetWhere($setTwo,$whereTwo,$paramsTwo);
				get_flash_message('Password changed Successfully!!',1);
				redirect('user/change-password');
			}
		}
		$this->changePasswordPage();
	}
	function logout()
	{
		unsetRequiredSessions(['ubd_id','ubd_role_id','ubd_name']);
		redirect('user/login');
	}
	function editProfile($post_data=array())
	{
		__is_user_logged();
		$ubd_id = $this->session->userdata('ubd_id');
		$selectOne = 'ubd_name,ubd_email,ubd_mobile';
		$whereOne = 'ubd_id=?';
		$paramsOne = [$ubd_id];
		$dbResultOne = $this->UserBasicDetails->SelectWhere($selectOne,$whereOne,$paramsOne);
		$pageData = [
            'title'         =>      'Edit Profile',
            'breadcrumbs'   =>      ['Edit Profile','Home','Edit Profile','Form'],
            'edit'			=>		$dbResultOne
        ];
        if(!empty($post_data))
        {
        	$pageData['edit'] = $post_data;
        }
		$this->load->view('user_basic_details/edit_profile',$pageData);
	}
	function updateProfile()
	{
		__is_user_logged();
		$ubd_id = $this->session->userdata('ubd_id');
		check_request_method($_SERVER['REQUEST_METHOD'],'POST');
		$this->form_validation->set_rules('ubd_name','Name','required|regex_match[/^[a-zA-Z ]*$/]|min_length[2]|max_length[70]');
		$this->form_validation->set_rules('ubd_email','Email','required|valid_email');
		$this->form_validation->set_rules('ubd_mobile','Mobile','required|min_length[10]|max_length[13]|numeric');
		if($this->form_validation->run()==FALSE)
		{
			get_flash_message('All fields are mandatory',0);
			$this->editProfile($this->input->post());
		}
		else
		{	
			$ubd_name = $this->input->post('ubd_name');
			$ubd_email = $this->input->post('ubd_email');
			$ubd_mobile = $this->input->post('ubd_mobile');
			$setOne = 'ubd_name=?, ubd_email=?, ubd_mobile=?';
			$whereOne = 'ubd_id=?';
			$paramsOne = [$ubd_name,$ubd_email,$ubd_mobile,$ubd_id];
			$updateResponse = $this->UserBasicDetails->SetWhere($setOne,$whereOne,$paramsOne);
			if($updateResponse==1062)
			{
				get_flash_message('Email / Mobile Already Exists!!',0);
			}
			else
			{
				get_flash_message('Profile updated Successfully!!',1);
			}
			unsetRequiredSessions(['ubd_name']);
			$this->session->set_userdata('ubd_name',$ubd_name);
			$this->editProfile();
		}
	}
	function certificateform($cd_id, $post_data=[])
	{
	    	__is_user_logged();
    		$pageData = [
                'title'         =>      'Certificate Details',
                'breadcrumbs'   =>      ['Certificate Details','Home','Certificate Details','Form'],
                'post_data'     =>      $post_data
            ];
    		$this->load->view('user_basic_details/certificateform',$pageData);
	}
	function generatecertificate($cd_id)
	{
	    __is_user_logged();
	    $this->form_validation->set_rules('cr_name','Name of the Candidate','required|max_length[200]');
	    $this->form_validation->set_rules('cr_reg_number','Registration Number','required|max_length[200]');
	    $this->form_validation->set_rules('cr_location','Location','required|max_length[200]');
	    $this->form_validation->set_rules('cr_date_of_completion','Date of Completion', 'required|max_length[200]');
	   // $this->form_validation->set_rules('grades','grades','required|max_length[200]');
	    if($this->form_validation->run()==FALSE)
	    {
	        get_flash_message('All fields are required *',0);
	        $this->certificateform($cd_id,$_POST);
	    }
	    else
	    {
	        $grades = implode('.#$-',$this->input->post('grades'));
	        $insert = array('cr_certificate_id' => $cd_id, 'cr_name' => $this->input->post('cr_name'), 'cr_reg_number' => $this->input->post('cr_reg_number'), 'cr_location' => $this->input->post('cr_location'), 'cr_date_of_completion' => $this->input->post('cr_date_of_completion'),'grades' => $grades, 'cr_created_at' => Date('Y-m-d H:i:s'));
	        $this->db->insert('certificates_received',$insert);
	        $candidate_id = $this->db->insert_id();
	        $insert['candidate_id'] = $candidate_id;
	        $this->load->view('user_basic_details/certificate',['details' => $insert]);
	    }
	}
}
?>