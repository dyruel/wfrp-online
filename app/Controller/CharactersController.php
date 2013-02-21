<?php
App::uses('AppController', 'Controller');
App::uses('ToolBox', 'Lib');

/**
 * Characters Controller
 *
 */
class CharactersController extends AppController {

  public $uses = array('Character', 'User');
//  public $helpers = array('Form');
  public $helpers = array('Js' => array('Jquery'), 'Wizard.Wizard');

  public $components = array('Wizard.Wizard');

//  public $viewClass = 'TwigView.Twig';

  public function beforeFilter() {
      $this->Wizard->steps = array('campaign', 'gender', 'race', 'career', 'portrait', 'misc', 'validation');
  }


  public function wizard($step = null) {
      $this->Wizard->process($step);
  }

  public function _processCampaign() {
  }

  /**
   * index method
   *
   * @return void
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


    $t_data = $this->Character->find('first', array(
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
            'CharactersTalentsTalentspec' => array(
              'Talent',
              'Talentspec'
            ),
         )

      ));

    $t_data['Character']['profile'] = Character::profileFormat($t_data['Character']['profile']);
    $t_data['Character']['money'] = Character::moneyFormat($t_data['Character']['money']);
    $t_data['Career']['profile'] = Career::profileFormat($t_data['Career']['profile']);

    $this->set('t_data', $t_data);
    $this->set('t_statsStr', ToolBox::statsStr());
/*
    pr($user);
    pr($t_data);
*/
	}

  /**
   * view method
   *
   * @return void
   */
  public function view($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Invalid character'));
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
/*
    $t_data = $this->Character->findById($id, array(
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
    ));*/
    if (!$t_data) {
        throw new NotFoundException(__('Invalid character'));
    }

    $t_data['Character']['profile'] = Character::profileFormat($t_data['Character']['profile']);
    $t_data['Character']['money'] = Character::moneyFormat($t_data['Character']['money']);
    $t_data['Career']['profile'] = Career::profileFormat($t_data['Career']['profile']);

    $this->set('t_data', $t_data);
    $this->set('t_statsStr', ToolBox::statsStr());

//    $this->set('post', $post);
  }



}