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
		$author = '';
		
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
	            'CharactersSkillsSkillspec' => array(
	              'Skill',
	              'Skillspec'
	            ),	            
	         )
	        ));
		    if (!$char) {
		        throw new NotFoundException(__('Invalid character'));
		    }
		}
		
//pr($char);
		
		$xml = Xml::build($user['ACampaign']['logs']);

		if ($this->request->is('post')) {
			$input = h($this->request->data['Post']['content']);
			
			if($char != null && preg_match('#\[d100\]#', $input)) {
				$log = $xml->addChild('log');
				$log->addChild('date', date('d-m-Y (H:i:s)'));
				$log->addChild('text', __('%s throws 1d100 and gets %s', $char['Character']['name'], ToolBox::rollDice('1d100')));
				if($this->Campaign->save(array('id'=> $user['User']['campaign_id'], 'logs' => $xml->asXML()))) {
					$this->Session->setFlash(__('Action performed.'));
				} else {
					$this->Session->setFlash(__('Unable to perform the action.'));
				}
			} else if($char != null && preg_match('#\[skill=([1-9]+)\-([0-9]+)\]#', $input, $matches)) {
//pr($matches);
				$flag = false;
				$skill_name = '';
				foreach($char['CharactersSkillsSkillspec'] as $skill) {
					if(intval($skill['skill_id']) == intval($matches[1]) && intval($skill['skillspec_id']) == intval($matches[2])) {
						$skill_name = $skill['Skill']['name'];
						if(intval($skill['skillspec_id']) > 0) {
							$skill_name .= ':'.$skill['Skillspec']['name'];
						}
						$flag = true;
						break;
					}
				}
				if(!$flag) {
					throw new NotFoundException(__('Invalid skill test'));
				}
				
				$log = $xml->addChild('log');
				$log->addChild('date', date('d-m-Y (H:i:s)'));
				$log->addChild('text', __('%s tries %s and gets %s', $char['Character']['name'], $skill_name, ToolBox::rollDice('1d100')));
				if($this->Campaign->save(array('id'=> $user['User']['campaign_id'], 'logs' => $xml->asXML()))) {
					$this->Session->setFlash(__('Action performed.'));
				} else {
					$this->Session->setFlash(__('Unable to perform the action.'));
				}				
			} else { // Regular post
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
					$this->Session->setFlash(__('Unable to perform the action.'));
				}				
			}
       	}

		$this->paginate = array(
	        'conditions' => array('Post.campaign_id' => $user['User']['campaign_id'],
	        					  'Post.area_id' => $char['Character']['area_id'],
	        ),
		    'limit' => 5
		);
		$posts = $this->paginate('Post');


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
