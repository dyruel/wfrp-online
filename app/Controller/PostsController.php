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

    public function index() {
    	$user = $this->User->find('first', array(
	        'conditions' => array('User.id' => $this->Auth->user('id'),
	        ),
	        'contain' => false
	      ));
	    if (!$user) {
	        throw new NotFoundException(__('Invalid user'));
	    }
		
    	$char = $this->Character->find('first', array(
        'conditions' => array('Character.user_id' => $user['User']['id'], 
                              'Character.campaign_id' => $user['User']['campaign_id']
        ),

        'contain' => array(
            'Race',
            'Career',
            'Rank',
            'CharactersSkillsSkillspec' => array(
              'Skill',
              'Skillspec'
            ),
         )

      ));

    	 if ($this->request->is('post')) {
    	 	$config = HTMLPurifier_Config::createDefault();
    	 	$purifier = new HTMLPurifier($config);

			$dirty_html = $this->request->data['Post']['content'];
			pr($dirty_html);
			$dirty_html = $purifier->purify($dirty_html);
//			$dirty_html = preg_replace('#\[d100\]#', ToolBox::rollDice('1d100'), $dirty_html, 1, $count);
			if(preg_match('#\[d100\]#', $dirty_html)) {
				$dirty_html = $char['Character']['name'].' '.__('throws 1d100 and gets'). ' '.ToolBox::rollDice('1d100+100');
			}
            pr($dirty_html);
        }
         $this->set('posts', $this->Post->find('all'));
 /*
	    $user = $this->User->find('first', array(
	        'conditions' => array('User.id' => $this->Auth->user('id'),
	        ),
	        'contain' => false
	      ));
	    if (!$user) {
	        throw new NotFoundException(__('Invalid user'));
	    }
	
		$t_data = $this->Post->find('all', array(
	        'conditions' => array('Post.area_id' => $user['User']['area_id']
	        ),
	
	        'contain' => array(
	            'Race',
	            'Career',
	            'Rank',
	            'CharactersSkillsSkillspec' => array(
	              'Skill',
	              'Skillspec'
	            ),
	            'CharactersTalentsTalentspec' => array(
	              'Talent',
	              'Talentspec'
	            ),
	         )
	
		));
  * */
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

    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.');
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
