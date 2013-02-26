<!-- File: /app/View/Posts/index.ctp -->

<?php 
//$this->extend('/Common/threecol');
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

<div class="posts form">
<?php echo $this->Form->create('Post');?>
    <fieldset>
        <legend><?php echo __('Add Post'); ?></legend>
    <?php
 //       echo $this->Form->input('title');
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
