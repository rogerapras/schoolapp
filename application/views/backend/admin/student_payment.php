<div class="row">
	<div class="col-md-12">
			
			<ul class="nav nav-tabs bordered">
				<li class="active">
					<a href="#unpaid" data-toggle="tab">
						<span class="hidden-xs"><?php echo get_phrase('create_single_invoice');?></span>
					</a>
				</li>
				<li>
					<a href="#paid" data-toggle="tab">
						<span class="hidden-xs"><?php echo get_phrase('create_mass_invoice');?></span>
					</a>
				</li>
			</ul>
			
			<div class="tab-content">
				<div class="tab-pane active" id="unpaid">

				<!-- creation of single invoice -->
				<?php echo form_open(base_url() . 'index.php?admin/invoice/create' , array('id'=>'frm_single_invoice','class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
				<div class="row">
					<div class="col-md-6">
	                        <div class="panel panel-default panel-shadow" data-collapsed="0">
	                            <div class="panel-heading">
	                                <div class="panel-title"><?php echo get_phrase('invoice_informations');?></div>
	                            </div>
	                            <div class="panel-body">
	                                
	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
	                                    <div class="col-sm-9">
	                                        <select name="class_id" class="form-control"
	                                        	onchange="return get_class_students(this.value)" id="fees_structure_class" onblur='return get_total_fees()'>
	                                        	<option value=""><?php echo get_phrase('select_class');?></option>
	                                        	<?php 
	                                        		$classes = $this->db->get('class')->result_array();
	                                        		foreach ($classes as $row):
	                                        	?>
	                                        	<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
	                                        	<?php endforeach;?>
	                                            
	                                        </select>
	                                    </div>
	                                </div>

	                                <div class="form-group">
		                                <label class="col-sm-3 control-label"><?php echo get_phrase('student');?></label>
		                                <div class="col-sm-9">
		                                    <select name="student_id" class="form-control" style="width:100%;" id="student_selection_holder">
		                                        <option value=""><?php echo get_phrase('select_class_first');?></option>
		                                    	
		                                    </select>
		                                </div>
		                            </div>

	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label"><?php echo get_phrase('year');?></label>
	                                    <div class="col-sm-9">
	                                        <input type="text" class="form-control" min="2010" max="2050" name="yr" onblur='return get_total_fees()' id='fees_structure_year'/>
	                                    </div>
	                                </div>
	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label"><?php echo get_phrase('term');?></label>
	                                    <div class="col-sm-9">
	                                        <!--<input type="text" class="form-control" min="1" max="3" id="fees_structure_term" onblur='return get_total_fees()' name="description"/>-->
	                                        <select name="term" class="form-control" id="fees_structure_term" onchange='return get_total_fees()'>
	                                        	<option value=""><?php echo get_phrase('select');?></option>
	                                        	<?php
	                                        		$terms = $this->db->get('terms')->result_object();
	                                        		foreach($terms as $rows):
	                                        	?>
	                                        		<option value="<?php echo $rows->term_number;?>"><?php echo $rows->name;?></option>
	                                        	<?php
	                                        		endforeach;
	                                        	?>
	                                        </select>
	                                    </div>
	                                </div>

	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
	                                    <div class="col-sm-9">
	                                        <input type="text" class="datepicker form-control" name="date"/>
	                                    </div>
	                                </div>
	                                
	                            </div>
	                        </div>
	                    </div>

	                    <div class="col-md-6">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"><?php echo get_phrase('payment_informations');?></div>
                            </div>
                            <div class="panel-body">
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('total_payable');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="0" class="form-control" name="amount" readonly="readonly" placeholder="<?php echo get_phrase('enter_total_amount');?>" id='total_fees_amount'/>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                	<label class="col-sm-3 control-label"><?php echo get_phrase('fee_items');?></label>
                                	<div class="col-sm-9">
                                		<table class="table">
                                			<thead>
                                				<tr>
                                					<th><?=get_phrase('full_payment');?></th>
                                					<th><?=get_phrase('item');?></th>
                                					<th><?=get_phrase('fee_structure_amount');?></th>
                                					<th><?=get_phrase('amount_payable');?></th>
                                				</tr>
                                			</thead>
                                			<tbody id="fee_items">
                                				
                                			</tbody>
                                		</table>
                                	</div>	
								</div>
							
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('due_payment');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="amount_due" name="amount_due" value="0" readonly="readonly" placeholder="<?php echo get_phrase('enter_payable_amount');?>"/>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <button type="submit" id="btn-single" class="btn btn-info"><?php echo get_phrase('create_invoice');?></button>
                            </div>
                        </div>
                    </div>


	                </div>
	              	<?php echo form_close();?>

				<!-- creation of single invoice -->
					
				</div>
				<div class="tab-pane" id="paid">

				<!-- creation of mass invoice -->
				<?php echo form_open(base_url() . 'index.php?admin/invoice/create_mass_invoice' , array('class' => 'form-horizontal form-groups-bordered validate', 'id'=> 'mass' ,'target'=>'_top'));?>
				<br>
				<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-5">

					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        <div class="col-sm-9">
                            <select name="class_id" class="form-control"
                            	onchange="return get_class_students_mass(this.value)" id='fees_mass_structure_class'>
                            	<option value=""><?php echo get_phrase('select_class');?></option>
                            	<?php 
                            		$classes = $this->db->get('class')->result_array();
                            		foreach ($classes as $row):
                            	?>
                            	<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                            	<?php endforeach;?>
                                
                            </select>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('year');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" min="2010" max="2050" name="yr" id='fees_mass_structure_year'/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('term');?></label>
                        <div class="col-sm-9">
                            <!--<input type="text" class="form-control" min="1" max="3" name="term" id='fees_mass_structure_term'  onblur='return get_mass_total_fees()'/>-->
                            <select name="term" class="form-control" id="fees_mass_structure_term" onchange='return get_mass_total_fees()'>
	                                        	<option value=""><?php echo get_phrase('select');?></option>
	                                        	<?php
	                                        		$terms = $this->db->get('terms')->result_object();
	                                        		foreach($terms as $rows):
	                                        	?>
	                                        		<option value="<?php echo $rows->term_number;?>"><?php echo $rows->name;?></option>
	                                        	<?php
	                                        		endforeach;
	                                        	?>
	                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('total_payable');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="amount" readonly="readonly" placeholder="<?php echo get_phrase('enter_total_amount');?>"  id='total_mass_fees_amount'/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                                	<label class="col-sm-3 control-label"><?php echo get_phrase('fee_items');?></label>
                                	<div class="col-sm-9">
                                		<table class="table">
                                			<thead>
                                				<tr>
                                					<th><?=get_phrase('full_payment');?></th>
                                					<th><?=get_phrase('item');?></th>
                                					<th><?=get_phrase('fee_structure_amount');?></th>
                                					<th><?=get_phrase('amount_payable');?></th>
                                				</tr>
                                			</thead>
                                			<tbody id="mass_fee_items">
                                				
                                			</tbody>
                                		</table>
                                	</div>	
					</div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('due_payment');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mass_amount_due" name="amount_due" readonly="readonly" placeholder="<?php echo get_phrase('enter_payment_amount');?>" value="0"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                        <div class="col-sm-9">
                            <input type="text" class="datepicker form-control" name="date"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5 col-sm-offset-3">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('create_invoice');?></button>
                        </div>
                    </div>
                    


				</div>
				<div class="col-md-6">
					<div id="student_selection_holder_mass"></div>
				</div>
				</div>
				<?php echo form_close();?>

				<!-- creation of mass invoice -->

				</div>
				
			</div>
			
			
	</div>
</div>

<script type="text/javascript">
	// function check() {
 //    	$("#selectall").click(function () {
 //    		$("input:checkbox").prop('checked', $(this).prop("checked"));
	// 	});
	// }

	function select() {
		var chk = $('.check');
			for (i = 0; i < chk.length; i++) {
				chk[i].checked = true ;
			}

		//alert('asasas');
	}
	function unselect() {
		var chk = $('.check');
			for (i = 0; i < chk.length; i++) {
				chk[i].checked = false ;
			}
	}
</script>

<script type="text/javascript">
    function get_class_students(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_students/' + class_id ,
            success: function(response)
            {
                jQuery('#student_selection_holder').html(response);
            }
        });
    }
    
    function get_total_fees(){
    		var fees_structure_class = $("#fees_structure_class").val();
    		var fees_structure_year = $("#fees_structure_year").val();
    		var fees_structure_term = $("#fees_structure_term").val();
    	    $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_total_fees/' + fees_structure_term +'/'+ fees_structure_year + '/'+ fees_structure_class,
            success: function(response)
            {

            		jQuery('#total_fees_amount').val(response);
            }
        });
    }
    
    $("#fees_structure_class,#fees_structure_year,#fees_structure_term").change(function(){
    		var fees_structure_class = $("#fees_structure_class").val();
    		var fees_structure_year = $("#fees_structure_year").val();
    		var fees_structure_term = $("#fees_structure_term").val();
    		var student = $('#student_selection_holder').val();
    	    $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_fees_items/' + fees_structure_term +'/'+ fees_structure_year + '/'+ fees_structure_class + '/' + student,
            success: function(response)
            {

            		jQuery('#fee_items').html(response);

					var total_payable = 0;
		    		$('.payable_items').each(function(){
		    			var to_add = 0;
		    			if($(this).val()!==""){
		    				to_add = $(this).val();
		    			}
		    			total_payable=parseInt(total_payable)+parseInt(to_add);
		    		});
		    		$('#amount_due').val(total_payable);
		    		
		    		if($('#amount_due').val()>0){
		    			
		    			$('#btn-single').html('<?php echo get_phrase('edit_invoice');?>')
		    			
		    			$('#frm_single_invoice').attr('action','<?php echo base_url();?>index.php?admin/invoice/edit/'+$('#edit_invoice_id').val());
		    		}
            }
        });    	
    });
    
    function get_full_amount(id){
    	if($('#chk_'+id).is(':checked')){
    		$('#payable_'+id).val($('#full_amount_'+id).html());
    		
    		var total_payable = 0;
    		$('.payable_items').each(function(){
    			var to_add = 0;
    			if($(this).val()!==""){
    				to_add = $(this).val();
    			}
    			total_payable=parseInt(total_payable)+parseInt(to_add);
    		});
    		$('#amount_due').val(total_payable);
    		
    	}else{
    		
    		var total_payable = $('#amount_due').val()-$('#payable_'+id).val();
    		
    		$('#amount_due').val(total_payable);
    		
    		$('#payable_'+id).val('0');
    		
    		
    	}
    	
    	
    }
    
    function get_payable_amount(id){

    	  var total_payable = 0;
    		$('.payable_items').each(function(){
    			var to_add = 0;
    			if($(this).val()!==""){
    				to_add = $(this).val();
    			}
    			total_payable=parseInt(total_payable)+parseInt(to_add);
    		});
    		$('#amount_due').val(total_payable);
    		
    		$('#chk_'+id).prop('checked',false);
    	
    }
    
        function get_mass_total_fees(){
    		var fees_structure_class = $("#fees_mass_structure_class").val();
    		var fees_structure_year = $("#fees_mass_structure_year").val();
    		var fees_structure_term = $("#fees_mass_structure_term").val();
    	    $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_total_fees/' + fees_structure_term +'/'+ fees_structure_year + '/'+ fees_structure_class,
            success: function(response)
            {
               jQuery('#total_mass_fees_amount').val(response);
               
            }
        });
    }
    
 	$('#fees_mass_structure_class,#fees_mass_structure_year,#fees_mass_structure_term').change(function(){
 			var fees_structure_class = $("#fees_mass_structure_class").val();
    		var fees_structure_year = $("#fees_mass_structure_year").val();
    		var fees_structure_term = $("#fees_mass_structure_term").val();
    		
	    	$.ajax({
	            url: '<?php echo base_url();?>index.php?admin/get_mass_fees_items/' + fees_structure_term +'/'+ fees_structure_year + '/'+ fees_structure_class,
	            success: function(response)
	            {
	               jQuery('#mass_fee_items').html(response);
	               
	            }
	        });
 	});
 	
 	function get_mass_full_amount(id){
    	if($('#mass_chk_'+id).is(':checked')){
    		$('#mass_payable_'+id).val($('#mass_full_amount_'+id).html());
    		
    		var total_payable = 0;
    		$('.mass_payable_items').each(function(){
    			var to_add = 0;
    			if($(this).val()!==""){
    				to_add = $(this).val();
    			}
    			total_payable=parseInt(total_payable)+parseInt(to_add);
    		});
    		$('#mass_amount_due').val(total_payable);
    		
    	}else{
    		
    		var total_payable = $('#mass_amount_due').val()-$('#mass_payable_'+id).val();
    		
    		$('#mass_amount_due').val(total_payable);
    		
    		$('#mass_payable_'+id).val('0');
    		
    		
    	}
    	
    	
    }
    
      function get_mass_payable_amount(id){

    	  var total_payable = 0;
    		$('.mass_payable_items').each(function(){
    			var to_add = 0;
    			if($(this).val()!==""){
    				to_add = $(this).val();
    			}
    			total_payable=parseInt(total_payable)+parseInt(to_add);
    		});
    		$('#mass_amount_due').val(total_payable);
    		
    		$('#mass_chk_'+id).prop('checked',false);
    	
    }  
    
</script>

<script type="text/javascript">
    function get_class_students_mass(class_id) {
    	
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_students_mass/' + class_id ,
            success: function(response)
            {
                jQuery('#student_selection_holder_mass').html(response);
            }
        });

        
    }
</script>