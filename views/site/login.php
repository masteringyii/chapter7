<?php use yii\bootstrap\Alert; ?>

<div class="site-login">
	<?php if (\Yii::$app->user->isGuest): ?>
	    <div class="body-content">
	    	<?php if (\Yii::$app->getSession()->hasFlash('warning')): ?>
	    		<?php echo Alert::widget([
	    			'options' => [
	    				'class' => 'alert alert-warning'
	    			],
	    			'body' => \Yii::$app->getSession()->getFlash('warning')
	    		]); ?>
	   		<?php endif; ?>
	        <?php echo $this->render('forms/LoginForm', [ 'model' => $model ]); ?>
	    </div>
	<?php else: ?>
		<?php echo Alert::widget([
			'options' => [
				'class' => 'alert alert-info'
			],
			'body' => 'You are already logged in. To login as a different user, logout first'
		]); ?>
	<?php endif; ?>
</div>