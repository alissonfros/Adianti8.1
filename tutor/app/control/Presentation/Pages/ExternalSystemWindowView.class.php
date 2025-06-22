<?php
/**
 * ExternalSystemWindowView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class ExternalSystemWindowView extends TWindow
{
    public function __construct()
    {
        parent::__construct();
        parent::setTitle(_t('Window with external system'));
        parent::removePadding();
        parent::setSize(0.8, 650);
        
        $iframe = new TElement('iframe');
        $iframe->id = "iframe_external";
        $iframe->src = "//framework.adianti.me/template";
        $iframe->frameborder = "0";
        $iframe->scrolling = "yes";
        $iframe->width = "100%";
        $iframe->height = "600px";
        
        parent::add($iframe);
    }
}
