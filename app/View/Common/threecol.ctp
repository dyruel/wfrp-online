<?php
  $this->extend('/Common/header');
?>

<div id="content" class="bg2">
	<div class="bg1">
		<div class="bg3 three-cols">
			<div class="colA">
        <?php echo $this->fetch('colA'); ?>
			</div>
			<div class="colB">
        <?php echo $this->fetch('colB'); ?>
        <?php echo $this->fetch('content'); ?>
			</div>
			<div class="colC">
        <?php echo $this->fetch('colC'); ?>
			</div>
			<div style="clear: both; height: 100px;">&nbsp;</div>
		</div>
	</div>
</div>
