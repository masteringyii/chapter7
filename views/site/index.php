<?php
use app\components\GreetingWidget;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?php echo GreetingWidget::widget(['name' => 'Charles']); ?></h1>
        <p>Now you're thinking with widgets!</p>
    </div>
</div>
