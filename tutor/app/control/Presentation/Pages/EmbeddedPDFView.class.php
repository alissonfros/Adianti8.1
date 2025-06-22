<?php
/**
 * EmbeddedPDFView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class EmbeddedPDFView extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $object = new TElement('iframe');
        $object->src   = 'https://adiantiframework.com.br/resources/adianti_framework.pdf';
        $object->type  = 'application/pdf';
        $object->style = "width: 100%; height:600px";
        
        parent::add($object);
    }
}
