
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/fees_structure_add/');" 
class="btn btn-primary pull-right">
<i class="entypo-plus-circled"></i>
<?php echo get_phrase('add_new_fees_structure');?>
</a> 
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('class');?></div></th>
            <th><div><?php echo get_phrase('year');?></div></th>
            <th><div><?php echo get_phrase('term');?></div></th>
            <th><div><?php echo get_phrase('amount_payable');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        	$count = 1;
        	$fees = $this->db->get('fees_structure')->result_array();
        	foreach ($fees as $row):
        ?>
        <tr>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $this->crud_model->get_class_name($row['class_id']);?></td>
            <td><?php echo $row['yr'];?></td>
            <td><?php echo $this->db->get_where('terms',array('term_number'=>$row['term']))->row()->name;?></td>
            <td><?=number_format($this->db->select_sum('amount')->get_where('fees_structure_details',array('fees_id'=>$row['fees_id']))->row()->amount,2);?></td>
            <td>
                
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        
                        <!-- Fee Structure Edit Link -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_fees_structure_edit/<?php echo $row['fees_id'];?>');">
                            	<i class="entypo-pencil"></i>
									<?php echo get_phrase('edit');?>
                               	</a>
                        				</li>
                        <li class="divider"></li>
                        
                        <!-- Add Fees Structure Details -->
                         <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_fees_structure_details/<?php echo $row['fees_id'];?>');">
                            	<i class="entypo-book-open"></i>
									<?php echo get_phrase('add_item');?>
                               	</a>
                        </li>
                        <li class="divider"></li>
                        
                        
                        <!-- VIEW FEES STRUCTURE DETAILS -->
 
                          <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_fees_structure/<?php echo $row['fees_id'];?>');">
                            	<i class="entypo-eye"></i>
									<?php echo get_phrase('view_fees_structure');?>
                               	</a>
                        				</li>
                        <li class="divider"></li>                            
                        
                        <!-- Clone Structure Details -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/poup/modal_clone_structure/<?php echo $row['fees_id'];?>');">
                            	<i class="entypo-cc"></i>
									<?php echo get_phrase('clone_fees_structure');?>
                               	</a>
                        </li>
                        
                        <li class="divider"></li>                     
                        
                        <!-- DELETION LINK -->
                        <li>
                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/fees_structure/delete/<?php echo $row['fees_id'];?>');">
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



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [1,2,3,4,5]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2,3,4,5]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(2, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(2, true);
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

