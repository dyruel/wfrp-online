<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>

<!DOCTYPE html>
<head>
<?php echo $this->Html->charset(); ?>
<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<?php
	echo $this->Html->meta('icon');

	echo $this->Html->css('cake.generic');
	echo $this->Html->css('ui-lightness/jquery-ui-1.10.0.custom.min');
//	echo $this->Html->css('style');
//	echo $this->Html->css('default');
//	echo $this->Html->css('layout');
  echo $this->Html->script('jquery-1.9.0');
  echo $this->Html->script('jquery-ui-1.10.0.custom.min');
//  echo $this->Html->script('tiny_mce');
  
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
?>
</head>
<body>

<div id="container">
	<div id="header">
		<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
	</div>
	<div id="content">
		<div class="actions">
			<?php echo $this->Html->nestedList(array(
				$this->Html->link('Characters', array('gm' => false, 'controller' => 'characters', 'action' => 'index')),
				$this->Html->link('Campaign', array('gm' => false, 'controller' => 'campaigns', 'action' => 'index')),
				$this->Html->link('Logout', array('gm' => false, 'controller' => 'users', 'action' => 'logout')),
				$this->Html->link('GM/Campaign', array('gm' => true, 'controller' => 'campaigns', 'action' => 'index')),
				$this->Html->link('GM/skilltest', array('gm' => true, 'controller' => 'characters', 'action' => 'skilltest')),
			)); ?>
		</div>
		<div class="index">
			<?php echo $this->Session->flash(); ?>
	
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<div id="footer">
		<?php echo $this->Html->link(
				$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
				'http://www.cakephp.org/',
				array('target' => '_blank', 'escape' => false)
			);
		?>
		<?php echo $this->Html->link(
				$this->Html->image('smarty.png', array('alt' => 'Smarty template engine', 'border' => '0')),
				'http://www.smarty.net',
				array('target' => '_blank', 'escape' => false)
			);
		?>
	</div>
</div>

<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>

