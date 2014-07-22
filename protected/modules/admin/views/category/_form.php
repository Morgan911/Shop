<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model,'image');
                 ?>
		<?php echo $form->error($model,'image');?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parentid'); ?>
		<?php echo $this->getMenu($categories, $form, $model); ?>
		<?php echo $form->error($model,'parentid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'si'); ?>
		<?php echo $form->dropDownList($model,'si',array('1'=>'Видно','0'=>'Скрыто')); ?>
		<?php echo $form->error($model,'si'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); 
?>
    <script type="text/javascript">
        //$('#ytHELLO7').attr('value','08111992');
        //$('#Category_parentid').attr('value','08111992');
    </script>
</div><!-- form -->