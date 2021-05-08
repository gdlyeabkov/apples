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
      use \yii\helpers\Url;
    ?>
    
    <?php if (count($apples) >= 1): ?>
      <?php foreach ($apples as $apple): ?>
        <p>Цвет яблока: <?= $apple->color ?></p>
        <p>Статус яблока: <?= $apple->status ?></p>
        <p>На сколько процентов яблоко откушено: <?= $apple->percent ?> %</p>
        <p>Яблоко на дереве: <?= $apple->tree ?></p>
        <p>Яблоко упало: <?= $apple->drop ?></p>
        <p>Испорченое яблоко: <?= $apple->dirty ?></p>
        <a class="btn btn-primary" href="<?= Url::toRoute([ 'apple/drop', 'id' => $apple->id ]) ?>">Уронить</a>
        <?php
          $form = ActiveForm::begin([
              'id' => 'test-form',
              'method' => 'post',
              'action' => ['apple/eat']
          ]);
        ?>
          <div class="form-group">
          <?= $form->field($apple, "id")->input('number') ?>
            <?= $form->field($apple, "percent")->input('number', [ 'value' => 5 ]) ?>
          </div>
          <?php if(!$apple->dirty && !$apple->drop): 
          ?>
            <?= Html::submitButton("Съесть") ?>
          <?php endif ?>
        <?php
          ActiveForm::end();
        ?>
        <hr/>
        
        <?php endforeach ?>
      <?php elseif (count($apples) == 0): ?>
        <p>Яблок нет</p>
      <?php endif ?>
      <a class="btn btn-primary" href="<?= Url::toRoute( 'apple/generate' ) ?>">Сгенерировать</a>
      
</body>
</html>