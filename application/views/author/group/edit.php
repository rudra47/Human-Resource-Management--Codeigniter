
 
	 <div id="con_1">
		<span class="breadcrumbs"> <i class="fa fa-pencil-square-o"></i> Category Manager &rarr; Update Category</span>
	 	<span class="logout"> 
			<a class="btn btn-danger" href="<?php echo base_url(); ?>index.php/author/group"> -Cancle</a>
		</span>	
	 </div>
	<div id="con_main">
		<div id="add_form">
			<style type="text/css">
				input[type="text"]{
				  color: black;
				  width: 100% !important;
				}
			</style>

			<?php //echo validation_errors(); ?>
			<?php echo form_open('','class="form-horizontal"'); ?>	

          <fieldset>
            <?php echo validation_errors(); 	 ?>	
                                			
			 <p class=""><?php echo isset($message) ? $message : ''?></p> <p></p><br />


          	<div class="form-group" >
  				      <label class="col-sm-2 control-label" >*Group Name: </label>
                <div class='col-sm-6'>
          				<?php 
          				echo form_input('grp_title', $this->load->grp_info->grp_title, set_value('grp_title'), 'class="form-control"'); 
          				?>
                </div>
            </div>

            <?php
              	for($i=0; $i<count($this->load->grp); $i++){
              		$grp_id[]=$this->load->grp[$i]['grp_id'];
              		$grp_title[]=$this->load->grp[$i]['grp_title'];
              	}
              	if (isset($grp_id)) {
  	            	$grp=array('Select Group')+array_combine($grp_id, $grp_title);
              	}else{
  	            	$grp=array('Select Group');

              	}
              	// array_unshift($grp, 'Select Group');


  			?>

            <div class="form-group" >
  				<label class="col-sm-2 control-label" >Parent Group: </label>
  	            <div class='col-sm-6'>                
  				<?php echo form_dropdown('grp_parent', $grp, 'active',
  				'class="form-control"');?>

  	            </div>
  	        </div>

			
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

