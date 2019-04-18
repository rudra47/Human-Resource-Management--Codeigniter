
 
	 <div id="con_1">
		<span class="breadcrumbs"> <i class="fa fa-plus-square"></i><?php echo $title; ?> </span>
	 	<span class="logout"> 
			<a class="btn btn-danger"  href="<?php echo base_url()?>index.php/author/<?php echo $parent_page; ?>"> -Cancle</a>
		</span>	
	 </div>
	<div id="con_main">
		
		<div id="add_form">
			<?php 												
			 	echo form_open('','class="form-horizontal"'); 				 
			 ?>				
          <fieldset>
            	<?php echo validation_errors(); 	 ?>	
                
			 <p class=""><?php echo isset($message) ? $message : ''; ?></p> <p></p><br />
			 <?php
			 	$date=array(
				'name'=>'date',
				'id'=>'datepicker',
				'value'=> $date
				);
			 ?>
            <div class="form-group" >
			<label class="col-sm-2 control-label" >*Date: </label>
            <div class='col-sm-6'>
            
			<?php echo form_input($date, set_value('date'),'class="form-control"'); ?>
			</div></div>
			
            <div class="form-group" >
			<label class="col-sm-2 control-label" >*Title: </label>
            <div class='col-sm-6'>
			<?php echo form_input('title', set_value('title'),'class="form-control"'); ?>
            </div></div>


            <div class="form-group" >
			<label class="col-sm-2 control-label" >*Alias: </label>
            <div class='col-sm-6'>
			<?php echo form_input('alias', set_value('alias'),'class="form-control"'); ?>
            </div></div>


			<?php
				$division=array('other'=>'Other','Science & Technology'=>'Science and Technology', 'Business & Economics'=>'Business and Economics', 'Arts & Social Science'=>'Arts and Social Science');
			?>
            <div class="form-group" >
			<label class="col-sm-2 control-label" >*Division: </label>
            <div class='col-sm-6'>                
			<?php echo form_dropdown('division', $division, 'Science & Technology','class="form-control"');?>

            </div></div>


				<?php
					for($i=0; $i<count($this->load->cat); $i++){
						$c_id[]=$this->load->cat[$i]['cat_id'];
						$c_title[]=$this->load->cat[$i]['cat_title'];
					}
					$cat=array('root'=>'Root')+array_combine($c_id, $c_title);
					//array_unshift($cat, 'Select Category');
				?>
            <div class="form-group" >
			<label class="col-sm-2 control-label" >*Parent: </label>
            <div class='col-sm-6'>
			<?php echo form_dropdown('parent', $cat, 'root', 'class="form-control"' ); ?>
            </div></div>

                          

            <div class="form-group" >
			<label class="col-sm-2 control-label" >Description: </label>
            <div class='col-sm-6'>
			<?php echo form_textarea('description', set_value('description'),'class="form-control"');?>

            </div></div>

			
			<?php
				$status=array(''=>'Select Status', 'active'=>'Active', 'inactive'=>'Inactive');
			?>
            <div class="form-group" >
			<label class="col-sm-2 control-label" >*Status: </label>
            <div class='col-sm-6'>                
			<?php echo form_dropdown('status', $status, 'active','class="form-control"');?>

            </div></div>

			
            <div class="form-group" >
			<label class="col-sm-2 control-label" > </label>
            <div class='col-sm-6'>
            <?php 
				$submitattr=array('value'=>'Save', 'class'=>'btn btn-default');
			?>                
			<?php echo form_submit($submitattr); ?><br /><br />
            </div></div>

			
			</fieldset>
			<?php echo form_close()?> 
		</div>
			
					
	</div>
