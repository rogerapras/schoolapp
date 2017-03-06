<?php
print_r($this->db->get_where('cashbook',array('batch_number'=>$param2))->result_object());
?>