<?php
/**
 * VideoCardView
 *
 * @version    1.0
 * @package    samples
 * @subpackage tutor
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    https://adiantiframework.com.br/license-tutor
 */
class VideoCardView extends TPage
{
	private $form;
	
	public function __construct()
	{
		parent::__construct();
		
		$cards = new TCardView;
		$cards->setUseButton();
		$items = [];
		$items[] = (object) [ 'id' => 1, 'title' => 'Melhorias do Framework 8.0 (2024)', 'source' => 'YEZaF9uixjY'];
		$items[] = (object) [ 'id' => 1, 'title' => 'Melhorias do Framework 7.6 (2023)', 'source' => '2ljKQpLw6WQ'];
		$items[] = (object) [ 'id' => 2, 'title' => 'Melhorias do Framework 7.5 (2022)', 'source' => 'DbFFZM1NND4'];
		$items[] = (object) [ 'id' => 3, 'title' => 'Melhorias do Framework 7.4 (2021)', 'source' => '8REC_4pQAh8'];
		$items[] = (object) [ 'id' => 3, 'title' => 'Melhorias do Framework 7.3 (2020)', 'source' => 'LXhKV2JAhss'];
		$items[] = (object) [ 'id' => 3, 'title' => 'Melhorias do Framework 7.2 (2020)', 'source' => 'EZceO7GynBw'];
		$items[] = (object) [ 'id' => 3, 'title' => 'Melhorias do Framework 7.0 (2019)', 'source' => 'YtFqNFXhnTU'];
		$items[] = (object) [ 'id' => 3, 'title' => 'Melhorias do Framework 5.5 (2018)', 'source' => 'HnC0gg1ik8o'];
		$items[] = (object) [ 'id' => 3, 'title' => 'Melhorias do Framework 5.0 (2017)', 'source' => 'IF5f1cnGl04'];
		$items[] = (object) [ 'id' => 3, 'title' => 'Melhorias do Framework 4.0 (2016)', 'source' => 'ZmLtJUpoJgk'];
		$items[] = (object) [ 'id' => 3, 'title' => 'Melhorias do Framework 3.0 (2015)', 'source' => 'TNbzKO1khcs'];
		$items[] = (object) [ 'id' => 3, 'title' => 'Melhorias do Framework 2.0 (2015)', 'source' => 'VEBwvBxBq88'];
		
		foreach ($items as $key => $item)
		{
			$cards->addItem($item);
		}
		
		$cards->setTitleAttribute('title');
		
		$cards->setItemTemplate('<iframe width="100%" height="300px" src="https://www.youtube.com/embed/{source}""></iframe>');
		
		$action = new TAction([$this, 'onGotoVideo'], ['source'=>'{source}']);
		$cards->addAction($action, 'Go to Youtube', 'far:play-circle red');
		
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->style = 'width: 100%';
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($cards);

        parent::add($vbox);
	}
    
    /**
     * Item edit action
     */
	public static function onGotoVideo($param = NULL)
	{
	    $source = $param['source'];
		TScript::create("window.open('https://www.youtube.com/watch?v={$source}')");
	}
}
