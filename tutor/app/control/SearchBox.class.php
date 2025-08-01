<?php
/**
 * Search Box
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class SearchBox extends TPage
{
    private $form;
    
    /**
     * Constructor method
     */
    public function __construct()
    {
        parent::__construct();
        
        parent::setTargetContainer('search-box');
        
        $this->{'style'} = 'padding-top:1px;padding-left:5px;float:left';
        $this->{'id'} = 'search-box';
        
        $this->form = new TForm('search_box_form');
        $input = new TUniqueSearch('input');
        $input->placeholder = _t('Search program');
        $input->style = 'vertical-align:top';
        $input->setSize(250);
        $input->addItems( $this->getPrograms() );
        $input->setMinLength(1);
        $input->setChangeAction(new TAction(array('SearchBox', 'loadProgram')));
        
        $this->form->add($input);
        $this->form->setFields(array($input));
        parent::add($this->form);
    }
    
    /**
     * Returns an indexed array with all programs
     */
    public function getPrograms()
    {
        $parser = new TMenuParser('menu.xml');
        return $parser->getIndexedPrograms();
    }
    
    /**
     * Load an specific program
     */
    public static function loadProgram($param)
    {
        $program = $param['input'];
        if ($program)
        {
            TApplication::loadPage($program);
        }
    }
}
