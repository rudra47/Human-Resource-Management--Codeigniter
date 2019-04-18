
 
	 <div id="con_1">
		<span class="breadcrumbs"> <i class="fa fa-pencil-square-o"></i> Category Manager &rarr; Update Category</span>
	 	<span class="logout"> 
			<a class="btn btn-danger" href="<?php echo base_url(); ?>index.php/author/category"> -Cancle</a>
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
					<label class="col-sm-2" >Number: </label>
		            <div class='row'>
			            <div class='col-sm-12'>
						<?php echo form_input('en_num', $this->load->entry_info->en_num, set_value('en_num'),'class="form-control"'); ?>
			            </div>
		            </div>
		        </div>

	            <?php
    			 	$date=array(
    				'name'=>'date',
    				'id'=>'datepicker',
    				'value'=> $date
    				);
    			 ?>

                <div class="form-group" >
	    			<label class="col-sm-2" >Date: </label>
	    			<div class='row'>
		                <div class='col-sm-12'>
		                
		    			<?php echo form_input('date',$this->load->entry_info->en_date, set_value('date'),'class="form-control"'); ?>
		    			</div>
	    			</div>
	    		</div>
			
	            <div class="form-group" >
	            	<div class='row'>
						<table width="" border="1"  class="sortable">
						  <tr class="tr_stl">
							
							<td width="10%">Dr/Cr</td>
							<td width="23%">Ledger</td>
							<td width="18%">Dr Amount</td>
							<td width="18%">Cr Amount</td>
							<td width="15%">Action</td>
							<td id="5%" >Cur Balance</td>
						  </tr>

						  <tr>
						  	<?php
						  		$drcr=array('br'=>'Br','cr'=>'Cr');
						  	?>
						  	<td>
						  		<?php echo form_dropdown('type', $drcr, 'root', 'class="form-control"' ); ?>
					  		</td>

					  		<?php
				  				for($i=0; $i<count($this->load->ledger); $i++){
				  					$lgr_id[]=$this->load->ledger[$i]['aca_id'];
				  					$lgr_title[]=$this->load->ledger[$i]['aca_title'];
				  				}
				  				$ledger=array_combine($lgr_id, $lgr_title);
				  				//array_unshift($cat, 'Select Category');
				  			
						  		// $ledger=array('br'=>'Br','cr'=>'Cr');

						  	?>
						  	<td>
						  		<?php echo form_dropdown('ledger', $ledger, 'root', 'class="form-control"' ); ?>
					  		</td>
					  		<td>
						  		<?php echo form_input('dr_amount', set_value('dr_amount'),'class="form-control"'); ?>
					  		</td>

					  		<td>
						  		<?php echo form_input('cr_amount', set_value('cr_amount'),'class="form-control"'); ?>
					  		</td>

					  		<td>
						  		<?php echo "<a style='color:green; font-size:15px'><i class='fa fa-plus-square' style='color:green; font-size:15px'></i> Add </a> <a style='color:green; font-size:15px'><i class='fa fa-trash' style='color:green; font-size:15px'></i> delete </a>"; ?>
					  		</td>

					  		<td></td>

						  </tr>
							
						  <tr>
							<td colspan="2">Total</td>
							<td style="background: #ffff66;"></td>
							<td style="background: #ffff66;"></td>
							<td ></td>
							<td ></td>
						  </tr>

						  <tr>
							<td colspan="2">Difference</td>
							<td colspan="2"> - </td>
							<td ></td>
							<td ></td>
						  </tr>

						</table>
					</div>
				</div>

				<div class="form-group" >
					<label class="col-sm-2" >Naration: </label>
					<div class='row'>
			            <div class='col-sm-12'>
						<?php echo form_textarea('description',$this->load->entry_info->en_description, 'class="form-control"');?>

			            </div>
		            </div>
		        </div>

		        <?php
					$tag=array('select'=>'Select','science'=>'Science', 'Technology'=>'Technology', 'arts'=>'Arts');
				?>

		        <div class="form-group" >
					<label class="col-sm-2" >Tag: </label>
					<div class='row'>
			            <div class='col-sm-12'>               
			            	<?php echo form_dropdown('tag', $tag, 'root', 'class="form-control"' ); ?>
			            </div>
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

