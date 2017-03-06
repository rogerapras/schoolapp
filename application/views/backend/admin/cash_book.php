<hr>
<?php echo form_open(base_url() . 'index.php?admin/cash_book/scroll' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	<div class="form-group">
	
	<div class="col-sm-3">
		<button id="contra" class="btn btn-success btn-icon" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_contras');"><i class="fa fa-tasks"></i><?=get_phrase('contra_entries');?></button>
	</div>
			
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

<hr>
<div class="well well-sm" style="font-weight: bolder;text-align: center;">Cash Book for the Month of <?=date('F-Y',strtotime($current));?></div>
<table class="table table-hover table-bordered datatable">
	<thead>
		<tr>
			<th colspan="4">&nbsp;</th>
			<th colspan="3"><?=get_phrase('bank');?></th>
			<th colspan="3"><?=get_phrase('cash');?></th>
		</tr>
		
		<tr>
			<th><?=get_phrase('date');?></th>
			<th><?=get_phrase('reference');?></th>
			<th><?=get_phrase('description');?></th>
			<th><?=get_phrase('transaction_type');?></th>
			<!--Bank-->
			<th><?=get_phrase('income');?></th>
			<th><?=get_phrase('expense');?></th>
			<th><?=get_phrase('balance');?></th>
			<!--Bank-->
			<th><?=get_phrase('income');?></th>
			<th><?=get_phrase('expense');?></th>
			<th><?=get_phrase('balance');?></th>
		</tr>
		
		
	</thead>
	<tbody>
		<tr>
			<td colspan="4"><?=get_phrase('balance_brought_forward');?></td>
			
			<td colspan="2">&nbsp;</td>
			<td><?=number_format($bank_balance,2);?></td>
			
			<td colspan="2">&nbsp;</td>
			<td><?=number_format($cash_balance,2);?></td>
		</tr>
		<?php
			
			$sum_bank_income = 0;
			$sum_bank_expense = 0;
			
			$sum_cash_income = 0;
			$sum_cash_expense = 0;
			
			foreach($transactions as $rows):
				
			$type = array('1'=>'Income','2'=>'Expense','3'=>'Bank Deposit from Cash','4'=>'Bank Withdraw to Cash');
		?>
			
			<tr>
				<td><?=$rows->t_date;?></td>
				<td><div class="btn btn-success"
					
					<?php
						if($rows->transaction_type==='2'){
					?>
						onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_expense/<?=$rows->refNo?>');"
					<?php
						}
					?>
					
					><?=get_phrase('view');?></div></td>
				<td><?=substr($rows->description,0,25);?></td>
				<td><?=$type[$rows->transaction_type];?></td>
				
				<!--Bank Income-->
				<?php
					$bank_income = 0;
					if(($rows->transaction_type==='1' && $rows->account==='2')||$rows->transaction_type==='3') $bank_income = $rows->amount;		
					$sum_bank_income +=	$bank_income;		
				?>
				
				<td><?=number_format($bank_income,2);?></td>
				
				<!--Bank Expense-->
				<?php
					$bank_expense = 0;
					if(($rows->transaction_type==='2' && $rows->account==='2')||$rows->transaction_type==='4') $bank_expense = $rows->amount;
					$sum_bank_expense +=	$bank_expense;					
				?>
				
				<td><?=number_format($bank_expense,2);?></td>
				
				<!--Bank Balance-->
				<?php
					$bank_balance += $bank_income-$bank_expense;
				?>
				<td><?=number_format($bank_balance,2);?></td>
				
				
				
				
				
				<!--Cash Income-->
				<?php
					$cash_income = 0;
					if(($rows->transaction_type==='1' && $rows->account==='1')||$rows->transaction_type==='4') $cash_income = $rows->amount;	
					$sum_cash_income +=	$cash_income;		
				?>
				
				<td><?=number_format($cash_income,2);?></td>
				
				<!--Cash Expense-->
				<?php
					$cash_expense = 0;
					if(($rows->transaction_type==='2' && $rows->account==='1')||$rows->transaction_type==='3') $cash_expense = $rows->amount;
					$sum_cash_expense +=	$cash_expense;				
				?>
				
				<td><?=number_format($cash_expense,2);?></td>
				
				<!--Cash Balance-->
				<?php
					$cash_balance += $cash_income-$cash_expense;
				?>
				<td><?=number_format($cash_balance,2);?></td>
				
			</tr>
			
		<?php
			endforeach;
		?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4"><?=get_phrase('total');?></td>
			
			<td><?=number_format($sum_bank_income,2);?></td>
			<td><?=number_format($sum_bank_expense,2);?></td>
			<td><?=number_format($bank_balance,2);?></td>
			
			<td><?=number_format($sum_cash_income,2);?></td>
			<td><?=number_format($sum_cash_expense,2);?></td>
			<td><?=number_format($cash_balance,2);?></td>
		</tr>
	</tfoot>
</table>

<script>
	$('#contra').click(function(e){
		e.preventDefault();
	});
	
	
	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [0, 2, 3, 4]
					},
					{
						"sExtends": "pdf",
						"mColumns": [0, 2, 3, 4]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(1, false);
							datatable.fnSetColumnVis(5, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(1, true);
									  datatable.fnSetColumnVis(5, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>