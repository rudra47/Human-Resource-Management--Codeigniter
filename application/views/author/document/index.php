
	<div id="con_1">
		<span class="breadcrumbs"><i class="fa fa-book"></i> <?php echo $title; ?></span>
	 	<span class="logout"> 
			<a class="btn btn-success" href="<?php echo base_url(); ?>index.php/author/document/add/index/<?php echo $this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6); ?>"><i class="fa fa-check"></i> Add</a>
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
					<td width="15%">Project Name</td>
					<td width="5%">Insert Date</td>
					<td width="5%">Manage</td>
					<td width="5%">ID</td>
				  </tr>
				  
				    <?php
				    	$keys=array_keys($this->load->document);
					  	$result=$this->load->document;
					  	$i=0;

					    while($i  < count($keys)):
					  		echo "<tr>";
					  		echo "<td align=center><input name='check' type='checkbox' value='".$result[$i]['doc_id']."' /></form></td>";
					  		echo "<td align=center>".($i+1)."</td>";
					  		echo "<td><a href=".base_url()."index.php/author/document/edit/".$result[$i]['doc_id']."/".$this->uri->segment(4)." rel='facebox'>".$result[$i]['doc_project_name']."</a></td>";
					  		//$date=substr($result[$i]['date'], 0, -8);
					  		echo "<td align=center style='' >".$result[$i]['insert_date']."</td>";
					  		
					  		echo "<td align=center ><a href=". base_url()."index.php/author/document/view/". $result[$i]['doc_id']." class='btn btn-primary'> View </a></td>";
					  			
					  		echo "<td align=center>".$result[$i]['doc_id']."</td>";
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

