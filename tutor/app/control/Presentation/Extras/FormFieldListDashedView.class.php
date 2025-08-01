<?php
/**
 * FormFieldListDashedView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class FormFieldListDashedView extends TPage
{
    private $form;
    private $fieldlist;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        // create form and table container
        $this->form = new TForm('my_form');
        
        $combo = new TCombo('combo[]');
        $combo->enableSearch();
        $combo->addItems(['1'=>'One','2'=>'Two','3'=>'Three','4'=>'Four','5'=>'Five']);
        $combo->setSize('100%');
        
        $text = new TEntry('text[]');
        $text->setSize('100%');
        
        $number = new TEntry('number[]');
        $number->setNumericMask(2,',','.', true);
        $number->setSize('100%');
        
        $date = new TDate('date[]');
        $date->setSize('100%');
        
        $this->fieldlist = new TFieldList;
        $this->fieldlist->width = '100%';
        $this->fieldlist->class .= ' dashed'; // important
        $this->fieldlist->name  = 'my_field_list';
        $this->fieldlist->addField( '<b>Combo</b>',  $combo,  ['width' => '25%'] );
        $this->fieldlist->addField( '<b>Text</b>',   $text,   ['width' => '25%'] );
        $this->fieldlist->addField( '<b>Number</b>', $number, ['width' => '25%'] );
        $this->fieldlist->addField( '<b>Date</b>',   $date,   ['width' => '25%'] );
        
        $this->fieldlist->enableSorting();
        
        $this->form->addField($combo);
        $this->form->addField($text);
        $this->form->addField($number);
        $this->form->addField($date);
        
        $this->fieldlist->addHeader();
        $this->fieldlist->addDetail( new stdClass );
        $this->fieldlist->addDetail( new stdClass );
        $this->fieldlist->addDetail( new stdClass );
        $this->fieldlist->addDetail( new stdClass );
        $this->fieldlist->addDetail( new stdClass );
        $this->fieldlist->addCloneAction();
        
        // add field list to the form
        $this->form->add($this->fieldlist);
        
        // create save button
        $save  = TButton::create('save',  array($this, 'onSave'), 'Save', 'fa:save blue');
        
        $this->form->addField($save);
        
        $panel = new TPanelGroup(_t('Form field list'));
        $panel->add($this->form);
        $panel->addFooter(THBox::pack($save));
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($panel);
        parent::add($vbox);
    }
    
    /**
     * Save simulation
     */
    public static function onSave($param)
    {
        // show form values inside a window
        $win = TWindow::create('test', 0.6, 0.8);
        $win->add( '<pre>'.str_replace("\n", '<br>', print_r($param, true) ).'</pre>'  );
        $win->show();
    }
}
