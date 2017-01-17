<?php

$fees_id = $param2;

?>

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
				
                <?php echo form_open(base_url() . 'index.php?admin/fees_structure_details/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('income_category');?></label>
						
						<div class="col-sm-6">
							<select name="income_category_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$income_categories = $this->db->get('income_categories')->result_array();
								foreach($income_categories as $row):
									?>
                            		<option value="<?php echo $row['income_category_id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div>
						
					</div>                    
 
                    
					<div class="form-group">
						<label for="field-4" class="col-sm-3 control-label"><?php echo get_phrase('amount');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="amount" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>   
					
					
					<!--<div class="form-group">
						<label for="field-5" class="col-sm-3 control-label"><?php echo get_phrase('term');?></label>-->
                        
						<div class="col-sm-6">
							<input type="text" style="display: none;" class="form-control" name="fees_id" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $fees_id;?>" autofocus>
						</div>
					<!--</div>-->                 

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