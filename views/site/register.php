<?php use yii\bootstrap\Alert; ?>

<?php if (\Yii::$app->user->isGuest): ?>
    <div class="site-login" style="margin-top: 100px";>
	    <div class="body-content">
	        <?php echo $this->render('forms/RegisterForm', [ 'model' => $model ]); ?>
	    </div>
	</div>
<?php else: ?>
	<?php echo Alert::widget([
		'options' => [
			'class' => 'alert alert-info'
		],
		'body' => 'You are already logged in. To register a new user, logout first'
	]); ?>
<?php endif; ?>