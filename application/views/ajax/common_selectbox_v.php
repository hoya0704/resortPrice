<?php
foreach ($list as $lt)
{
?>					
	<option value="<?php echo $lt -> code_cn;?>"><?php echo $lt -> code_name;?></option>
<?php
}
?>