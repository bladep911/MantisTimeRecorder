<?php

layout_page_header( plugin_lang_get( 'configuration' ) );
layout_page_begin();
$t_foo_or_bar = plugin_config_get( 'foo_or_bar' );

?>

<br/>

<form action="<?php echo plugin_page( 'config_update' ) ?>" method="post">
<?php echo form_security_field( 'plugin_Example_config_update' ) ?>
<table class="width60">

<tr>
    <td class="form-title" rowspan="2"><?php echo plugin_lang_get( 'configuration' ) ?></td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
    <td class="category"><php echo plugin_lang_get( 'foo_or_bar' ) ?></td>
    <td><input name="foo_or_bar" value="<?php echo string_attribute( $t_foo_or_bar ) ?>"/></td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
    <td class="category"><php echo plugin_lang_get( 'reset' ) ?></td>
    <td><input type="checkbox" name="reset"/></td>
</tr>

<tr>
    <td class="center" rowspan="2"><input type="submit"/></td>
</tr>

</table>
</form>

<?php
layout_page_end();
?>