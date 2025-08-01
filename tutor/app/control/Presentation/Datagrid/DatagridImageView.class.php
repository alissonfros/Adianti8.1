<?php
/**
 * DatagridImageView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class DatagridImageView extends TPage
{
    private $datagrid;
    
    public function __construct()
    {
        parent::__construct();
        
        // creates one datagrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = '100%';
        
        // add the columns
        $this->datagrid->addColumn( new TDataGridColumn('code',         'Code',         'center', '20%') );
        $this->datagrid->addColumn( new TDataGridColumn('description',  'Description',  'left',   '40%') );
        $column = $this->datagrid->addColumn( new TDataGridColumn('image',  'Image',    'center', '40%') );
        
        // define the transformer method over image
        $column->setTransformer( function($image) {
            $image = new TImage($image);
            $image->style = 'max-width: 140px';
            return $image;
        });
        
        // creates the datagrid model
        $this->datagrid->createModel();
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add(TPanelGroup::pack(_t('Datagrid with image'), $this->datagrid, 'footer'));

        parent::add($vbox);
    }
    
    /**
     * Load the data into the datagrid
     */
    function onReload()
    {
        $this->datagrid->clear();
        
        // add an regular object to the datagrid
        $item = new StdClass;
        $item->code         = '1';
        $item->description  = 'Pendrive';
        $item->image        = 'app/images/pendrive.jpg';
        $this->datagrid->addItem($item);
        
        // add an regular object to the datagrid
        $item = new StdClass;
        $item->code         = '2';
        $item->description  = 'HD';
        $item->image        = 'app/images/hd.jpg';
        $this->datagrid->addItem($item);
        
        // add an regular object to the datagrid
        $item = new StdClass;
        $item->code         = '3';
        $item->description  = 'SD CARD';
        $item->image        = 'app/images/sdcard.jpg';
        $this->datagrid->addItem($item);
    }
    
    /**
     * shows the page
     */
    function show()
    {
        $this->onReload();
        parent::show();
    }
}
