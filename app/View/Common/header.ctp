<div id="header">
	<div id="logo">
		<h1>Website Name</h1>
		<h2><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h2>
	</div>
	<div id="main-menu">
		<ul>
			<li><a href="#" id="main-menu1" accesskey="1" title=""><b>News</b></a></li>
			<li><a href="#" id="main-menu2" accesskey="2" title=""><b>About</b></a></li>
			<li><a href="#" id="main-menu3" accesskey="3" title=""><b>Forum</b></a></li>
			<li><a href="#" id="main-menu4" accesskey="4" title=""><b>Contact</b></a></li>
		</ul>
	</div>
</div>

<?php echo $this->fetch('content'); ?>
