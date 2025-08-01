<?php
/**
 * StepView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class StepView extends TPage
{
    private $step;
    
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();
        
        $this->step = new TPageStep;
        $this->step->addItem('Step 1', new TAction(['CustomerDataGridView', 'onReload']));
        $this->step->addItem('Step 2');
        $this->step->addItem('Step 3');
        $this->step->select('Step 2');
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->step);
        
        parent::add($vbox);
    }
}
