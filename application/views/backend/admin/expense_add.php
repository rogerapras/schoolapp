<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_expense');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/expense/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('payee');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="payee" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" readonly="readonly" name="t_date" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" autofocus>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="description" required="required">
						</div> 
					</div>

					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('method');?></label>
                        <div class="col-sm-6">
                            <select name="method" class="form-control select2" required="required">
                            	<option value="" selected="selected" disabled="disabled"><?php echo get_phrase('select');?></option>
                                <option value="1"><?php echo get_phrase('cash');?></option>
                                <option value="2"><?php echo get_phrase('check');?></option>
                                <!--<option value="3"><?php echo get_phrase('card');?></option>-->
                            </select>
                        </div>
                    </div>
                    
					
					<table class="table table-bordered" id="tbl_details">
						<thead>
							<tr>
							<th><?=get_phrase('action');?></th>
							<th><?=get_phrase('quantity');?></th>
							<th><?=get_phrase('description');?></th>
							<th><?=get_phrase('unit_cost');?></th>
							<th><?=get_phrase('cost');?></th>
							<th><?=get_phrase('expense_category');?></th>
						</tr>
						</thead>
						<tbody>
							
						</tbody>
						<tfoot>
							<tr><td colspan="4"><?=get_phrase('total');?></td><td colspan="2"><input readonly="readonly" type="text" class="form-control" id="amount" name="amount" value="0"/></td></tr>
						</tfoot>
					</table>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<div id="add_row" class="btn btn-orange"><?=get_phrase('add_row');?></div>
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_expense');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script>
	$('#add_row').click(function(){
		
		var row = $('#tbl_details tbody tr').length;
		
		$('#tbl_details tbody').append(
										'<tr>'+
										'<td><button class="btn btn-warning" onclick="return remove_row(this);"><?=get_phrase('delete');?></button>'+
										'</td><td><input value="0" type="text" class="form-control" id="qty_'+row+'" name="qty[]" onkeyup="return calculate_cost('+row+');" required="required"/></td>'+
										'<td><input type="text" class="form-control" id="desc_'+row+'" name="desc[]"  required="required"/></td>'+
										'<td><input value="0" type="text" class="form-control" id="unitcost_'+row+'"  name="unitcost[]" onkeyup="return calculate_cost('+row+');"  required="required"/></td>'+
										'<td><input value="0" readonly="readonly" type="text" class="form-control cost" id="cost_'+row+'"  name="cost[]"  required="required"/></td>'+
										'<td><select  class="form-control"  required="required" id="category_'+row+'"  name="category[]">'+
										'<option value="" selected="selected" disabled="disabled"><?=get_phrase('select');?></option>'+
										<?php
											$exp_cat = $this->db->get('expense_category')->result_object();
											
											foreach($exp_cat as $cat):
										?>
											'<option value="<?=$cat->expense_category_id;?>"><?=$cat->name;?></option>'+
										<?php
											endforeach;
										?>
										'</select></td>'+
										'</tr>');
	});
	
	function calculate_cost(row){
		
		var cost = parseFloat($('#qty_'+row).val())*parseFloat($('#unitcost_'+row).val());
		
		if(!isNaN(cost)){
			$('#cost_'+row).val(cost);
		}else{
			$('#cost_'+row).val('0');
		}
		
		totals();
		
	}
	
	function remove_row(elem){
		$(elem).closest('tr').remove();
		
		totals();
	}
	
	function totals(){
		var total = 0;
		
		$('.cost').each(function(i){
			total +=+parseFloat($(this).val());
		});
		
		$('#amount').val(total);
	}
	
</script>