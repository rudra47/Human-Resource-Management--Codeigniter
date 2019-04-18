
	 <div id="con_1">
		<span class="breadcrumbs"> <i class="fa fa-plus-square"></i> Category Manager &rarr; Category Deletion</span>
	 	<span class="logout"> 
			<a href="<?php echo base_url(); ?>index.php/author/category" class="btn btn-danger"> -Cancle</a>
		</span>	
	 </div>
	
	<div id="con_main">
			
			<div id="add_form">
				<?php 												
				 	echo form_open(); 				 
				 ?>				
              <fieldset>
                <legend>Deleting Category</legend>
                	<?php echo validation_errors(); 	 ?>				             
				
                <div class="form-group" >
				<label class="col-sm-2 control-label" ><strong>Do you want to Delete? </strong> </label>
                <div class='col-sm-6'>
				<?php echo form_hidden('id', $idtodel[0]['cat_id']); ?>
				            
                <?php 
					$submitattr=array('value'=>'Yes', 'class'=>'btn btn-danger');
				?>                
				<?php echo form_submit($submitattr); ?>
                <a href="<?php echo base_url(); ?>index.php/author/article" class="btn btn-default"> No</a>
                <br /><br />
                </div></div>
				
				</fieldset>
				<?php echo form_close(); ?> 
			</div>
			
					
	</div>

