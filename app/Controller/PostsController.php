<?php

// App::uses('HTMLPurifier.auto', 'Vendor/htmlpurifier/library/');

App::import('Vendor', null, array
(
    'file' => 'htmlpurifier'.DS.'library'.DS.'HTMLPurifier.auto.php'
));
App::uses('ToolBox', 'Lib');

class PostsController extends AppController {
    public $helpers = array('Tinymce');
	public $uses = array('Post', 'User', 'Character');
	/*
	public $arrayBBCode=array(
	    ''=>         array('type'=>BBCODE_TYPE_ROOT,  
	                       'childs'=>'!i'),
	    'd100'=>        array('type'=>BBCODE_TYPE_NOARG, 
	                       'open_tag'=>'<b>', 
	                       'close_tag'=>'</b>'),
	    'u'=>        array('type'=>BBCODE_TYPE_NOARG, 
	                       'open_tag'=>'<u>', 
	                       'close_tag'=>'</u>', 
	                       'flags'=>BBCODE_FLAGS_SMILEYS_OFF),
	    'i'=>        array('type'=>BBCODE_TYPE_NOARG, 
	                       'open_tag'=>'<i>', 
	                       'close_tag'=>'</i>', 
	                       'childs'=>'b'),
	);
*/

  public static function process_post($str) {
 	$purifier = new HTMLPurifier(HTMLPurifier_Config::createDefault());

	$str = $purifier->purify($str);

	if(preg_match('#\[d100\]#', $str)) {
		$str = $char['Character']['name'].' '.__('throws 1d100 and gets'). ' '.ToolBox::rollDice('1d100');
	}
	else {
		$count = 0;
		$str = preg_filter('#\[skill([1-9]+[0-9]*)\]#', $char['Character']['name'].' '.__('throws 1d100 and gets'), $str, 1, $count);	
	}

	/*
	if(preg_match('#\[skill([1-9]+[0-9]*)\]#', $dirty_html)) {
		$dirty_html = $char['Character']['name'].' '.__('throws 1d100 and gets'). ' '.ToolBox::rollDice('1d100');
	}*/
	
	return $str;
  }

    public function index($campaign_id = null, $area_id = null) {
	  	if (!$campaign_id || !$area_id || 
	  		!preg_match("#^[1-9]+[0-9]*$#", $campaign_id) || 
	  		!preg_match("#^[1-9]+[0-9]*$#", $area_id)) {
	    	throw new NotFoundException(__('Unknown area and/or campaign'));
	    }

		$this->paginate = array(
		    'conditions' => array(
		    	'Post.campaign_id' => $campaign_id,
		    	'Post.area_id' => $area_id
			),
		    'limit' => 5
		);
		$posts = $this->paginate('Post');
	    if (!$posts) {
	        throw new NotFoundException(__('No posts'));
	    }

        $this->set('posts', $posts);
		$this->set('campaign_id', $campaign_id);
		$this->set('area_id', $area_id);
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }

    public function add($campaign_id = null, $area_id = null) {
	  	if (!$campaign_id || !$area_id || 
	  		!preg_match("#^[1-9]+[0-9]*$#", $campaign_id) || 
	  		!preg_match("#^[1-9]+[0-9]*$#", $area_id)) {
	    	throw new NotFoundException(__('Unknown area and/or campaign'));
	    }
			
        if ($this->request->is('post')) {
			$input = h($this->request->data['Post']['content']);
			
			$this->Post->create();
			
			$xmlPost = Xml::build('<?xml version="1.0"?><root></root>');
			$xmlPost->addChild('name', $char != null ? $char['Character']['name'] : __('GM'));
			$xmlPost->addChild('race', $char['Race']['name']);
			$xmlPost->addChild('career', $char['Career']['name']);
			$xmlPost->addChild('rank', $char['Rank']['name']);
			$xmlPost->addChild('gender', $char['Character']['gender']);
			$xmlPost->addChild('text', $input);
			
			if($this->Post->save(array(
					'body' => $xmlPost->asXML(), 
					'character_id' => $char != null ? $char['Character']['id'] : 0,
					'area_id' => $char['Character']['area_id'],
					'campaign_id' => $user['User']['campaign_id'],						
				))) {
				$this->Session->setFlash(__('Action performed.'));
			} else {
				$this->Session->setFlash(__('Unable to post.'));
			}
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Post->id = $id;
            pr($this->request->data);
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Your post has been updated.');
//                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update your post.');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id)) {
            $this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
    }
}

?>
