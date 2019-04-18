	<div id="con_main">
		</table>
		<form action="" method="post">
		<table width="" border="1"  class="view_table">
		  <tr class="tr_stl" >
			<tr>
				<td width="150"><strong>Title</strong></td>
				<td width=""><strong><?=$this->load->ledger_info->aca_title?></strong></td>
			</tr>

			<tr>
				<td>Ledger</td>
				<td width="" >
					<?php 
					  // 	 $keys=array_keys($this->load->ledger_info->row());
						 // $result=$this->load->ledger_info->row();
					

						if ($this->load->ledger_info->aca_grp_id != 0){
							foreach ($this->load->group_info->result() as $data) {
							 
								if ($this->load->ledger_info->aca_grp_id == $data->grp_id) {
									echo $data->grp_title;
								}
							}
						}else{
							echo "Nothing";
						}
					?>
				</td>
			</tr>

			<tr>
				<td>Account Balance</td>
				<td width="" style="font-size:17px; letter-spacing:1px"><?=$this->load->ledger_info->aca_balance?></td>
			</tr>
			

			<tr>
				<td>Type</td>
				<td width="" style="font-size:17px; letter-spacing:1px"> <?=$this->load->ledger_info->aca_type?> </td>
			</tr>
			<tr>
				<td>Description</td>
				<td width="" ><?=$this->load->ledger_info->aca_note?></td>
			</tr>
			<tr>
				<td>Date</td>
				<td width="" ><?= $this->load->ledger_info->aca_date?></td>
			</tr>
			
		  
		</table>
		</form>
		
	</div>