<?php
App::uses('AppController', 'Controller');
// App::uses('ToolBox', 'Lib');

/**
 * Campaigns Controller
 *
 */
class CampaignsController extends AppController {
	public $uses = array('Character');
	
	public function index() {
    	$char = $this->Character->find('first', array(
	        'conditions' => array('Character.user_id' => $this->Auth->user('id'), 
	                              'Character.campaign_id' => $this->Auth->user('campaign_id')
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
	            'Campaign'
	         )
		 ));

		 $xml = Xml::build($char['Campaign']['xml']);
		foreach ($xml->posts as $posts) {
		   if($posts['area_id'] == $char['Character']['area_id']) {
		   	echo $char['Area']['name'];
		   	break;
		   }
		}		 
	}
	
}

?>
