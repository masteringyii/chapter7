<?php

namespace app\commands;

/**
 * A basic controller for our Yii2 Application
 */
class BasicController extends \yii\console\Controller
{
	/**
	 * Outputs HelloWorld
	 */
	public function actionIndex()
	{
		echo "HelloWorld";
		return 1;
	}
}