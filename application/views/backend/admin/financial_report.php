<?php


?>

<div class="row">

	<hr/>
		<?php echo form_open(base_url() . 'index.php?admin/financial_report/scroll' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
			<div class="form-group">
					
				<label class="col-sm-3 control-label">Choose Month</label>							
						<div class="col-sm-3">
							<div class="input-group">
								<input type="text" name="t_date" class="form-control datepicker" data-format="yyyy-mm-dd">
												
								<div class="input-group-addon">
									<a href="#"><i class="entypo-calendar"></i></a>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Choose');?></button>
						</div>
			</div>
			
			
		<?php echo form_close();?>
	
	<hr/>
			
	<div class="col-sm-6">
		
		<caption><?=get_phrase('revenue_report_for')." ".date('F Y',strtotime($current_date));?></caption>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th><?=get_phrase('income_category');?></th>
					<th><?=get_phrase('opening_balance');?></th>
					<th><?=get_phrase('month_income');?></th>
					<th><?=get_phrase('month_expense');?></th>
					<th><?=get_phrase('ending_balance');?></th>
				</tr>
			</thead>
			
			<tbody align="right">
				<?php
					$income_categories = $this->db->get('income_categories')->result_object();
					
					$sum_start = 0;
					$sum_month_income = 0;
					$sum_month_expense = 0;
					$sum_end = 0;
					
					foreach($income_categories as $row):
						$start = $this->crud_model->revenue_opening_balance($row->income_category_id,$current_date);
						$month_income = $this->crud_model->month_income_by_income_category($row->income_category_id,$current_date);
						$month_expense = $this->crud_model->month_expense_by_income_category($row->income_category_id,$current_date);
						$end = $start+($month_income-$month_expense);
				?>
					<tr>
						<td align="left"><?=$row->name;?></td>
						<td><?=number_format($start,2);?></td>
						<td><?=number_format($month_income,2);?></td>
						<td><?=number_format($month_expense,2);?></td>
						<td><?=number_format($end,2);?></td>
					</tr>
				<?php
				
					$sum_start += $start;
					$sum_month_income += $month_income;
					$sum_month_expense += $month_expense;
					$sum_end += $end;
					
					endforeach;
				?>	
				
			</tbody>
			<tfoot align="right">
				<tr>
					<td><?=get_phrase('total');?></td>
					<td><?=number_format($sum_start,2);?></td>
					<td><?=number_format($sum_month_income,2);?></td>
					<td><?=number_format($sum_month_expense,2);?></td>
					<td><?=number_format($sum_end,2);?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>