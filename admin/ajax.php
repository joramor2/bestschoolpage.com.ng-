<?php include('../config.php'); 
$validate=new Validation();
if($_POST['action']=="getclass")
{ ?>
		
	<label class="col-lg-2 control-label " for="userName">Select Class:</label>
	<div class="col-lg-10">
	<?php
	$iclass=$db->getRows("select * from school_class where section_id='".$_POST['sec_id']."'");
	foreach($iclass as $list)
	{
	?>
	<input type="checkbox" name="class[]" class="classList" onchange="getsubject()" value="<?php echo $list['id'];?>">
	<?php echo $list['name'];?>

	<?php } ?>

	</div>
<?php }
 elseif($_POST['action']=="getsection")
		{ 
		?>
		<select name="section" id="section" class="form-control" onchange="getclass()">
		<option value="">select section</option>
		<?php
		$isection=$db->getRows("select * from school_section where id='".$_POST['ses_id']."'");
		foreach($isection as $list)
		{?>
		<option value="<?php echo $list['id'];?>"<?php if($_POST['section']==$list['id']){echo "selected";}?>>
		<?php echo $list['section'];?></option>
		<?php } ?>
		</select>
		<?php
		}

elseif($_POST['action']=="getsubject")
		{ 
		$iclass=$_POST['class_iid'];
		$icc=explode(",",$iclass);
		$i=0;
		?>
		<select name="subject"  class="form-control">
		<option value="">select subject</option>
		<?php
		foreach($icc as $iclasses ){
		$isubject=$db->getRows("select * from school_subject where class_id='$iclasses'order by id desc");
		foreach($isubject as $list)
		{
			?>
		<option value="<?php echo $list['id'];?>"<?php if($_POST['subject']==$list['id']){echo "selected";}?>>
		<?php echo $list['subject'];?></option>
		<?php } ?>
		</select>
		<?php
		} }
elseif($_POST['action']=="getsubclass")
{
$sub2 =$db->getRows("select * from school_class where section_id='".$_POST['sec_id']."'");

?>
<option value="">select class</option>
<?php
foreach($sub2 as $sub2)
{
?>
<option value="<?php echo $sub2['id'];?>"><?php echo $sub2['name'];?></option>
<?php
}}
?>
