<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <?php
    
      use \yii\widgets\ActiveForm;
      use \yii\helpers\Html;
  ?>
        <?php
          $form = ActiveForm::begin([
              'method' => 'post',
              'action' => ['apple/index', ]
          ]);
        ?>
        <div class="form-group">
            <?= $form->field($user, "login")->input('text') ?>
          </div>
          <div class="form-group">
            <?= $form->field($user, "password")->input('password') ?>
          </div>

          <?= Html::submitButton("Войти") ?>

          <?php
            $form::end();
          ?>
    </body>
</html>