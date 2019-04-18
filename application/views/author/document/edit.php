
 <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
 
	<div id="con_1">
		<span class="breadcrumbs"> <i class="fa fa-plus-square"></i><?php echo $title; ?> </span>
	 	<span class="logout"> 
			<a class="btn btn-danger"  href=""> -Cancle</a>
		</span>	
	</div>
	<div id="con_main">
		
		<div id="add_form" >

			<style type="text/css">
				input[type="text"]{
				  color: black;
				  width: 90% !important;
				}
			</style>

			<?php 												
			 	echo form_open_multipart('','class="form-horizontal"'); 				 
			 ?>				
          	<fieldset>
            	<?php echo validation_errors();  ?>	
                
			 	<p class=""><?php echo isset($message) ? $message : ''; ?></p> <p></p><br />
				 

	            <div class="form-group" >
					<!-- <label class="col-sm-2" >Number: </label> -->
		            <div class='row'>

			            <div class='col-sm-2'>
							<input type="text" name="company_name" value="<?php echo $this->load->document->doc_company; ?>" class="form-control">
			            </div> 

			            	
			            <div class='col-sm-2'>
				            <input type="text" list="cars" class="form-control" placeholder="project name" value="<?php echo $this->load->document->doc_project_name; ?>" name="project_name" />
				            <datalist id="cars" name="project_name" >
					        
					            <?php  
					            foreach ($this->load->project_name->result() as $row) {
					            	?>
					            	<option value="<?php echo $row->doc_project_name; ?>"></option> 
					            	<?php
					            }
					            ?>
					            	
				            </datalist>
			            </div>
			            <div class='col-sm-2'>
							<input type="text" name="year" value="<?php echo $this->load->document->doc_year; ?>" class="form-control">
			            </div>
			            <div class='col-sm-2'>
							<input type="text" name="month" value="<?php echo $this->load->document->doc_month; ?>" class="form-control">
			            </div>
			            <div class='col-sm-2 '>
							<select class="form-control" name="type">
								<option value="In" <?php if ( $this->load->document->doc_type == 'In') echo "selected"; ?> >In</option>
								<option value="Out" <?php if ( $this->load->document->doc_type == 'Out') echo "selected"; ?>>Out</option>
							</select>
			            </div>
			            <div class='col-sm-2'>
							<input type="text" name="filename" value="<?php echo $this->load->document->doc_filename; ?>" class="form-control">
			            </div>
		            </div>
		        </div>


				<div class="form-group" >
					<!-- <label class="col-sm-2" >Header: </label> -->
					<div class='row'>
			            <div class='col-sm-12'>
							<textarea name="editor1"><?php echo html_entity_decode($this->load->document->doc_body); ?></textarea>
							<script>
								CKEDITOR.replace( 'editor1' );
							</script>

			            </div>
		            </div>
		        </div>


		        <div class="form-group" >
					<label class="col-sm-2"> Document File </label>
					<div class='row'>
		                <div class='col-sm-3 '>
		    				<?php echo form_input(array('type' => 'file','name' => 'doc_file')); ?>
		                </div>
		            </div>
		        </div>

		        <div class="form-group" >
					<label class="col-sm-2"> Document Status </label>
					<div class='row'>
		                <div class='col-sm-3 '>
		    				<select class="form-control" name="status">
		    					<option value="open" <?php if ($this->load->document->doc_filename == 'open') echo "selected"; ?> >Open</option>
		    					<option value="close" <?php if ($this->load->document->doc_filename == 'close') echo "selected"; ?> >Close</option>
		    				</select>
		                </div>
		            </div>
		        </div>


	    		<div class="form-group" >
					<label class="col-sm-2 control-label" > </label>
					<div class='row'>
			            <div class='col-sm-6'>
			            <?php 
							$submitattr=array('value'=>'Save', 'class'=>'btn btn-default', 'name'=>'submit');
						?>                
						<?php echo form_submit($submitattr,'upload'); ?><br /><br />
			            </div>
			            
		            </div>

		        </div>
			
			</fieldset>
			<?php echo form_close()?> 
		</div>
			
	</div>


<script src="https://cdn.ckeditor.com/[version.number]/[distribution]/ckeditor.js"></script>
