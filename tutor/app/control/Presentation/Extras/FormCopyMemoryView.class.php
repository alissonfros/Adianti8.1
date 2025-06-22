<?php
/**
 * FormButtonStyleView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class FormCopyMemoryView extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $button = new TButton('bt2a');
        $button->setImage('far:copy');
        $button->setLabel('Click here to copy some content to clipboard');
        $button->addFunction("__adianti_copy_to_clipboard('this is the content');");
        
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($button);
        
        parent::add($vbox);
    }
}
