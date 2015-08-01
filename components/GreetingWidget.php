<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class GreetingWidget extends Widget
{
	public $name = null;
	
	public $greeting;
	
	public function init()
	{
		parent::init();
		
		$hour = date('G');
		
		if ( $hour >= 5 && $hour <= 11 )
		   $this->greeting = "Good Morning";
		else if ( $hour >= 12 && $hour <= 18 )
		   $this->greeting = "Good Afternoon";
		else if ( $hour >= 19 || $hours <= 4 )
		   $this->greeting = "Good Evening";
	}
	
	public function run()
	{
		if ($this->name === null)
			return HTML::encode($this->greeting);
		else
			return HTML::encode($this->greeting . ', ' . $this->name);
	}
}