<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_fees_structure');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/fees_structure/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-6">
							<input type="text" readonly class="form-control" id="name" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
						
						<div class="col-sm-6">
							<select name="class_id" id="class_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$class = $this->db->get('class')->result_array();
								foreach($class as $row):
									?>
                            		<option value="<?php echo $row['class_id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div>
						
					</div>                    
 
                    
					<div class="form-group">
						<label for="field-4" class="col-sm-3 control-label"><?php echo get_phrase('year');?></label>
                        
						<div class="col-sm-6">
							<!--<input type="text" class="form-control" id="yr" name="yr" min="2010" max="2050" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>-->
							<select name="yr" id="yr" class="form-control select2"  required="required">
								<option disabled selected value=""><?=get_phrase('select');?></option>
											<?php 
												$fy = range(date('Y')-5, date('Y')+5);
													
												foreach($fy as $yr):
											?>
												<option value="<?=$yr;?>"><?=$yr;?></option>
											<?php 
												endforeach;
											?>
								</select>
						</div>
					</div>   
					
					
					<div class="form-group">
						<label for="field-5" class="col-sm-3 control-label"><?php echo get_phrase('term');?></label>
                        
						<div class="col-sm-6">
							<!--<input type="text" class="form-control" name="term" id="term" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>-->
							<select class="form-control select2" id="term" name="term">
								<option disabled selected value=""><?=get_phrase('select');?></option>
								<?php
									$terms = $this->db->get('terms')->result_object();
									
									foreach($terms as $tm):
								?>
									<option value="<?php echo $tm->term_number;?>"><?php echo $tm->name;?></option>
								<?php
									endforeach;
								?>
							</select>
						</div>
					</div>                 

                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_fees_structure');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script>
	$('#term').change(function(){
		var class_name = $.trim($('#class_id option:selected').text()).replace(' ','_');
		var yr = $('#yr').val();
		var term = $('#term option:selected').text();
		
		$('#name').val('class_'+class_name+'_term_'+term+'_year_'+yr);
	});
</script>