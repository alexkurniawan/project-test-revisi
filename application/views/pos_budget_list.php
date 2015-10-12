<?php $this->load->view('_header'); ?>

<div>
<h2>List</h2>
<?php if (isset($nav)) echo $nav; ?>
<?php if (isset($list)) echo $list; ?>
</div>

<?php $this->load->view('_footer'); ?>