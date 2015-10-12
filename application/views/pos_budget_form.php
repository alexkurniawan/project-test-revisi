<?php $this->load->view('_header'); ?>

<div>
<?php if (isset($row->id)) : ?><h2>Edit</h2>
<?php else : ?><h2>Add</h2>
<?php endif; ?>

<?php echo form_open(); ?>

<div class="field"><label>Alokasi: </label><div><?php echo form_input('alokasi', (isset($row->alokasi)) ? $row->alokasi : '' ); ?> <?php echo form_error('alokasi'); ?></div></div>
<div class="field"><label>Tahun: </label><div><?php echo form_input('tahun', (isset($row->tahun)) ? $row->tahun : '' ); ?> <?php echo form_error('alokasi'); ?></div></div>
<div class="field"><label>Bulan: </label><div><?php echo form_input('bulan', (isset($row->bulan)) ? $row->bulan : '' ); ?> <?php echo form_error('alokasi'); ?></div></div>
<div class="field"><label>Amount: </label><div><?php echo form_input('amount', (isset($row->amount)) ? $row->amount : '' ); ?> <?php echo form_error('alokasi'); ?></div></div>
<?php echo form_submit('submit', 'Submit'); ?>

<?php echo form_close(); ?>

</div>

<?php $this->load->view('_footer'); ?>