<?php
/**
 * ContainerPageWrapper
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class ContainerPageWrapper extends TPage
{
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();
        
        $pw1 = new TPageWrapper;
        $pw1->setClass('FullCalendarSplitView');
        $pw1->setMethod('onReload');
        $pw1->setSize('100%', 500);
        
        $pw2 = new TPageWrapper;
        $pw2->setClass('KanbanDatabaseView');
        $pw2->setMethod('onReload');
        $pw2->setSize('100%', 500);
        
        // creates the vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($pw1);
        $vbox->add($pw2);
        
        parent::add($vbox);
    }
}
