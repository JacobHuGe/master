<?php

use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<?= $form->field($model, 'imageFiles')->widget('manks\FileInput', [
  'clientOptions' => [
    'pick' => [
      'multiple' => true,
    ],
    // 'server' => Url::to('upload/u2'),
    // 'accept' => [
    //   'extensions' => 'png',
    // ],
  ],
]); ?>
<?php ActiveForm::end() ?>