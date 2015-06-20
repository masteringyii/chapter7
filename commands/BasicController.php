<?php

namespace app\commands;
use yii\helpers\Console;

/**
 * A basic controller for our Yii2 Application
 */
class BasicController extends \yii\console\Controller
{
	/**
	 * Outputs HelloWorld
	 * @return 0
	 */
	public function actionIndex()
	{
		echo "HelloWorld\n";
		return 0;
	}
	
	/**
	 * Outputs "$name lives in $city"
	 * @param string $name		The name of the person
	 * @param string $city		The city $name lives in
	 * @return 0
	 */
	public function actionLivesIn($name, $city="Chicago")
	{
		echo "$name lives in $city.\n";
		return 0;
	}
	
	/**
	 * Outputs each element of the input $array on a new line
	 * @param array $array	A comma separated list of elements
	 * @return 0
	 */
	public function actionListElements(array $array)
	{
		foreach ($array as $el)
			echo "$el\n";
		
		return 0;
	}
	
	/**
	 * Returns successfully IFF $shouldRun is set to any positive integer greater than 0
	 * @param integer $shouldRun
	 * @return integer
	 */
	public function actionConditionalExit($shouldRun=0)
	{
		if ((int)$shouldRun < 0)
		{
			echo "An error occured!\n";
			return 1;
		}
			
		echo "Everything worked!\n";
		return 0;
	}
	
	/**
	 * Outputs text in bold and cyan
	 * @return 0
	 */
	public function actionColors()
	{
		$this->stdout("Waiting on important thing to happen...\n", Console::BOLD);
		
		$yay = $this->ansiFormat('Yay', Console::FG_CYAN);
		echo "$yay! We're done!\n";
		return 0;
	}
}
