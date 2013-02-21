<!-- File: /app/View/Posts/view.ctp -->

<?php 
$this->extend('/Common/threecol');

echo $this->element('post', array(
    'posttitle' => h($post['Post']['title']),
    'postauthor' => $post['Post']['character_id'],
    'postdate' => $post['Post']['created'],
    'postcontent' => h($post['Post']['body']),
    'postauthorurl' => '#'
));

?>

