<?php
namespace Jo\Blog\Controller;

use TYPO3\Flow\Annotations as Flow;

/**
 * LoginController
 *
 * Handles all stuff that has to do with the login
 */
class LoginController extends \TYPO3\Flow\Mvc\Controller\ActionController {

    /**
     * @var \TYPO3\Flow\Security\Authentication\AuthenticationManagerInterface
     * @Flow\Inject
     */
    protected $authenticationManager;

    /**
     * @var \TYPO3\Flow\Security\AccountRepository
     * @Flow\Inject
     */
    protected $accountRepository;

    /**
     * @var \TYPO3\Flow\Security\AccountFactory
     * @Flow\Inject
     */
    protected $accountFactory;

    /**
     * index action, does only display the form
     */
    public function indexAction() {
        // do nothing, action only required to show form
    }

    /**
     * @throws \TYPO3\Flow\Security\Exception\AuthenticationRequiredException
     * @return void
     */
    public function authenticateAction() {
        try {
            $this->authenticationManager->authenticate();
            $this->addFlashMessage('Successfully logged in.');
            //$this->flashMessageContainer->addMessage(new \TYPO3\Flow\Error\Error('Successfully logged in.'));
            $this->redirect('index', 'BlogEntry');
        } catch (\TYPO3\Flow\Security\Exception\AuthenticationRequiredException $exception) {
            $this->flashMessageContainer->addMessage(new \TYPO3\Flow\Error\Error('Wrong username or password.'));
            $this->flashMessageContainer->addMessage(new \TYPO3\Flow\Error\Error($exception->getMessage()));
            $this->redirect('index');
        }
    }

    /**
     * @return void
     */
    public function registerAction() {
        // do nothing more than display the register form
    }

    /**
     * save the registration
     * @param string $name
     * @param string $pass
     * @param string $pass2
     */
    public function createAction($name, $pass, $pass2) {

        $defaultRole = 'Jo.Blog:Editor';

        if($name == '' || strlen($name) < 3) {
            $this->flashMessageContainer->addMessage(new \TYPO3\Flow\Error\Error('Username too short or empty'));
            $this->redirect('register', 'Login');
        } else if($pass == '' || $pass != $pass2) {
            $this->flashMessageContainer->addMessage(new \TYPO3\Flow\Error\Error('Password too short or does not match'));
            $this->redirect('register', 'Login');
        } else {

            // create a account with password an add it to the accountRepository
            $account = $this->accountFactory->createAccountWithPassword($name, $pass, array($defaultRole));
            $this->accountRepository->add($account);

            // add a message and redirect to the login form
            $this->flashMessageContainer->addMessage(new \TYPO3\Flow\Error\Error('Account created. Please login.'));
            $this->redirect('index');
        }

        // redirect to the login form
        $this->redirect('index', 'BlogEntry');
    }

    public function logoutAction() {
        $this->authenticationManager->logout();
        $this->addFlashMessage('Successfully logged out.');
        // $this->flashMessageContainer->addMessage(new \TYPO3\Flow\Error\Error('Successfully logged out.'));
        $this->redirect('index', 'Login');
    }

}