<div class="row">
	<div class="col-xs-4">
		<div class="panel panel-primary">
								
				<div class="panel-heading">
					<div class="panel-title"><?=get_phrase('School_terms');?></div>						
				</div>
										
				<div class="panel-body">
				
					<div class="btn btn-primary btn-icon pull-right" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_new_term');"><i class="entypo-plus-squared"></i><?php echo get_phrase('add');?></div>
				
					<table class="table table-striped">
						<thead>
							<tr>
								<th><?php echo get_phrase('action');?></th>
								<th><?php echo get_phrase('term_number');?></th>
								<th><?php echo get_phrase('terms');?></th>
								
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($terms as $rows):
							?>
							<tr>
								<td>
										<div class="btn-group">
	                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
	                                        Action <span class="caret"></span>
	                                    </button>
	                                    <ul class="dropdown-menu dropdown-default pull-left" role="menu">
	                                        <!-- Edit -->
	                                        <li>
	                                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_term/<?php echo $rows->terms_id;?>');">
	                                                <i class="entypo-pencil"></i>
	                                                    <?php echo get_phrase('edit');?>
	                                                </a>
	                                        </li>
	                                        
	                                        <li class="divider"></li>
	                                        
	                                        <!-- DELETE -->
	                                        <li>
	                                            <a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?admin/school_settings/delete_term/<?php echo $rows->terms_id;?>');">
	                                                <i class="entypo-trash"></i>
	                                                    <?php echo get_phrase('delete');?>
	                                                </a>
	                                        </li>
	                                    </ul>
	                                </div>
								</td>
								<td><?php echo $rows->term_number;?></td>
								<td><?php echo $rows->name;?></td>
								
							</tr>
							<?php
								endforeach;
							?>
						</tbody>
					</table>
					
				</div>
			
		</div>
	</div>
	
	<div class="col-xs-6">
		
				<div class="panel panel-primary">
								
					<div class="panel-heading">
						<div class="panel-title"><?=get_phrase('account_opening_balances');?></div>						
					</div>
										
					<div class="panel-body">
						<div class="btn btn-primary btn-icon pull-right" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_add_edit_account/');"><i class="fa fa-plus-square"></i><?=get_phrase('add/_Edit');?></div>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th><?=get_phrase('date');?></th>
									<th><?=get_phrase('account');?></th>
									<th><?=get_phrase('amount');?></th>
								</tr>
							</thead>
							<?php
								$balances = $this->db->get('accounts')->result_object();
							?>
							<tbody>
								<tr>
									<td><?php echo $this->db->get_where('settings',array('type'=>'system_start_date'))->row()->description;?></td>
									<td><?=get_phrase('bank');?></td>
									<td><?php echo number_format($balances[1]->opening_balance,2);?></td>
								</tr>
								<tr>
									<td><?php echo $this->db->get_where('settings',array('type'=>'system_start_date'))->row()->description;?></td>
									<td><?=get_phrase('cash');?></td>
									<td><?php echo number_format($balances[0]->opening_balance,2);?></td>
								</tr>
							</tbody>
						</table>
						
					</div>
				
				</div>
		
	</div>
	
</div>

<div class="row">
	<div class="col-xs-6">
	
	      <div class="panel panel-default panel-shadow" data-collapsed="0">
	             <div class="panel-heading">
	                  <div class="panel-title"><?php echo get_phrase('income_categories');?></div>
	             </div>
	             
	             <div class="panel-body">		
		

						<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/income_category_add/');" 
						class="btn btn-primary pull-right">
						<i class="entypo-plus-circled"></i>
						<?php echo get_phrase('add_new_income_category');?>
						</a> 
						<br><br>
						<table class="table table-bordered datatable" id="table_export_1">
						    <thead>
						        <tr>
						            <th><div>#</div></th>
						            <th><div><?php echo get_phrase('name');?></div></th>
						            <th><div><?php echo get_phrase('options');?></div></th>
						        </tr>
						    </thead>
						    <tbody>
						        <?php 
						        	$count = 1;
						        	$incomes = $this->db->get('income_categories')->result_array();
						        	foreach ($incomes as $row):
						        ?>
						        <tr>
						            <td><?php echo $count++;?></td>
						            <td><?php echo $row['name'];?></td>
						            <td>
						                
						                <div class="btn-group">
						                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						                        Action <span class="caret"></span>
						                    </button>
						                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
						                        
						                        <!-- teacher EDITING LINK -->
						                        <li>
						                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/income_category_edit/<?php echo $row['income_category_id'];?>');">
						                            	<i class="entypo-pencil"></i>
															<?php echo get_phrase('edit');?>
						                               	</a>
						                        				</li>
						                        <li class="divider"></li>
						                        
						                        <!-- teacher DELETION LINK -->
						                        <li>
						                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/income_category/delete/<?php echo $row['income_category_id'];?>');">
						                            	<i class="entypo-trash"></i>
															<?php echo get_phrase('delete');?>
						                               	</a>
						                        				</li>
						                    </ul>
						                </div>
						                
						            </td>
						        </tr>
						        <?php endforeach;?>
						    </tbody>
						</table>


				</div>

			</div>

	</div>
	
	
	<div class="col-xs-6">

         <div class="panel panel-default panel-shadow" data-collapsed="0">
              <div class="panel-heading">
                   <div class="panel-title"><?php echo get_phrase('expense_categories');?></div>
              </div>
              
              <div class="panel-body">
		
						<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/expense_category_add/');" 
						class="btn btn-primary pull-right">
						<i class="entypo-plus-circled"></i>
						<?php echo get_phrase('add_new_expense_category');?>
						</a> 
						<br><br>
						<table class="table table-bordered datatable" id="table_export_2">
						    <thead>
						        <tr>
						            <th><div>#</div></th>
						            <th><div><?php echo get_phrase('name');?></div></th>
						            <th><div><?php echo get_phrase('income_category');?></div></th>
						            <th><div><?php echo get_phrase('options');?></div></th>
						        </tr>
						    </thead>
						    <tbody>
						        <?php 
						        	$count = 1;
						        	$expenses = $this->db->get('expense_category')->result_array();
						        	foreach ($expenses as $row):
						        ?>
						        <tr>
						            <td><?php echo $count++;?></td>
						            <td><?php echo $row['name'];?></td>
						            <td><?php echo $this->crud_model->get_income_category_name($row['income_category_id']);?></td>
						            <td>
						                
						                <div class="btn-group">
						                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
						                        Action <span class="caret"></span>
						                    </button>
						                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
						                        
						                        <!-- teacher EDITING LINK -->
						                        <li>
						                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/expense_category_edit/<?php echo $row['expense_category_id'];?>');">
						                            	<i class="entypo-pencil"></i>
															<?php echo get_phrase('edit');?>
						                               	</a>
						                        				</li>
						                        <li class="divider"></li>
						                        
						                        <!-- teacher DELETION LINK -->
						                        <li>
						                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/expense_category/delete/<?php echo $row['expense_category_id'];?>');">
						                            	<i class="entypo-trash"></i>
															<?php echo get_phrase('delete');?>
						                               	</a>
						                        				</li>
						                    </ul>
						                </div>
						                
						            </td>
						        </tr>
						        <?php endforeach;?>
						    </tbody>
						</table>

					</div>

			</div>
		
		</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export_1,#table_export_2").dataTable({
			"sPaginationType": "bootstrap",
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>