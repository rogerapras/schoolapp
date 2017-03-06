<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="fa fa-tasks"></i>
					<?php echo get_phrase('new_contra_entry');?>
            	</div>
            </div>
			<div class="panel-body">
				
				<?php echo form_open(base_url() . 'index.php?admin/contra_entry/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
				
				<div class="form-group">
					<label for="" class="control-label col-sm-4"><?=get_phrase('description');?></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="description" id="description"/>
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="control-label col-sm-4"><?=get_phrase('date');?></label>
					<div class="col-sm-8">
						<input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" readonly="readonly" name="t_date" id="t_date"/>
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="control-label col-sm-4"><?=get_phrase('entry_type');?></label>
					<div class="col-sm-8">
						<select class="form-control select2" name="entry_type" id="entry_type">
							<option value=""><?=get_phrase('select');?></option>
							<option value="3"><?=get_phrase('to_bank');?></option>
							<option value="4"><?=get_phrase('to_cash');?></option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="control-label col-sm-4"><?=get_phrase('amount');?></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="amount" id="amount"/>
					</div>
				</div>
				
				 <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('transact');?></button>
						</div>
					</div>
				
				<?php echo form_close();?>
			
			</div>
		</div>
	</div>
</div>		