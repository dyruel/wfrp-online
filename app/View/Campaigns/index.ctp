<?php 
$this->Html->script('tiny_mce/tiny_mce', array('inline' => false));

$this->Html->scriptStart(array('inline' => false));
echo "
// Initialize TinyMCE with the new plugin and listbox
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

<h1><?php echo __('You are at %s', $char['Area']['name']); ?></h1>

<h1>Logs</h1>

<table>
    <tr>
        <th>Date</th>
        <th>Text</th>
    </tr>
    <?php foreach ($logs as $log): /*echo pr($post);*/ ?>
    	
    <tr>
        <td><?php echo $log->date; ?></td>
        <td><?php echo $log->text; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<h1>Posts</h1>


<table>
    <tr>
        <th>Id</th>
        <th>Text</th>
        <th>Area</th>
        <th>Author</th>
        <th>Campaign</th>
        <th>Created</th>
    </tr>

    <?php foreach ($posts as $post): /*echo pr($post);*/ ?>
    	
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $post['Post']['body']; /*echo $this->Html->link($post['Post']['body'], array('action' => 'view', $post['Post']['id']));*/ ?>
        </td>
        <td><?php echo $post['Area']['name']; ?></td>
        <td><?php echo intval($post['Character']['id']) > 0 ? $this->Html->link($post['Character']['name'], array('controller' => 'characters', 'action' => 'view', $post['Character']['id'])) : __('GM'); ?></td>
        <td><?php echo $post['Campaign']['name']; ?></td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<p>
<?php
	echo $this->Paginator->numbers(); 
?>
</p>
	
<?php echo $this->Form->create('Post', array('controller' => 'campaigns'));?>
    <fieldset>
    <?php
        echo $this->Form->input('Post.content',array('label' => 'Write', 'type' => 'textarea'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>

	