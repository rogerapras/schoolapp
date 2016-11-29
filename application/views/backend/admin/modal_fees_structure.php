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