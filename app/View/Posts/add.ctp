<?php 
$this->Html->script('tiny_mce/tiny_mce', array('inline' => false));

$this->Html->scriptStart(array('inline' => false));
echo "
tinyMCE.init({
    theme : 'advanced',
    theme_advanced_buttons1 : 'bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,undo,redo',
    theme_advanced_buttons2 : '',
    theme_advanced_buttons3 : '',
    theme_advanced_toolbar_location : 'top',
    theme_advanced_toolbar_align : 'left',
    theme_advanced_statusbar_location : 'bottom',
    mode: 'exact',
    elements:'". $this->Form->domId('Post.text')."'
});
";
$this->Html->scriptEnd();

?>

<h1>Post a reply <?php echo $char['Character']['name']; ?></h1>

<?php if(isset($xmlPost)): ?>
<p>
	<?php echo $xmlPost->asXML(); ?>
</p>
<?php endif; ?>

<?php echo $this->Form->create();?>
<fieldset>
<?php
    echo $this->Form->input('text',array('type' => 'textarea'));
?>
</fieldset>
<p>
<?php
	echo $this->Form->submit('Preview', array('name'=>'preview')); 
	echo $this->Form->submit('Submit', array('name'=>'submit'))
?>
</p>
<?php echo $this->Form->end();?>
