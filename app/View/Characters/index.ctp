<h1><?php echo __('Characters list'); ?></h1>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Race</th>
        <th>Gender</th>
        <th>Career</th>
        <th>Campaign</th>
        <th>Area</th>
        <th>Created</th>
    </tr>

    <?php foreach ($chars as $char): ?>
    <tr>
        <td><?php echo $char['Character']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($char['Character']['name'], array('gm' => false, 'controller' => 'characters','action' => 'manage', $char['Character']['id'])); ?>
        </td>
        <td><?php echo $char['Race']['name']; ?></td>
        <td><?php echo $char['Character']['gender']; ?></td>
        <td><?php echo $char['Career']['name']; ?></td>
        <td><?php echo $char['Campaign']['name']; ?></td>
        <td><?php echo $char['Area']['name']; ?></td>
        <td><?php echo $char['Character']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>




