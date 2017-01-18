<?php 
$edit_data	=	$this->db->get_where('invoice' , array('invoice_id' => $param2) )->result_array();
$row = $edit_data[0];

//foreach ($edit_data as $row):
?>

<div class="row">
	<div class="col-md-12">
        <div class="panel panel-default panel-shadow" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title"><?php echo get_phrase('payment_history');?></div>
            </div>
            <div class="panel-body">
                
                <table class="table table-bordered">
                	<thead>
                		<tr>
                			<td>#</td>
                			<td><?php echo get_phrase('amount');?></td>
                			<td><?php echo get_phrase('method');?></td>
                			<td><?php echo get_phrase('Income Category');?></td>
                			<td><?php echo get_phrase('date');?></td>
                		</tr>
                	</thead>
                	<tbody>
                	<?php 
                		$count = 1;
                		$payments = $this->db->get_where('payment' , array(
                			'invoice_id' => $row['invoice_id']
                		))->result_array();
                		foreach ($payments as $row2):
                	?>
                		<tr>
                			<td><?php echo $count++;?></td>
                			<td><?php echo $row2['amount'];?></td>
                			<td>
                				<?php 
                					if ($row2['method'] == 1)
                						echo get_phrase('cash');
                					if ($row2['method'] == 2)
                						echo get_phrase('check');
                					if ($row2['method'] == 3)
                						echo get_phrase('card');
                                    if ($row2['method'] == 'paypal')
                                        echo 'paypal';
                				?>
                			</td>
                			<td><?php echo $this->crud_model->get_income_category_name($row2['income_category_id']);?></td>
                			<td><?php echo date('d M,Y', $row2['timestamp']);?></td>
                		</tr>
                	<?php endforeach;?>
                	</tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-shadow" data-collapsed="0">
			<div class="panel-heading">
                <div class="panel-title"><?php echo get_phrase('take_payment');?></div>
            </div>
            <div class="panel-body">
				<?php echo form_open(base_url() . 'index.php?admin/invoice/take_payment/'.$row['invoice_id'], array(
					'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

					<div class="form-group">
		                <label class="col-sm-3 control-label"><?php echo get_phrase('invoice_total');?></label>
		                <div class="col-sm-6">
		                    <input type="text" class="form-control" value="<?php echo $row['amount_due'];?>" readonly/>
		                </div>
		            </div>

		            <div class="form-group">
		                <label class="col-sm-3 control-label"><?php echo get_phrase('amount_paid');?></label>
		                <div class="col-sm-6">
		                    <input type="text" class="form-control" name="amount_paid" value="<?php echo $row['amount_paid'];?>" readonly/>
		                </div>
		            </div>
					<?php
                        	$bal = $row['amount_due'] - $row['amount_paid']; 
                    ?>
		            <div class="form-group">
		                <label class="col-sm-3 control-label"><?php echo get_phrase('balance');?></label>
		                <div class="col-sm-6">
		                    <input type="text" class="form-control" value="<?php echo $bal;?>" readonly/>
		                </div>
		            </div>
		            
		            <div class="form-group">
		                <label class="col-sm-offset-6 control-label"><?php echo get_phrase('payment');?></label>
		            </div>

		            <div class="form-group">
		                <div class="col-sm-12">
							<table class="table">
								<thead>
									<tr>
										<th>Item</th>
										<th>Amount Payable</th>
										<th>Balance</th>
										<th>Payment</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$invoice_details = $this->db->get_where('invoice_details',array('invoice_id'=>$row['invoice_id']))->result_object();
										
										foreach($invoice_details as $inv):
									?>
										<tr>
											<td><?php echo $this->db->get_where('fees_structure_details',array('detail_id'=>$inv->detail_id))->row()->name;?></td>
											<td><?php echo $inv->amount_due;?></td>
											<?php
												$paid = 0;
												
												if($this->db->get_where('payment',array('invoice_id'=>$inv->invoice_id,'detail_id'=>$inv->detail_id))->num_rows()>0){
													$paid = $this->db->select_sum('amount')->get_where('payment',array('invoice_id'=>$row['invoice_id'],'detail_id'=>$inv->detail_id))->row()->amount;
												} 
												
												$detail_bal = $inv->amount_due-$paid;
											?>
											<td><?php echo $detail_bal;?></td>
											<td><input type="text" class="form-control" name="take_payment['<?php echo $inv->detail_id;?>']" id="" value="0"/></td>
										</tr>
									
									<?php
										endforeach;
									?>
								</tbody>
							</table>
		                </div>
		            </div>

		            <div class="form-group">
		                <label class="col-sm-3 control-label"><?php echo get_phrase('payment');?></label>
		                <div class="col-sm-6">
		                    <input type="text" class="form-control" name="total_payment" id="total_payment" value="0" readonly="readonly" placeholder="<?php echo get_phrase('enter_payment_amount');?>"/>
		                </div>
		            </div>

		            <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('method');?></label>
                        <div class="col-sm-6">
                            <select name="method" class="form-control">
                                <option value="1"><?php echo get_phrase('cash');?></option>
                                <option value="2"><?php echo get_phrase('check');?></option>
                                <option value="3"><?php echo get_phrase('card');?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
	                    <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
	                    <div class="col-sm-6">
	                        <input type="text" class="datepicker form-control" name="timestamp" 
	                            value=""/>
	                    </div>
					</div>

                    <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id'];?>">
                    <input type="hidden" name="student_id" value="<?php echo $row['student_id'];?>">
                    <input type="hidden" name="yr" value="<?php echo $row['yr'];?>">
                    <input type="hidden" name="term" value="<?php echo $row['term'];?>">

		            <div class="form-group">
		                <div class="col-sm-5">
		                    <button type="submit" class="btn btn-info"><?php echo get_phrase('take_payment');?></button>
		                </div>
		            </div>

				<?php echo form_close();?>
			</div>
		</div>
	</div>
</div>


<?php //endforeach;?>