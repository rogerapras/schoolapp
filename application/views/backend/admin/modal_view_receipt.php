<?php
//print_r($this->db->get_where('payment',array('batch_number'=>$param2))->result_object());

$receipt = $this->db->get_where('payment',array('batch_number'=>$param2))->result_object();

?>
<div class="row">
	<center>
	    <a onClick="PrintElem('#receipt_print')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
	        <?=get_phrase('print_receipt');?>
	        <i class="entypo-print"></i>
	    </a>
	</center>
</div>

<div class="row" id="receipt_print">
	<div class="col-md-12">
		<!--<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('receipt');?>
            	</div>
            </div>
			<div class="panel-body">-->
				<div class="row">
					<div style="text-align: center;padding-bottom: 10px;font-weight: bold;"><?=$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;?></div>
				</div>
				<div class="row">
					<div style="text-align: center;"><span class="badge badge-info"><?=get_phrase('payment_receipt');?></span></div>
				</div>
				<div class="row" style="padding: 5px 30px; 5px 30px;">
					<div class="pull-left"><span style="font-weight: bold;"><?=get_phrase('receipt_number')?>:</span> <?=$receipt[0]->serial;?></div>
					<div class="pull-right"><span style="font-weight: bold;"><?=get_phrase('date');?>:</span> <?=date('d-m-Y',$receipt[0]->timestamp);?></div>
				</div>
				
				<hr>
					<div class="row" style="padding: 5px 30px; 5px 30px;">
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
				
				<table class="table table-bordered datatables">
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
				
			<!--</div>-->
		</div>
	</div>		
</div>

<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'Receipt', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Receipt</title>');
        mywindow.document.write('<link rel="stylesheet" href="<?php echo FCPATH;?>assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="<?php echo FCPATH;?>assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>