<!-- File: /app/View/Posts/index.ctp -->

<?php 
//$this->extend('/Common/threecol');

// $this->extend('/Common/twocol');

echo $this->Html->script('post', array('inline' => false)); 

?>



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

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): /*echo pr($post);*/ ?>
    	
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $post['Post']['body']; /*echo $this->Html->link($post['Post']['body'], array('action' => 'view', $post['Post']['id']));*/ ?>
        </td>
        <td><?php echo $post['Area']['name']; ?></td>
        <td><?php echo $post['Character']['name']; ?></td>
        <td><?php echo $post['Campaign']['name']; ?></td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>


	
<?php echo $this->Form->create('Post', array('controller' => 'campaigns'));?>
    <fieldset>
    <?php
 //       echo $this->Form->input('title');
	$str = "tinymce.create('tinymce.plugins.ExamplePlugin', {
    createControl: function(n, cm) {
        switch (n) {
            case 'mylistbox':
                var mlb = cm.createListBox('mylistbox', {
                     title : 'My list box',
                     onselect : function(v) {
                         tinyMCE.activeEditor.windowManager.alert('Value selected:' + v);
                     }
                });

                // Add some values to the list box
                mlb.add('Some item 1', 'val1');
                mlb.add('some item 2', 'val2');
                mlb.add('some item 3', 'val3');

                // Return the new listbox instance
                return mlb;
        }

        return null;
    }
});";
 
        echo $this->Tinymce->input('Post.content', array(
            'label' => 'Write'
            ),array(
                'language'=>'en'
            ),
            'rpg'
        );
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));?>

	