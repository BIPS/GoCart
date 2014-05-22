<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$enabled_options = array(0 => lang('disabled'), 1 => lang('enabled'));

?>

<label><?php echo lang('enabled'); ?></label>
<?php echo form_dropdown('enabled', $enabled_options, $settings['enabled'], 'class="span3"'); ?>

<label><?php echo lang('bips_api'); ?>:</label>
<?php echo form_input('bips_api', $settings['bips_api'], 'class="span3"'); ?>

<label><?php echo lang('bips_secret'); ?>:</label>
<?php echo form_input('bips_secret', $settings['bips_secret'], 'class="span3"'); ?>