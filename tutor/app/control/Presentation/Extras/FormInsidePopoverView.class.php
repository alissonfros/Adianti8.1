<?php
/**
 * FormInsidePopoverView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class FormInsidePopoverView extends TPage
{
    public function __construct()
    {
        parent::__construct();
        //parent::include_css('app/resources/myframe.css');
        
        $button = new TButton('bt4a');
        $button->setImage('far:list-alt blue');
        $button->setLabel('Open form inside popover');
        
        $action = new TAction(array('FormSessionDataView', 'onEdit'));
        // $action->setParameter('key', '1');
        
        $button->popover    = 'true';
        $button->popside    = 'bottom';
        $button->poptitle   = 'Pop title 1';
        $button->poptrigger = 'click';
        $button->popaction  = $action->serialize(FALSE);
        
        parent::add($button);
    }
}
