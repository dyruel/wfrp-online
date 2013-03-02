<?php 

$this->Html->script('tiny_mce/tiny_mce', array('inline' => false));

$this->Html->scriptStart(array('inline' => false));
echo "
tinymce.create('tinymce.plugins.ExamplePlugin', {
    createControl: function(n, cm) {
        switch (n) {
            case 'mylistbox':
                var mlb = cm.createListBox('mylistbox', {
                     title : '".__('Skill test')."',
                     onselect : function(v) {
//                         tinyMCE.activeEditor.windowManager.alert('Value selected:' + v);
                         tinyMCE.activeEditor.execCommand('mceInsertContent', false, v);
                     }
                });
";

 
foreach ($char['CharactersSkillsSkillspec'] as $skill):
	$skill_name = $skill['Skill']['name'];
	$skill_id = $skill['skill_id'].'-'.$skill['skillspec_id'];
	if(intval($skill['skillspec_id']) > 0) {
		$skill_name .= ':'.$skill['Skillspec']['name'];
	}
	
				echo "mlb.add('".$skill_name."', '[skill=".$skill_id."]');";
endforeach;

echo "
                // Return the new listbox instance
                return mlb;

            case 'mysplitbutton':
                var c = cm.createSplitButton('mysplitbutton', {
                    title : 'My split button',
                    image : 'img/example.gif',
                    onclick : function() {
                        tinyMCE.activeEditor.windowManager.alert('Button was clicked.');
                    }
                });

                c.onRenderMenu.add(function(c, m) {
                    m.add({title : 'Some title', 'class' : 'mceMenuItemTitle'}).setDisabled(1);

                    m.add({title : 'Some item 1', onclick : function() {
                        tinyMCE.activeEditor.windowManager.alert('Some  item 1 was clicked.');
                    }});

                    m.add({title : 'Some item 2', onclick : function() {
                        tinyMCE.activeEditor.windowManager.alert('Some  item 2 was clicked.');
                    }});
                });

                // Return the new splitbutton instance
                return c;
        }

        return null;
    }
});

// Register plugin with a short name
tinymce.PluginManager.add('example', tinymce.plugins.ExamplePlugin);

// Initialize TinyMCE with the new plugin and listbox
tinyMCE.init({
    plugins : '-example', // - tells TinyMCE to skip the loading of the plugin
    theme : 'advanced',
    theme_advanced_buttons1 : 'mylistbox,mysplitbutton,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,undo,redo,link,unlink',
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
        <th>Title</th>
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
        <td><?php echo intval($post['Character']['id']) > 0 ? $post['Character']['name'] : __('GM'); ?></td>
        <td><?php echo $post['Campaign']['name']; ?></td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<p><?php echo $this->Paginator->numbers(); ?></p>
	
<?php echo $this->Form->create('Post', array('controller' => 'campaigns'));?>
    <fieldset>
    <?php
        echo $this->Form->input('Post.content',array('label' => 'Write', 'type' => 'textarea'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>

	