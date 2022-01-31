<?php 
/*
* Filename: template.php
* Filepath: views / components / template.php
* Author: Saddam
*/
?>
<?php $this->load->view('requisitions/commons/new_head'); ?>

<?php $this->load->view($body, $this->access); ?>

<?php $this->load->view('admin/commons/foot'); ?>
