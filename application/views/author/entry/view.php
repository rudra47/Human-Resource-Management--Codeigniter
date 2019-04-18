	<div id="con_main">
		</table>
		<form action="" method="post">
		<table width="" border="1"  class="view_table">
		  <tr class="tr_stl" >
			<tr>
				<td width="150"><strong>Number</strong></td>
				<td width=""><strong><?=$this->load->entry_info->en_num?></strong></td>
			</tr>
			<tr>
				<td>Date</td>
				<td width="" style="font-size:17px; letter-spacing:1px"><?=$this->load->entry_info->en_date?></td>
			</tr>
			

			<tr>
				<td>Description</td>
				<td width="" style="font-size:17px; letter-spacing:1px"> <?=$this->load->entry_info->en_description?> </td>
			</tr>
			<tr>
				<td>Type</td>
				<td width="" ><?=$this->load->entry_info->en_dr_cr?></td>
			</tr>
			<tr>
				<td>Ledger</td>
				<td width="" >
					<?php 
					  // 	 $keys=array_keys($this->load->ledger_info->row());
						 // $result=$this->load->ledger_info->row();
						 $i=0;

						if ($this->load->entry_info->en_aca_id != 0){
							foreach ($this->load->ledger_info->result() as $data) {
							 
								if ($this->load->entry_info->en_aca_id == $data->aca_id) {
									echo $data->aca_title;
								}

								$i++;
							}
						}else{
							echo "Nothing";
						}
					?>
				</td>
			</tr>
			
		  
		</table>
		</form>
		
	</div>