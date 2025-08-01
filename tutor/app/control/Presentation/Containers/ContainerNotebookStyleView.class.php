<?php
/**
 * ContainerNotebookStyleView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class ContainerNotebookStyleView extends TPage
{
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();
        
        // creates the notebook
        $notebook = new TNotebook;
        
        // tab click action
        $notebook->setTabAction( new TAction(array($this, 'onTabClick')));
        
        // creates the containers for each notebook page
        $page1 = new TTable;
        $page2 = new TPanel(370,180);
        $page1->style = "margin: 4px";
        $page2->style = "margin: 4px";
        
        // adds two pages in the notebook
        $notebook->appendPage('Click at the tab 1', $page1);
        $notebook->appendPage('Click at the tab 2', $page2);
        
        // create the form fields
        $field1 = new TEntry('field1');
        $field2 = new TEntry('field2');
        $field3 = new TEntry('field3');
        $field4 = new TEntry('field4');
        $field5 = new TEntry('field5');
        
        $field6 = new TEntry('field6');
        $field7 = new TEntry('field7');
        $field8 = new TEntry('field8');
        $field9 = new TEntry('field9');
        $field10= new TEntry('field10');
        
        // change the size for some fields
        $field1->setSize(100);
        $field2->setSize(80);
        $field3->setSize(150);
        
        $field6->setSize(80);
        $field7->setSize(80);
        $field8->setSize(80);
        $field9->setSize(80);
        $field10->setSize(80);
        
        ## fields for the page 1 ##
        
        // add a row for a label
        $row=$page1->addRow();
        $cell=$row->addCell(new TLabel('<b>Table Layout</b>'));
        $cell->valign = 'top';
        $cell->colspan=2;
        
        // adds a row for a field
        $row=$page1->addRow();
        $row->addCell(new TLabel('Field1:'));
        $row->addCell($field1);
        
        // adds a row for a field
        $row=$page1->addRow();
        $row->addCell(new TLabel('Field2:'));
        $cell = $row->addCell($field2);
        $cell->colspan=3;
        
        // adds a row for a field
        $row=$page1->addRow();
        $row->addCell(new TLabel('Field3:'));
        $cell = $row->addCell($field3);
        $cell->colspan=3;
        
        // adds a row for a field
        $row=$page1->addRow();
        $row->addCell(new TLabel('Field4:'));
        $row->addCell($field4);
        
        // adds a row for a field
        $row=$page1->addRow();
        $row->addCell(new TLabel('Field5:'));
        $row->addCell($field5);
        
        
        ## fields for the page 2 ##
        
        $page2->put(new TLabel('<b>Panel Layout</b>'), 4, 4);
        $page2->put(new TLabel('Field6'),  20,  30);
        $page2->put(new TLabel('Field7'),  50,  60);
        $page2->put(new TLabel('Field8'),  80,  90);
        $page2->put(new TLabel('Field9'), 110, 120);
        $page2->put(new TLabel('Field10'),140, 150);
        
        $page2->put($field6, 120,  30);
        $page2->put($field7, 150,  60);
        $page2->put($field8, 180,  90);
        $page2->put($field9, 210, 120);
        $page2->put($field10,240, 150);
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($notebook);
        parent::add($vbox);
    }
    
    /**
     * Executed when the user clicks over the tab
     */
    public static function onTabClick($param)
    {
        new TMessage('info', '<b>You have clicked at the tab</b>: <br><br>' . str_replace('","', '",<br>&nbsp;"', json_encode($param)));
    }
}
