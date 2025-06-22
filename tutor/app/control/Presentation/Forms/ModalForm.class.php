<?php
/**
 * ModalForm
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class ModalForm extends TPage
{
    protected $form; // modal form
    
    /**
     * Constructor
     */
    function __construct($param)
    {
        parent::__construct();
        
        // creates the form
        $this->form = new TModalForm('form_login');
        $this->form->setFormTitle('Login');
        
        // create the form fields
        $login     = new TEntry('login');
        $password  = new TPassword('password');
        
        $login->disableAutoComplete();
        $password->disableAutoComplete();
        $login->setSize('100%');
        $password->setSize('100%');
        $login->placeholder = 'Login';
        $password->placeholder = 'Password';
        $password->disableToggleVisibility();
        $login->autofocus = 'autofocus';
        
        $this->form->addRowField('Login', $login, true );
        $this->form->addRowField('Password', $password, true );
        
        $this->form->addAction('Log in', new TAction([$this, 'onLogin']), '' );
        
        $this->form->addFooterAction('Create account', new TAction([$this, 'test']), '');
        
        // add the form to the page
        parent::add($this->form);
    }
    
    /**
     * show form data
     */
    public static function onLogin($param)
    {
        new TMessage('info', str_replace('","', '",<br>&nbsp;"', json_encode($param)));
    }
    
    public function test($para)
    {
    }
}
