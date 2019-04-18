<?php 
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class HolidayModel extends CI_Model {
		
		function store_holiday($data){
			if ($this->db->insert("office_holiday", $data)) {
				return TRUE;
			}else{
				return FALSE;
			}
		}

		function holiday_all_data(){
			$this->db->select('*');
			$this->db->from('office_holiday');
			$this->db->join('user', 'office_holiday.admin_id = user.user_id');
			$this->db->where('holiday_status', 1);
			
			$holiday_all = $this->db->get();

			return $holiday_all;
		}

		function fatch_single_data_holiday($id){
			$holiday = $this->db->where('holiday_id', $id)->get('office_holiday');

			return $holiday;
		}

		function update_holiday($id, $data){
			if($this->db->where('holiday_id', $id)->update("office_holiday", $data)){
				return true;
			}else{
				return false;
			}
		}

		function delete_holiday($id){
			$this->db->where('holiday_id', $id)->delete('office_holiday');
		}


		function holiday_range_tomorrow($tomorrow_date){
			$tomorrow = $this->db->where('holiday_date', $tomorrow_date)->get('office_holiday');
			return $tomorrow->row();
		}


		
	
	}
	
	/* End of file HolidayModel.php */
	/* Location: ./application/models/HolidayModel.php */

?>