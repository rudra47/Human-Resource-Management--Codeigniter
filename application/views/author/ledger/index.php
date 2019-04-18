
	 <div id="con_1">
		<span class="breadcrumbs"><i class="fa fa-book"></i> <?php echo $title; ?></span>
	 	<span class="logout"> 
			<a class="btn btn-success" href="<?php echo base_url(); ?>index.php/author/ledger/add/index/<?php echo $this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6); ?>"><i class="fa fa-check"></i> Add</a>
			<a class="btn btn-info" href="javascript:void(0)" onclick="editRecord()"> <i class="fa fa-pencil-square-o"></i> Edit</a>
			<a class="btn btn-danger" href="javascript:void(0)" onclick="deleteRecord()"> <i class="fa fa-times"></i> Delete</a>
		</span>	
	 </div>

	<div id="con_main">
		<div id="filter" style=" float:left; margin-bottom:15px">
		
		
		  <div class="col-sm-4">
		  <?php echo form_open('','class="form-horizontal"'); ?>
		    <div class="input-group">
			
		      <input type="text" class="form-control" name="filter_text" value="<?php echo set_value('filter_text'); ?>" placeholder="Filter...">
		      <span class="input-group-btn">
				 <input class="btn btn-primary" name="submit" type="submit" value=" Go " />
		      </span>
			   </form>
		    </div><!-- /input-group -->
		  </div><!-- /.col-sm-4 -->
  
  
		</div>


		<div class="records">
		<form action="" method="post" name="actionform">
		<span class="successmgs"><?php echo isset($successmgs) ? $successmgs: ''; ?></span>
		<table width="" border="1"  class="sortable">
		  <tr class="tr_stl">
			<td width="3%" class="sorttable_nosort"><input type="checkbox" onClick="toggle(this)" /></td>
			<td width="3%">SL.</td>
			<td width="15%">Title</td>
			<td width="15%">Parent Group</td>
			<td width="12%">Balance</td>
			<td width="10%">Account Type</td>
			<td width="25%">Description</td>
			<td width="15%">Date</td>
			<td width="9%">Status</td>
			<td width="15%">Action</td>
			<td id="5%" >ID</td>
		  </tr>

		  <?php
		  	 $keys=array_keys($this->load->ledger);
			 $result=$this->load->ledger;
			 $i=0;

		  	while($i  < count($keys)):
				echo "<tr>";
				echo "<td align=center><input name='check' type='checkbox' value='".$result[$i]['aca_id']."' /></form></td>";
				echo "<td align=center>".($i+1)."</td>";
				echo "<td><a href=".base_url()."index.php/author/ledger/edit/".$result[$i]['aca_id']."/".$this->uri->segment(4)." rel='facebox'>".$result[$i]['aca_title']."</a></td>";
				//$date=substr($result[$i]['date'], 0, -8);
				foreach ($this->load->group_info->result() as $data) {
				 
					if ($result[$i]['aca_grp_id'] == $data->grp_id) {
						echo "<td>". $data->grp_title."</td>";
						// echo $data->grp_title;
					}

				}

				echo "<td align=center style='' >".$result[$i]['aca_balance']."</td>";
				echo "<td align=center style='' >".$result[$i]['aca_type']."</td>";
				echo "<td align=center style='' >".$result[$i]['aca_note']."</td>";
				echo "<td align=center >".$result[$i]['aca_date']."</td>";
				if($result[$i]['aca_status']==1):
					echo "<td align=center><i class='fa fa-check-circle' aria-hidden='true' style='color:green;font-size:19px'></i></td>";
				elseif($result[$i]['aca_status']==0):
					echo "<td align=center><i class='fa fa-times-circle' aria-hidden='true' style='color:red; font-size:19px'></i></td>";
				endif;

				echo "<td align=center ><a href=". base_url()."index.php/author/ledger/view/". $result[$i]['aca_id']." class='btn btn-primary'> View </a></td>";
				echo "<td align=center style='' >".$result[$i]['aca_id']."</td>";
				
				// echo "<td align=center>".$result[$i]['cat_id']."</td>";
				$i++;
			endwhile;
		   ?>

		</table>
		</form>
		<div id="pagination">
			<?php 
				if(isset($pages_links) && !empty($pages_links)){
				echo $pages_links;
				}
			?>
		</div>
		</div>
	</div>

