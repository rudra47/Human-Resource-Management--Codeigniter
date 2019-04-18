
 
	 <div id="con_1">
		<span class="breadcrumbs"> <i class="fa fa-pencil-square-o"></i> Ledger Manager &rarr; Update Ledger</span>
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
					<label class="col-sm-2 " >Ledger Name: </label>
					<div class='row'>
			            <div class='col-sm-12'>
						<?php echo form_input('name', $this->load->ledger_info->aca_title ,set_value('name'),'class="form-control"'); ?>
			            </div>
		            </div>
		        </div>

		        <?php
					for($i=0; $i<count($this->load->grp); $i++){
						$grp_id[]=$this->load->grp[$i]['grp_id'];
						$grp_title[]=$this->load->grp[$i]['grp_title'];
					}
					$p_grp=array('root'=>'Root')+array_combine($grp_id, $grp_title);
					//array_unshift($cat, 'Select Category');

					// $division=array('other'=>'Other','Science & Technology'=>'Science and Technology', 'Business & Economics'=>'Business and Economics', 'Arts & Social Science'=>'Arts and Social Science');
				?>

	            <div class="form-group" >
					<label class="col-sm-2 " >Parent Group: </label>
					<div class='row'>
			            <div class='col-sm-12'>                
						<?php echo form_dropdown('p_grp', $p_grp, 'Science & Technology','class="form-control"');?>

			            </div>
		            </div>
		        </div>


				<?php
					$val=array('dr'=>'Dr','cr'=>'Cr');
				?>
	            <div class="form-group" >
					<label class=" " >Opening Balance: </label>
		            <div class='row'>                
			            <div class='col-sm-2'>                
						<?php echo form_dropdown('drcr', $val, 'drcr','class="form-control"');?>
			            </div>

			            <div class='col-sm-10'>
						<?php echo form_input('balance', $this->load->ledger_info->aca_balance ,set_value('balance'),'class="form-control"'); ?>
							<p>Note: Assets / Expenses always have Dr balance liabilities / Income always have Cr balance</p>
			            </div>
		            </div>

		        </div>

		        <div class="form-group" >
					
		            <div class='row'>
			            <div class='col-sm-12'>
						<?php echo form_checkbox('aca_bank_cash', 'aca_bank_cash');?>
							<span> Bank or cash account</span>
			            </div>
		            </div>
			            <p>Note: Select if the ledger account is a bank or a cash account</p>
		        </div>

		        <div class="form-group" >
					
		            <div class='row'>
			            <div class='col-sm-12'>
						<?php echo form_checkbox('aca_reconciliation', 'aca_reconciliation');?>
							<span> Reconciliation </span>
			            </div>
		            </div>
		            <p>Note: If selected the ledger account can be reconciled from Report > Reconciliation</p>
		        </div>

		        <div class="form-group" >
					<label class="col-sm-2 " >Description: </label>
		            <div class='row'>
			            <div class='col-sm-12'>
						<?php echo form_textarea('description' , set_value('description'),'class="form-control"');?>

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

