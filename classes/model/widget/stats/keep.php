<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Widget_Stats_Keep extends Model_Widget_Decorator {
	public function fetch_data()
	{
		$plugin = Plugins::get_registered('stats');
		
		return array(
			'plugin' => $plugin
		);
	}
	
}