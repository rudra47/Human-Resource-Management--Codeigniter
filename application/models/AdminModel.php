<?php
	
	/**
	 * 
	 */
	class AdminModel extends CI_Model
	{
		public function login($email, $password)
		{
			$user = $this->db->where(['user_email'=>$email, 'user_password'=>$password])->get('user');

			if ($user->num_rows()) {
				return $user->row();
			}else{
				return FALSE;
			}
			// return $user;
		}

		public function all_admin(){
			$admin = $this->db->where('role', 2)->get('user');

			return $admin;
		}

		

	}

?>