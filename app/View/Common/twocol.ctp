<?php
  $this->extend('/Common/header');
?>

<div id="content" class="bg11">
	<div class="bg10">
		<div class="bg12 two-cols">
			<div class="colA">
        <?php echo $this->fetch('colA'); ?>
			</div>
			<div class="colB">
        <?php echo $this->fetch('colB'); ?>
        <?php echo $this->fetch('content'); ?>
			</div>
			<div style="clear: both; height: 100px;">&nbsp;</div>
		</div>
	</div>
</div>
