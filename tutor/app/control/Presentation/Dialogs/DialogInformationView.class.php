<?php
/**
 * DialogInformationView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class DialogInformationView extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        // show the message dialog
        new TMessage('info', 'Information message');
        
        parent::add(new TXMLBreadCrumb('menu.xml', __CLASS__));
    }
}
