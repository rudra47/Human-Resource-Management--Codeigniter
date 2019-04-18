
	 <div id="con_1">
		<span class="breadcrumbs"><i class="fa fa-book"></i> <?php echo $title; ?></span>
	 	<span class="logout"> 
			<a class="btn btn-success" href="<?php echo base_url(); ?>index.php/author/category/add/index/<?php echo $this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6); ?>"><i class="fa fa-check"></i> Add</a>
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
					<td width="23%">Description</td>
					<td width="18%">date</td>
					<td width="9%">Status</td>
					<td id="5%" >ID</td>
				  </tr>
				  
				  


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

