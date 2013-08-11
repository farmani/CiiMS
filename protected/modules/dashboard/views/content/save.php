<?php $form = $this->beginWidget('cii.widgets.CiiActiveForm', array(
	'htmlOptions' => array(
		'class' => 'pure-form pure-form-aligned content-container-form'
	)
)); ?>
	<?php echo $form->hiddenField($model, 'id'); ?>
	<?php echo $form->hiddenField($model, 'vid'); ?>
	<?php echo $form->hiddenField($model, 'created'); ?>
	<?php echo $form->hiddenField($model,'parent_id',array('value'=>1)); ?>
	<?php echo $form->hiddenField($model,'author_id',array('value'=>Yii::app()->user->id)); ?>
	<div class="content-container">
		<div class="header">
			<div class="content">
				<div class="pull-left" style="width: 48%;">
					<?php echo $form->textField($model, 'title', array('placeholder' => 'Enter your post title here', 'class' => 'title')); ?>
				</div>
				<div class="pull-right">
					<?php echo CHtml::submitButton('Save Changes', array('class' => 'pure-button pure-button-error pure-button-link')); ?>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="editor">
			<div class="top-header">
				<?php if ((bool)Cii::getConfig('preferMarkdown', false) == true): ?>
					<span>Markdown</span>
				<?php else: ?>
					<span>Rich Text</span>
				<?php endif; ?>
			</div>
			<div id="main">
				<div class="content">
					<?php if ((bool)Cii::getConfig('preferMarkdown', false) == true): ?>
						<?php echo $form->textArea($model, 'content'); ?>
					<?php else: ?>
						<?php $this->widget('ext.redactor.ImperaviRedactorWidget', array(
	    	                    'model' => $model,
	    	                    'attribute' => 'content',
	    	                    'options' => array(
	    	                        'focus' => false,
	    	                        'autoresize' => false,
	    	                        'minHeight' =>'100%',
	    	                        'changeCallback' => 'js:function() { $("#Content_content").change(); }'
	    	                    )
	    	                ));
	    	            ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="body-content">
			<div class="top-header">
				<span class="show-settings">Preview</span>
				<span class="show-preview" style="display:none">Content Settings</span>
				<span class="pull-right icon-gear show-settings"></span>
				<span class="pull-right icon-gear show-preview" style="display:none"></span>
			</div>
			<div id="main" class="nano">				
				<div class="content flipbox">					
					<div class="preview"></div>
				</div>
			</div>
		</div>

		<div class="settings">
			<?php $htmlOptions = array('class' => 'pure-input-2-3'); ?>
			<div class="pure-control-group">
				<?php echo $form->dropDownListRow($model,'status', array(1=>'Published', 0=>'Draft'), $htmlOptions); ?>
			</div>
			<div class="pure-control-group">
				<?php echo $form->dropDownListRow($model,'commentable', array(1=>'Yes', 0=>'No'), $htmlOptions); ?>
			</div>
			<div class="pure-control-group">
				<?php echo $form->dropDownListRow($model,'category_id', CHtml::listData(Categories::model()->findAll(), 'id', 'name'), $htmlOptions); ?>
			</div>
			<div class="pure-control-group date form_datetime">
					<?php echo $form->textFieldRow($model, 'published', $htmlOptions); ?>
			</div>
			<div class="pure-control-group">
				<?php echo $form->dropDownListRow($model,'type_id', array(2=>'Blog Post', 1=>'Page'), $htmlOptions); ?>
			</div>
			<div class="pure-control-group">
				<?php echo $form->dropDownListRow($model, 'view', $views, array('class'=>'pure-input-2-3', 'options' => array($model->view => array('selected' => true)))); ?>
			</div>
			<div class="pure-control-group">
	            <?php echo $form->dropDownListRow($model, 'layout', $layouts, array('class'=>'pure-input-2-3', 'options' => array($model->layout => array('selected' => true)))); ?>
			</div>
			<div class="pure-control-group">
				<?php echo $form->textFieldRow($model,'password',array('class'=>'pure-input-2-3','maxlength'=>150, 'placeholder' => 'Password (Optional)', 'value' => Cii::decrypt($model->password))); ?>
			</div>
			<div class="pure-control-group">
				<?php echo $form->textFieldRow($model,'slug',array('class'=>'pure-input-2-3','maxlength'=>150, 'placeholder' => 'Slug')); ?>
			</div>
			<div class="pure-control-group">
				<?php echo $form->textField($model, 'tagsFlat', array('id' => 'tags')); ?>
			</div>
			<div class="pure-control-group">
				<?php $htmlOptions['style'] = 'width: 100%; height: 250px;'; ?>
				<?php $htmlOptions['placeholder'] = 'Add a content extract here'; ?>
				<?php echo $form->textArea($model, 'extract', $htmlOptions); ?>
			</div>
		</div>

	</div>

<?php $this->endWidget(); ?>

<?php echo CHtml::tag('input', array('type' => 'hidden', 'class' => 'preferMarkdown', 'value' => Cii::getConfig('preferMarkdown')), NULL); ?>
<?php  Yii::app()->getClientScript()
				 ->registerCssFile($this->asset.'/highlight.js/default.css')
				 ->registerCssFile($this->asset.'/highlight.js/github.css')
				 ->registerCssFile($this->asset.'/dropzone/css/dropzone.css')
				 ->registerCssFile($this->asset . '/css/jquery.tags.css')
				 ->registerCssFile($this->asset.'/datepicker/css/datetimepicker.css')
				 ->registerScriptFile($this->asset.'/datepicker/js/bootstrap-datetimepicker.min.js', CClientScript::POS_END)
				 ->registerScriptFile($this->asset.'/js/jquery.nanoscroller.min.js', CClientScript::POS_END)
				 ->registerScriptFile($this->asset . '/js/jquery.tags.min.js', CClientScript::POS_END)
				 ->registerScriptFile($this->asset.'/highlight.js/highlight.pack.js', CClientScript::POS_END)
				 ->registerScriptFile($this->asset.'/js/marked.js', CClientScript::POS_END)
				 ->registerScriptFile($this->asset.'/dropzone/dropzone.min.js', CClientScript::POS_END)
				 ->registerScriptFile($this->asset.'/js/jquery.flippy.min.js', CClientScript::POS_END); ?>