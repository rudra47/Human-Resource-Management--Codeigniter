	<div id="con_main">
		</table>
		<div class="box">
				
			<div style="padding: 40px; font-size: 15px;">
				<div style="width: 85%; float: left;">
					<table> 
						<tr>
							<td><?php echo $this->load->document->doc_company.'/' ?> </td>
							<td><?php echo $this->load->document->doc_project_name ?> / </td>
							<td><?php echo $this->load->document->doc_year ?> / </td>
							<td><?php echo $this->load->document->doc_month ?> / </td>
							<td>EN - <?php echo $this->load->document->doc_filename ?> </td>
							
						</tr>
					</table>
				</div>
				<span align="right" style="width: 15%; float: left;"><?php echo $this->load->document->insert_date; ?></span>
				<br>

				<?php  
				echo html_entity_decode($this->load->document->doc_body);
				?>
				<br><br>

				<p> Document Status : <span class="text-success"><?php echo $this->load->document->doc_status; ?></span></p>
				
			</div>

			<br>
		</div>
		
	</div>