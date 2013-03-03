<!-- File: /app/View/Posts/index.ctp -->

<?php 
//$this->extend('/Common/threecol');

// $this->extend('/Common/twocol');

// echo $this->Html->script('post', array('inline' => false)); 

?>



<h1>Blog posts</h1>

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
<?php echo $this->Html->link('Post a Reply', array('gm' => false, 'controller' => 'posts', 'action' => 'add', $campaign_id, $area_id)); ?>
<p>

</p>


	