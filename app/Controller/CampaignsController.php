<?php
App::uses('AppController', 'Controller');
App::uses('ToolBox', 'Lib');


/**
 * Campaigns Controller
 *
 */
class CampaignsController extends AppController {
	public $uses = array('User', 'Post', 'Character','Campaign');
	
	public function index() {
		$user = null;
		$char = null;
		
    	$user = $this->User->find('first', array(
	        'conditions' => array('User.id' => $this->Auth->user('id'),
	        ),
	        'contain' => array(
	            'ACampaign',
	         )
	      ));
	    if (!$user) {
	        throw new NotFoundException(__('Invalid user'));
	    }
		
		if(intval($user['ACampaign']['user_id']) != intval($user['User']['id'])) { // Is GM ?
			$char = $this->Character->find('first', array(
	        'conditions' => array('Character.user_id' => $user['User']['id'], 
	                              'Character.campaign_id' => $user['User']['campaign_id']
	        ),
	        'contain' => array(
	            'Race',
	            'Career',
	            'Rank',
	            'Area',
	         )
	        ));
		    if (!$char) {
		        throw new NotFoundException(__('Invalid character'));
		    }			
		}
		
		$xml = Xml::build($user['ACampaign']['logs']);

		if ($this->request->is('post')) {
			$input = h($this->request->data['Post']['content']);
//			pr($input);
			
			if($char != null && preg_match('#\[d100\]#', $input)) {
				$log = $xml->addChild('log');
				$log->addChild('date', date('d-m-Y (H:i:s)'));
				$log->addChild('text', __('%s throws 1d100 and gets %s', $char['Character']['name'], ToolBox::rollDice('1d100')));
				if($this->Campaign->save(array('id'=> $user['User']['campaign_id'], 'logs' => $xml->asXML()))) {
					$this->Session->setFlash(__('Action performed.'));
				} else {
					$this->Session->setFlash(__('Unable to perform the action.'));
				}
			} else { // Regular post
				$this->Post->create();
				if($this->Post->save(array(
						'body' => $input, 
						'character_id' => $char != null ? $char['Character']['id'] : 0,
						'user_id' => $user['User']['id'],
						'area_id' => $char['Character']['area_id'],
						'campaign_id' => $user['User']['campaign_id'],						
					))) {
					$this->Session->setFlash(__('Action performed.'));
				} else {
					$this->Session->setFlash(__('Unable to perform the action.'));
				}				
			}
		
			// Parse the input
			//$input = preg_filter("#^[1-9]+d[1-9]+[0-9]*(\+[0-9]+)?$#", ToolBox::rollDice('1d100'), $input);

       	}

		$posts = $this->Post->find('all', array(
	        'conditions' => array('Post.campaign_id' => $user['User']['campaign_id'],
	        					  'Post.area_id' => $char['Character']['area_id'],
	        )
		));

		$this->set('logs', $xml->log);
		$this->set('posts', $posts);
		$this->set('char', $char);
		
/*
		pr($user);
		pr($char);
 */
	 
	}
	
}

?>
