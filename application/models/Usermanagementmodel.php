<?php
class Usermanagementmodel extends CI_Model{
	
    function usermanagement_view(){
        $hasil=$this->db->get('user_management');
        return $hasil->result();
    }
 	    function usermanagement_edit(){

        $id = $this->input->post('user_id'); 

		$this->db->where('user_id', $id);
		$hasil=$this->db->get('roll_management');
        return $hasil->result();
    }
 	
    function usermanagement_save(){

	
        $dscdate = $this->input->post('dscdate'); 
		$dscdate = date("Y-m-d", strtotime($dscdate));
        $data = array(
                'user_name'  =>  $this->input->post('username'), 
                'user_id'  =>    $this->input->post('userid'), 
                'password'  =>   $this->input->post('password'), 
               'designation' => strtoupper($this->input->post('designation')), 
            );
        $result=$this->db->insert('user_management',$data);
		
		$insert_id = $this->db->insert_id();
		
		
			$dashboard = $this->input->post('dashboard');
			$master = 	 $this->input->post('master');
			$setup = 	 $this->input->post('setup');
			$entry = 	 $this->input->post('entry');
			$report = 	 $this->input->post('report');
			$utility = 	 $this->input->post('utility');
			$todolist =  $this->input->post('todolist');
			$convert = 	 $this->input->post('convert');

//			$dmenu = explode(',',$dashboard);
//			$dcount = count($dmenu)-1;
			for($i=1;$i<=8;$i++){

			if($i == 1){ $sub_menu = $dashboard; } 	
			if($i == 2){ $sub_menu = $master; } 	
			if($i == 3){ $sub_menu = $setup; } 	
			if($i == 4){ $sub_menu = $entry; } 	
			if($i == 5){ $sub_menu = $report; } 	
			if($i == 6){ $sub_menu = $utility; } 	
			if($i == 7){ $sub_menu = $todolist; } 	
			if($i == 8){ $sub_menu = $convert; } 	
					
			if(trim($sub_menu)!=""){
			
        $data1 = array(
                'user_id'  =>    $insert_id, 
                'menu'  =>   $i, 
               'access' => $sub_menu, 
            );
        $result1=$this->db->insert('roll_management',$data1);
			}
		}
        return $result;
		
    }
	
	function usermanagement_update(){

		$id			=$this->input->post('id');
                $user_name  = $this->input->post('username'); 
                $user_id = $this->input->post('userid'); 
                $password  = $this->input->post('password'); 
                $designation = $this->input->post('designation'); 
    
        $this->db->set('user_name', $user_name);
        $this->db->set('user_id', $user_id);
        $this->db->set('password', $password);
        $this->db->set('designation', strtoupper($designation));
        $this->db->where('id', $id);
        $result=$this->db->update('user_management');
		
				
		$insert_id = $id;
		
		
			$dashboard = $this->input->post('dashboard');
			$master = 	 $this->input->post('master');
			$setup = 	 $this->input->post('setup');
			$entry = 	 $this->input->post('entry');
			$report = 	 $this->input->post('report');
			$utility = 	 $this->input->post('utility');
			$todolist =  $this->input->post('todolist');
			$convert = 	 $this->input->post('convert');

//			$dmenu = explode(',',$dashboard);
//			$dcount = count($dmenu)-1;
			for($i=1;$i<=8;$i++){

			if($i == 1){ $sub_menu = $dashboard; } 	
			if($i == 2){ $sub_menu = $master; } 	
			if($i == 3){ $sub_menu = $setup; } 	
			if($i == 4){ $sub_menu = $entry; } 	
			if($i == 5){ $sub_menu = $report; } 	
			if($i == 6){ $sub_menu = $utility; } 	
			if($i == 7){ $sub_menu = $todolist; } 	
			if($i == 8){ $sub_menu = $convert; } 	
					
			if(trim($sub_menu)!=""){
			
        $data1 = array(
                'user_id'  =>    $insert_id, 
                'menu'  =>   $i, 
               'access' => $sub_menu, 
            );
        $result1=$this->db->insert('roll_management',$data1);
			}
		}

		
		
		
		
		
        return $result;
    }
	
    function usermanagement_delete(){
        $id =$this->input->post('id');
        $this->db->where('id', $id);
        $result=$this->db->delete('user_management');
        return $result;
    }
	
    function rollmanagement_delete(){
        $id =$this->input->post('id');
        $this->db->where('user_id', $id);
        $result=$this->db->delete('roll_management');
        return $result;
    }
	
 function check_login(){
        $user_id =$this->input->post('user_id');
        $password =$this->input->post('password');
        $company =$this->input->post('company_name');
$msg = 0;	 
			$this->db->select(['user_name','password','user_id','id']);    
			$this->db->from('user_management');
			$this->db->where('user_id', $user_id);
			$this->db->where('password', $password);
			$query = $this->db->get();

			if($query->num_rows()>0){
			
			$get_user_id = $query->row()->user_id;
			$get_password = $query->row()->password;
			$get_id = $query->row()->id;
			
				if(($get_user_id==$user_id)&&($get_password==$password)){
					
					$msg = 1;
//					$this->session->userdata('user_id',$user_id);
					$this->session->userid = $get_id;
					$this->session->company_id = $company;
				}
			
			}
//		echo $_SESSION['userid'];
			return $msg;
			
       }
	
 function get_access(){
//	$result		
			if(isset($_SESSION['userid'])){
						$this->db->where('user_id',$_SESSION['userid']);
						$hasil=$this->db->get('roll_management');
						return $hasil->result();
				
			}
			
       }
	
 function check_access($menu_id,$sub_menu_id){
//			if(isset($_SESSION['userid'])){
	
					$result = $this->db->query('select id from roll_management where user_id="'.$_SESSION['userid'].'" and menu="'.$menu_id.'" and  access like "%'.$sub_menu_id.',%" ');
					return $result->num_rows();
				
//			}
			
			
       }
	
}
?>