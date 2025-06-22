<?php
/**
 * FormLikertScaleView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class FormLikertScaleView extends TPage
{
    private $form;
    
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();
        
        // create the form
        $this->form = new BootstrapFormBuilder('form_selectors');
        $this->form->setFormTitle(_t('Likert scale'));
        $this->form->generateAria();
        
        // create the form fields
        $question1    = new TLikertScale('question1');
        $question2    = new TLikertScale('question2');
        $question3    = new TLikertScale('question3');
        
        $answers = ['1' => _t('Strongly disagree'), '2' => _t('Disagree'), '3' => _t('Neutral'), '4' => _t('Agree'), '5' => _t('Strongly agree') ];
        
        $question1->addItems( $answers );
        $question2->addItems( $answers );
        $question3->addItems( $answers );
        
        $this->form->addFields( [new TLabel('Question 1')] );
        $this->form->addFields( [$question1] );
        $this->form->addContent( [''] );
        
        $this->form->addFields( [new TLabel('Question 2')] );
        $this->form->addFields( [$question2] );
        $this->form->addContent( [''] );
        
        $this->form->addFields( [new TLabel('Question 3')] );
        $this->form->addFields( [$question3] );
        $this->form->addContent( [''] );
        
        $this->form->addAction('Send', new TAction(array($this, 'onSend')), 'far:check-circle green');
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);

        parent::add($vbox);
    }
    
    /**
     * Send data
     */
    public static function onSend($param)
    {
        new TMessage('info', str_replace(',', '<br>', json_encode($param)));
    }
}
