<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

//  public $uses = array('Character', 'Campaign');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}
*/
/**
 * add method
 *
 * @return void
 */
/*
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}
*/
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}
*/
/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
/*
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
*/

	public function load() {

    if ($this->request->is('post')) {
      $this->User->id = $this->Auth->user('id');
      if ($this->User->save($this->request->data)) {
          $this->Session->setFlash(__('Your campaign is loaded.'));
//            $this->redirect(array('action' => 'index'));
      } else {
          $this->Session->setFlash(__('Unable to load your campaign.'));
      }
    }


    $user = $this->User->find('first', array(
        'conditions' => array('User.id' => $this->Auth->user('id'),
        ),
      ));
    if (!$user) {
        throw new NotFoundException(__('Invalid user'));
    }

//    pr($user);

    $this->set('t_data', $user);
	}

  public function login() {
 	if($this->Auth->loggedIn()) {
 		$this->redirect($this->Auth->redirect());
 	} else {
      if ($this->request->is('post')) {
          if ($this->Auth->login()) {
              $this->redirect($this->Auth->redirect());
          } else {
              $this->Session->setFlash(__('Nom d\'user ou mot de passe invalide, réessayer'));
          }
      } 		
 	}
  }

  public function logout() {
      $this->redirect($this->Auth->logout());
  }
  /*
  	public function gm_index() {

	}*/
}
