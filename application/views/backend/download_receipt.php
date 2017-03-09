<?php

$receipt = $this->db->get_where('payment',array('batch_number'=>$batch_number))->result_object();

?>	



<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-icons/entypo/css/entypo.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/neon-core.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/neon-theme.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/neon-forms.css">
<script src="<?php echo base_url();?>assets/js/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="row">
	<div class="col-md-12" style="font-size: 9pt;">
				<div class="row">
					<div style="text-align: center;padding-bottom: 10px;font-weight: bold;"><?=$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;?></div>
				</div>
				<div class="row">
					<div style="text-align: center;"><span class="badge badge-info"><?=get_phrase('payment_receipt');?></span></div>
				</div>
				<div class="row" style="padding: 5px 10px; 5px 10px;">
					<div class="pull-left"><span style="font-weight: bold;"><?=get_phrase('receipt_number')?>:</span> <?=$receipt[0]->serial;?></div>
					<div class="pull-right"><span style="font-weight: bold;"><?=get_phrase('date');?>:</span> <?=date('d-m-Y',$receipt[0]->timestamp);?></div>
				</div>
				
				<hr>
					<div class="row" style="padding: 5px 10px; 5px 10px;">
						<div class="row">
							<div class=""><span style="font-weight: bold;"><?=get_phrase('student_name');?>:</span> <?=$this->db->get_where('student',array('student_id'=>$receipt[0]->student_id))->row()->name;?></div> 
						</div>
						
						<div class="row">
							<div class=""><span style="font-weight: bold;"><?=get_phrase('admission_number');?>:</span> <?=$this->db->get_where('student',array('student_id'=>$receipt[0]->student_id))->row()->roll;?> </div> 
						</div>
						<div class="row">
							<div class=""><span style="font-weight: bold;"><?=get_phrase('class');?>:</span> <?php $class_id = $this->db->get_where('student',array('student_id'=>$receipt[0]->student_id))->row()->class_id;echo $this->db->get_where('class',array('class_id'=>$class_id))->row()->name;?></div>
						</div>
						<div class="row">
							<div class=""><span style="font-weight: bold;"><?=get_phrase('term');?>:</span> <?=$this->db->get_where('terms',array('term_number'=>$receipt[0]->term))->row()->name;?></div>
						</div>
					</div>
				
				<table class="table table-bordered">
					<thead>
						<tr>
							<th><?=get_phrase('description');?></th>
							<th><?=get_phrase('amount_due');?></th>
							<th><?=get_phrase('previously_paid');?></th>
							<th><?=get_phrase('paid');?></th>
							<th><?=get_phrase('balance');?></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$total = 0;
							foreach($receipt as $row):
						?>
						<tr>
							<?php
								$amount_to_pay = $this->db->get_where('invoice_details',array('detail_id'=>$row->detail_id,'invoice_id'=>$row->invoice_id))->row()->amount_due;
								
								$sum_paid = 0;
								
								if($this->db->get_where('payment',array('detail_id'=>$row->detail_id,'invoice_id'=>$row->invoice_id,'payment_id<'=>$row->payment_id))->num_rows()!==0){
									$sum_paid = $this->db->select_sum('amount')->get_where('payment',array('detail_id'=>$row->detail_id,'invoice_id'=>$row->invoice_id,'payment_id<'=>$row->payment_id))->row()->amount;
								}
							?>
							<td><?=$this->db->get_where('fees_structure_details',array('detail_id'=>$row->detail_id))->row()->name;?></td>
							<td><?=number_format($amount_to_pay,2);?></td>
							<td><?=number_format($sum_paid,2);?></td>
							<td><?=number_format($row->amount,2);?></td>
							<td><?=number_format($amount_to_pay-($sum_paid+$row->amount),2);?></td>
						</tr>

						<?php
							$total +=$row->amount;
							endforeach;
						?>
					</tbody>

					<tfoot>
							<tr>
								<td colspan="3"><?=get_phrase('receipt_total');?></td>
								<td colspan="2"><?=number_format($total,2);?></td>
							</tr>
							<?php
								$total_fees = $this->db->select_sum('amount_due')->get_where('invoice_details',array('invoice_id'=>$receipt[0]->invoice_id))->row()->amount_due;
							
								$total_sum_paid = 0;
								
								if($this->db->get_where('payment',array('invoice_id'=>$receipt[0]->invoice_id,'payment_id<='=>$receipt[0]->payment_id))->num_rows()!==0){
									$total_sum_paid = $this->db->select_sum('amount')->get_where('payment',array('invoice_id'=>$receipt[0]->invoice_id,'payment_id<='=>$receipt[0]->payment_id))->row()->amount;
								}
							?>
							<tr>
								<td colspan="3"><?=get_phrase('fees_due');?></td>
								
								<td colspan="2"><?=number_format($total_fees,2);?></td>
							</tr>
							
							<tr>
								<td colspan="3"><?=get_phrase('fees_paid_to_date');?></td>
								
								<td colspan="2"><?=number_format($total_sum_paid,2);?></td>
							</tr>
							
							<tr>
								<td colspan="3"><?=get_phrase('fees_balance');?></td>
								
								<td colspan="2"><?=number_format(($total_fees-$total_sum_paid),2);?></td>
							</tr>
					</tfoot>
				</table>
		</div>
	</div>		
	
	<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>