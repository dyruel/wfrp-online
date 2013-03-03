<?php
App::uses('AppController', 'Controller');
App::uses('ToolBox', 'Lib');

/**
 * Characters Controller
 *
 */
class CharactersController extends AppController {

  public $uses = array('Character', 'User', 'Skill');
  public $helpers = array('Js' => array('Jquery'));


  /**
   * index method
   *
   * @return void
   */
	public function index() {
	    $chars = $this->Character->find('all', array(
	        'conditions' => array('Character.user_id' => $this->Auth->user('id')),
	
	        'contain' => array(
	            'Race',
	            'Career',
	            'Rank',
	            'Campaign',
	            'Area',
	         )
	
	     ));

		$this->set('chars', $chars);
	}

  public function manage($id = null) {
  	if (!$id || !preg_match("#^[1-9]+[0-9]*$#", $id)) {
    	throw new NotFoundException(__('Unknown character'));
    }
	
    $char = $this->Character->find('first', array(
        'conditions' => array(
        	'Character.user_id' => $this->Auth->user('id'),
        	'Character.id' => $id
		),

        'contain' => array(
            'Race',
            'Career',
            'Rank',
            'Campaign',
            'Area',           
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
	 if (!$char) {
     	throw new NotFoundException(__('Unknown character'));
     }
	
	// TODO Use XML format
    $char['Character']['profile'] = Character::profileFormat($char['Character']['profile']);
    $char['Character']['money'] = Character::moneyFormat($char['Character']['money']);
    $char['Career']['profile'] = Career::profileFormat($char['Career']['profile']);

    $this->set('char', $char);
    $this->set('t_statsStr', ToolBox::statsStr());	 
	 
  }

  /**
   * view method
   *
   * @return void
   */
  public function view($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Unknown character'));
    }


    $t_data = $this->Character->find('first', array(
        'conditions' => array('Character.id' => $id
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

    if (!$t_data) {
        throw new NotFoundException(__('Unknown character'));
    }

    $t_data['Character']['profile'] = Character::profileFormat($t_data['Character']['profile']);
    $t_data['Character']['money'] = Character::moneyFormat($t_data['Character']['money']);
    $t_data['Career']['profile'] = Career::profileFormat($t_data['Career']['profile']);

    $this->set('t_data', $t_data);
    $this->set('t_statsStr', ToolBox::statsStr());
  }


  /**
   * skilltest method
   *
   * @return void
   */
  public function gm_skilltest($id = null) {
  	if (!$id || !preg_match("#^[1-9]+[0-9]*$#", $id)) {
    	throw new NotFoundException(__('Unknown character'));
    }
/*
    $user = $this->User->find('first', array(
        'conditions' => array('User.id' => $this->Auth->user('id'),
        ),
        'contain' => false
      ));
    if (!$user) {
        throw new NotFoundException(__('Invalid user'));
    }
*/
//	pr($user);
    $char = $this->Character->find('first', array(
        'conditions' => array('Character.id' => $id,
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
//	 pr($char);
	  
    $baseSkills = $this->Skill->find('all', array(
        'conditions' => array('Skill.type' => '0'
        )
     ));	  
//	pr($chars);

	if($this->request->is('post')) {
		pr($this->request->data);
	}
	
	$this->set('char', $char);
	$this->set('baseSkills', $baseSkills);
  }

  /**
   * give method
   *
   * @return void
   */
  public function gm_give() {
  	
  }

}
