<?php
/**
 * DropdownView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class DropdownView extends TPage
{
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();
        
        // creates the dropdown
        $dropdown = new TDropDown('Dropdown test', 'fa:list');
        //$dropdown->setButtonClass('btn btn-info waves-effect dropdown-toggle');
        $dropdown->addAction( 'Show a message', new TAction(array($this, 'onMessage') ));
        $dropdown->addAction( 'Customer list', new TAction(array('CustomerDataGridView', 'onReload') ));
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($dropdown);
        
        parent::add($vbox);
    }
    
    /**
     * Show some message
     * @param $param URL parameters containing key and value
     */
    public function onMessage($param)
    {
        new TMessage('info', 'Test');
    }
}
?>
