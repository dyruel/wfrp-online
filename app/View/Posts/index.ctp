<!-- File: /app/View/Posts/index.ctp -->

<?php 
//$this->extend('/Common/threecol');

// $this->extend('/Common/twocol');

echo $this->Html->script('post', array('inline' => false)); 

?>



<h1>Blog posts</h1>
<p><?php echo $this->Html->link('Add Post', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Area</th>
        <th>Author</th>
        <th>Campaign</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['body'], array('action' => 'view', $post['Post']['id'])); ?>
        </td>
        <td><?php echo $post['Area']['name']; ?></td>
        <td><?php echo $post['Character']['name']; ?></td>
        <td><?php echo $post['Character']['campaign_id']; ?></td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $post['Post']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>
        </td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>


	
<div id="rpg-tabs">
	<ul>
	  <li><a href="#rpg-tabs-1"><?php echo __('Add Post'); ?></a></li>
	  <li><a href="#rpg-tabs-2"><?php echo __('Skill test'); ?></a></li>
	</ul>
	
	<div id="rpg-tabs-1">	
	<?php echo $this->Form->create('Post');?>
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
	            'label' => 'Content'
	            ),array(
	                'language'=>'en'
	            ),
	            'rpg'
	        );
	    ?>
	    </fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
	</div>
	<div id="rpg-tabs-2">
		hello
	</div>
	
</div>