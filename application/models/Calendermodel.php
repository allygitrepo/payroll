<?php
class calendermodel extends CI_Model{
	
 	    function calender_show(){
        $getdata=$this->db->get('calender_master');
        return $getdata->result();
    }

	function calender_save(){
	
        $holiday_date = $this->input->post('holiday_date'); 
		$holiday_date = date("Y-m-d", strtotime($holiday_date));

	
        $data = array(
                'holiday_type'  => $this->input->post('holidaytype'), 
                'holiday_date' => $holiday_date, 
                'week_day'  => $this->input->post('weekdays'), 
                'year'  => $this->input->post('years'), 
                'remark' => $this->input->post('remark'), 
            );
		$result=$this->db->insert('calender_master',$data);
	return $result;
   
	}
		function calender_update(){

		$id = $this->input->post('id');

        $holiday_date = $this->input->post('holiday_date'); 
		$holiday_date = date("Y-m-d", strtotime($holiday_date));

	
                $holiday_type  = $this->input->post('holidaytype'); 
                $holiday_date = $holiday_date; 
                $week_day  = $this->input->post('weekdays'); 
                $year  = $this->input->post('years'); 
                $remark = $this->input->post('remark'); 
           
        $this->db->set('holiday_type', $holiday_type);
        $this->db->set('holiday_date', $holiday_date);
        $this->db->set('week_day', $week_day);
        $this->db->set('year', $year);
        $this->db->set('remark', $remark);
        $this->db->where('id', $id);
        $result=$this->db->update('calender_master');
	return $result;
   
	}
	
	    function calender_delete(){
        $id =$this->input->post('id');
        $this->db->where('id', $id);
        $result=$this->db->delete('calender_master');
        return $result;
    }


}	
?>