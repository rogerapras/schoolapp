<?php 
	$edit_data	=	$this->db->get_where('fees_structure' , array(
		'fees_id' => $param2
	))->row();
	
	//print_r($edit_data);
	
	//foreach ($edit_data as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_fees_structure');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/fees_structure/edit/' . $edit_data->fees_id , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
	<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $edit_data->name;?>" autofocus>
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
						
						<div class="col-sm-6">
							<select name="class_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$class = $this->db->get('class')->result_array();
								foreach($class as $row):
									$selected="";
									if($edit_data->class_id===$row['class_id']){
										$selected = "SELECTED";
									}
									?>
                            		<option <?php echo $selected;?> value="<?php echo $row['class_id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div>
						
					</div>                    

					                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('year');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="yr" value="<?php echo $edit_data->yr;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" autofocus>
						</div>
					</div>   
					
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('term');?></label>
                        
						<div class="col-sm-6">
							<!--<input type="text" class="form-control" name="term" value="<?php echo $edit_data->term;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" autofocus>-->
						<select name="term" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$terms = $this->db->get('terms')->result_object();
								foreach($terms as $row):
									$selected="";
									if($edit_data->term==$row->term_number){
										$selected = "SELECTED";
									}
									?>
                            		<option <?php echo $selected;?> value="<?php echo $row->term_number;?>">
										<?php echo $row->name;?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div>
					</div>                 					
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('update');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php //endforeach;?>