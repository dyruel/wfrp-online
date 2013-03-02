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