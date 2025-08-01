<?php
/**
 * FullCalendarDatabaseView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class FullCalendarDatabaseView extends TPage
{
    private $fc;
    
    /**
     * Page constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->fc = new TFullCalendar(date('Y-m-d'), 'month');
        $this->fc->setReloadAction(new TAction(array($this, 'getEvents')));
        $this->fc->setDayClickAction(new TAction(array('CalendarEventForm', 'onStartEdit')));
        $this->fc->setEventClickAction(new TAction(array('CalendarEventForm', 'onEdit')));
        $this->fc->setEventUpdateAction(new TAction(array('CalendarEventForm', 'onUpdateEvent')));
        $this->fc->enableFullHeight();
        
        $this->fc->setOption('businessHours', [ [ 'dow' => [ 1, 2, 3, 4, 5 ], 'start' => '08:00', 'end' => '18:00' ]]);
        //$this->fc->setTimeRange('10:00', '18:00');
        //$this->fc->disableDragging();
        //$this->fc->disableResizing();
        parent::add( TPanelGroup::pack('', $this->fc) );
    }
    
    /**
     * Output events as an json
     */
    public static function getEvents($param=NULL)
    {
        $return = array();
        try
        {
            TTransaction::open('samples');
            
            $events = CalendarEvent::where('start_time', '<=', $param['end'])
                                   ->where('end_time',   '>=', $param['start'])->load();
            
            if ($events)
            {
                foreach ($events as $event)
                {
                    $event_array = $event->toArray();
                    $event_array['start'] = str_replace( ' ', 'T', $event_array['start_time']);
                    $event_array['end']   = str_replace( ' ', 'T', $event_array['end_time']);
                    
                    $popover_content = $event->render("<b>Title</b>: {title} <br> <b>Description</b>: {description}");
                    $event_array['title'] = TFullCalendar::renderPopover($event_array['title'], 'Popover title', $popover_content);
                    
                    $return[] = $event_array;
                }
            }
            TTransaction::close();
            echo json_encode($return);
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
    
    /**
     * Reconfigure the callendar
     */
    public function onReload($param = null)
    {
        if (isset($param['view']))
        {
            $this->fc->setCurrentView($param['view']);
        }
        
        if (isset($param['date']))
        {
            $this->fc->setCurrentDate($param['date']);
        }
    }
}
