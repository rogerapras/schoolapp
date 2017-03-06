<div class="row">
		<div class="col-sm-12">
	<div class="panel panel-primary" id="">
						
		<div class="panel-heading">
			<div class="panel-title"><?=get_phrase('edit_budget');?></div>						
		</div>
								
		<div class="panel-body" style="overflow: auto;">
			
						<?php 
						
							echo form_open(base_url() . 'index.php?admin/budget/edit_item/'.$param2 , array('id'=>'frm_schedule','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));
							
							$budget = $this->db->get_where('budget',array('budget_id'=>$param2))->row();
							//print_r($budget);
						?>

							<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('account');?></label>
									<div class="col-sm-7">
										<select name="expense_category_id" id="expense_category_id" class="form-control"  required="required">
											<option selected disabled value=""><?=get_phrase('select');?></option>
											<?php
												$exp_acc = $this->db->get('expense_category')->result();
												
												foreach($exp_acc as $acc):
											?>
												<option value="<?=$acc->expense_category_id;?>" <?php if($budget->expense_category_id===$acc->expense_category_id) echo "selected";?>><?=$acc->name;?></option>
											<?php
												endforeach;
											?>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('description');?></label>
									<div class="col-sm-7">
										<input type="text" name="description" id="description" class="form-control"  required="required" value="<?php echo $budget->description;?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('financial_year');?></label>
									<div class="col-sm-7">
										<select name="fy" id="fy" class="form-control" required="required">
											<option selected disabled value=""><?=get_phrase('select');?></option>
											<?php 
												$fy = range(date('Y')-5, date('Y')+5);
													
												foreach($fy as $yr):
											?>
												<option value="<?=$yr;?>" <?php if($budget->fy === $yr) echo 'selected';?>><?=$yr;?></option>
											<?php 
												endforeach;
											?>
										</select>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('quantity');?></label>
									<div class="col-sm-7">
										<input type="text" id="qty" name="qty" class="form-control header"  required="required" value="<?php echo $budget->qty;?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('unit_cost');?></label>
									<div class="col-sm-7">
										<input type="text" id="unitcost" name="unitcost" class="form-control header" required="required"  value="<?php echo $budget->unitcost;?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('how_often');?></label>
									<div class="col-sm-7">
										<input type="text" id="often" name="often" class="form-control header" required="required" value="<?php echo $budget->often;?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-4"><?=get_phrase('total');?></label>
									<div class="col-sm-7">
										<input type="text" id="total" name="total" class="form-control" value="<?php echo $budget->total;?>"/>
									</div>
								</div>								
								
								<table class="table">
									<thead>
										<tr>
											<th colspan="12"><?=get_phrase('monthly_spread');?></th>
										</tr>
										<tr>
											<th><?=get_phrase('Jan');?></th>
											<th><?=get_phrase('Feb');?></th>
											<th><?=get_phrase('Mar');?></th>
											<th><?=get_phrase('Apr');?></th>
											<th><?=get_phrase('May');?></th>
											<th><?=get_phrase('Jun');?></th>
											<th><?=get_phrase('Jul');?></th>
											<th><?=get_phrase('Aug');?></th>
											<th><?=get_phrase('Sep');?></th>
											<th><?=get_phrase('Oct');?></th>
											<th><?=get_phrase('Nov');?></th>
											<th><?=get_phrase('Dec');?></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text" style="min-width: 80px;" class="form-control spread" class="months" name="months[]" id="Jan" value="<?php echo $this->db->get_where('budget_schedule',array('budget_id'=>$param2,'month'=>1))->row()->amount;?>"/></td>
											<td><input type="text" style="min-width: 80px;" class="form-control spread" class="months" name="months[]" id="Feb" value="<?php echo $this->db->get_where('budget_schedule',array('budget_id'=>$param2,'month'=>2))->row()->amount;?>"/></td>
											<td><input type="text" style="min-width: 80px;" class="form-control spread" class="months" name="months[]" id="Mar" value="<?php echo $this->db->get_where('budget_schedule',array('budget_id'=>$param2,'month'=>3))->row()->amount;?>"/></td>
											<td><input type="text" style="min-width: 80px;" class="form-control spread" class="months" name="months[]" id="Apr" value="<?php echo $this->db->get_where('budget_schedule',array('budget_id'=>$param2,'month'=>4))->row()->amount;?>"/></td>
											<td><input type="text" style="min-width: 80px;" class="form-control spread" class="months" name="months[]" id="May" value="<?php echo $this->db->get_where('budget_schedule',array('budget_id'=>$param2,'month'=>5))->row()->amount;?>"/></td>
											<td><input type="text" style="min-width: 80px;" class="form-control spread" class="months" name="months[]" id="Jun" value="<?php echo $this->db->get_where('budget_schedule',array('budget_id'=>$param2,'month'=>6))->row()->amount;?>"/></td>
											<td><input type="text" style="min-width: 80px;" class="form-control spread" class="months" name="months[]" id="Jul" value="<?php echo $this->db->get_where('budget_schedule',array('budget_id'=>$param2,'month'=>7))->row()->amount;?>"/></td>
											<td><input type="text" style="min-width: 80px;" class="form-control spread" class="months" name="months[]" id="Aug" value="<?php echo $this->db->get_where('budget_schedule',array('budget_id'=>$param2,'month'=>8))->row()->amount;?>"/></td>
											<td><input type="text" style="min-width: 80px;" class="form-control spread" class="months" name="months[]" id="Sep" value="<?php echo $this->db->get_where('budget_schedule',array('budget_id'=>$param2,'month'=>9))->row()->amount;?>"/></td>
											<td><input type="text" style="min-width: 80px;" class="form-control spread" class="months" name="months[]" id="Oct" value="<?php echo $this->db->get_where('budget_schedule',array('budget_id'=>$param2,'month'=>10))->row()->amount;?>"/></td>
											<td><input type="text" style="min-width: 80px;" class="form-control spread" class="months" name="months[]" id="Nov" value="<?php echo $this->db->get_where('budget_schedule',array('budget_id'=>$param2,'month'=>11))->row()->amount;?>"/></td>
											<td><input type="text" style="min-width: 80px;" class="form-control spread" class="months" name="months[]" id="Dec" value="<?php echo $this->db->get_where('budget_schedule',array('budget_id'=>$param2,'month'=>12))->row()->amount;?>"/></td>
										</tr>
									</tbody>
								</table>
								
							</div>
							<button type="submit" class="btn btn-primary btn-icon"><i class="fa fa-pencil"></i><?=get_phrase('edit');?></button>
							<div id="clear_spread" class="btn btn-danger btn-icon"><i class="fa fa-refresh"></i><?php echo get_phrase('clear_spread');?></div>
						</form>
</div>
</div>
</div>
</div>

<script>
			$('.header').keyup(function(e){
			
			var spread=0;
			var sum = 0;
			var sum_spread = 0;
			var sum_header = 0;
			
			if($(this).attr('id')==='qty'){	
				sum = $(this).val()*$('#unitcost').val()*$('#often').val();
				
				$('#total').val(sum);
				
				spread = sum/12;
				
				$('.spread').each(function(){
					$(this).val(spread);
				})
			}
			
			if($(this).attr('id')==='unitcost'){
				sum = $(this).val()*$('#.qty').val()*$('#often').val();
				
				$('#total').val(sum);
				
				spread = sum/12;
				
				$('.spread').each(function(){
					$(this).val(spread);
				})
			}
			
			if($(this).attr('id')==='often'){
				sum = $(this).val()*$('#unitcost').val()*$('#qty').val();
				
				$('#total').val(sum);
				
				spread = sum/12;
				
				$('.spread').each(function(){
					$(this).val(spread);
				})
			}
				

		});
		
		
		
		$('#clear_spread').click(function(){
			$('.spread').each(function(index){
				$(this).val('0');
			});
		});
		


		
</script>