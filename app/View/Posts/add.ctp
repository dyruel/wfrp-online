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
    elements:'". $this->Form->domId('Post.content')."'
});
";
$this->Html->scriptEnd();

?>

<h1>Post a reply</h1>
<?php echo $this->Form->create();?>
    <fieldset>
    <?php
        echo $this->Form->input('Post.content',array('type' => 'textarea'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>
