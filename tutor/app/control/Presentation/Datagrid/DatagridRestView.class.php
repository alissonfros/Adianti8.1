<?php
/**
 * DatagridRestView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class DatagridRestView extends TPage
{
    private $datagrid;
    
    public function __construct()
    {
        parent::__construct();
        
        // creates one datagrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        
        // create the datagrid columns
        $id         = new TDataGridColumn('id',         'ID',       'center', '25%');
        $nation     = new TDataGridColumn('nation',     'Nation',   'left',   '25%');
        $year       = new TDataGridColumn('year',       'Year',     'left',   '25%');
        $population = new TDataGridColumn('population', 'Population', 'left', '25%');
        
        // add the columns to the datagrid, with actions on column titles, passing parameters
        $this->datagrid->addColumn($id);
        $this->datagrid->addColumn($nation);
        $this->datagrid->addColumn($year);
        $this->datagrid->addColumn($population);
        
        // creates two datagrid actions
        $action1 = new TDataGridAction([$this, 'onView'],   ['year'=>'{year}',  'population' => '{population}'] );
        
        // custom button presentation
        $action1->setUseButton(TRUE);
        
        // add the actions to the datagrid
        $this->datagrid->addAction($action1, 'View', 'fa:search blue');
        
        // creates the datagrid model
        $this->datagrid->createModel();
        
        ################## START POPULATING DATA ############################
        
        $this->datagrid->clear();
        $url = 'https://datausa.io/api/data?drilldowns=Nation&measures=Population';
        
        $return = AdiantiHttpClient::request($url, 'GET');
        
        if ($return)
        {
            foreach ($return as $row)
            {
                // add an regular object to the datagrid
                $item = new StdClass;
                $item->id         = $row->{'ID Nation'};
                $item->nation     = $row->{'Nation'};
                $item->year       = $row->{'Year'};
                $item->population = $row->{'Population'};
                $this->datagrid->addItem($item);
            }
        }
        
        ################## FINISH POPULATING DATA ############################
        
        $panel = new TPanelGroup(_t('Datagrid Rest query'));
        $panel->add($this->datagrid)->style = 'overflow-x:auto';
        $panel->addFooter('footer');
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($panel);

        parent::add($vbox);
    }
    
    
    /**
     * Executed when the user clicks at the view button
     */
    public static function onView($param)
    {
        // get the parameter and shows the message
        $year       = $param['year'];
        $population = number_format($param['population'],0,',', '.');
        new TMessage('info', "The year is: <b>$year</b> <br> The population is : <b>$population</b>");
    }
}
