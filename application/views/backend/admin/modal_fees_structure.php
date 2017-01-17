<?php
$structure_details = $this->db->get_where('fees_structure_details', array('fees_id' => $param2))->result_array();
//foreach ($edit_data as $row):
?>
<center>
    <a onClick="PrintElem('#invoice_print')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
        Fees Structure
        <i class="entypo-print"></i>
    </a>
</center>

    <br><br>

    <div id="invoice_print">
<table class="table table-bordered datatable" id="table_export">
<?php
	$structure = $this->db->get_where("fees_structure",array("fees_id"=>$param2))->row()->name;
?>
<caption><?php echo $structure;?></caption>
    <thead>
        <tr>
        	<th><div><?php echo get_phrase('action');?></div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('amount');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        	//$fees = $this->db->get_where('fees_structure_details',array("fees_id"=>$param2))->result_array();
        	foreach ($structure_details as $row):
        ?>
        <tr>
        	<td>
        		<div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-left" role="menu">
                        
                        <!-- Fee Structure Edit Link -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_structure_details_edit/<?php echo $row['detail_id'];?>');">
                            	<i class="entypo-pencil"></i>
									<?php echo get_phrase('edit');?>
                               	</a>
                        				</li>
                        
                        <li class="divider"></li>                     
                        
                        <!-- DELETION LINK -->
                        <li>
                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/fees_structure_details/delete/<?php echo $row['detail_id'];?>');">
                            	<i class="entypo-trash"></i>
									<?php echo get_phrase('delete');?>
                               	</a>
                        				</li>
                    </ul>
                </div>
        	</td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['amount'];?></td>

        </tr>
        <?php endforeach;?>
    </tbody>
</table>

    </div>
<?php //endforeach; ?>


<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'invoice', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>