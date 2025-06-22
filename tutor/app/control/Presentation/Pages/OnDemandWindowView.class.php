<?php
/**
 * OnDemandWindowView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class OnDemandWindowView extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $window = TWindow::create(_t('On demand window'), 0.8, null);
        
        $html = new THtmlRenderer('app/resources/page.html');
        
        $replaces = [];
        $replaces['title']  = 'Panel title';
        $replaces['footer'] = 'Panel footer';
        $replaces['name']   = 'Someone famous';
        
        // replace the main section variables
        $html->enableSection('main', $replaces);
        
        $window->add($html);
        $window->show();
    }
}
