<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-primary">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('edit_term');?></div>						
				</div>
										
				<div class="panel-body">
				
					<?php
						echo form_open(base_url() . 'index.php?admin/school_settings/edit_term/'.$param2 , array('id'=>'frm_term','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));
					?>
					
					<div class="form-group">
						<label class="control-label col-xs-4"><?php echo get_phrase('term_title');?></label>
						
						<div class="col-xs-8">
							<input type="text" class="form-control" id="term" name="term" value="<?php echo $this->db->get_where('terms',array('terms_id'=>$param2))->row()->name;?>"/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-xs-4"><?php echo get_phrase('term_number');?></label>
						
						<div class="col-xs-8">
							<input type="text" class="form-control" id="term_number" name="term_number" value="<?php echo $this->db->get_where('terms',array('terms_id'=>$param2))->row()->term_number;?>"/>
						</div>
					</div>
					

						<div class="col-xs-offset-6 col-xs-6">
							<button type="submit" class="btn btn-primary btn-icon"><i class="entypo-pencil"></i><?php echo get_phrase('edit');?></button>
						</div>

				
				</form>
				</div>
			
		</div>
	</div>
	
</div>