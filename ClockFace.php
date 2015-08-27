<?php
/**
 * ClockFace widget class
 *
 * @author: Moahammad Ebrahim Amini <faravaghi@gmail.com>
 * @copyright Copyright &copy; 2013-www.dkr.co.ir
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package ClockFace.widgets
 *
 * Example :
 *	$this->widget('ext.clockface.ClockFace',
 *		array(
 *			'name'=>'time',
 *			'value' => $model->time,
 *			'options'=>array(
 *				'format'=>'HH:mm'
 *			),
 *			'htmlOptions' => array(
 *				'placeholder' 	=> 'Time',
 *			)
 *		)
 *	);
 */
class ClockFace extends CInputWidget
{
	/**
	 * @var TbActiveForm when created via TbActiveForm, this attribute is set to the form that renders the widget
	 * @see TbActionForm->inputRow
	 */
	public $form;
 
	/**
     * Html ID
     * @var string
     */
    public $id = 'clockWidget';

    /**
     * Initial options
     * @var array
     */
	public $options = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		/* $this->htmlOptions['autocomplete'] = true; */
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		list($this->name, $this->id) = $this->resolveNameId();

		echo CHtml::tag('div', array('class'=>'input-group bootstrap-timepicker'),false,false);
		
		$this->htmlOptions['class'] = 'form-control';

		if ($this->hasModel())
		{
			if($this->form)
				echo $this->form->textField($this->model, $this->attribute, $this->htmlOptions);
			else
				echo CHtml::textField($this->model, $this->attribute, $this->htmlOptions);
		} else
			echo CHtml::textField($this->name, $this->value, $this->htmlOptions);

		echo CHtml::tag('span', array('class'=>'input-group-addon'),'<i class="fa fa-clock-o bigger-110"></i>',true);
		echo CHtml::closetag('div');

		$this->registerClientScript($this->id);
	}

	/**
	 * Registers required client script for bootstrap datepicker. It is not used through bootstrap->registerPlugin
	 * in order to attach events if any
	 */
	public function registerClientScript($id)
	{
		$baseScriptUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.clockface').'/assets');

		$cs=Yii::app()->getClientScript();
		$cs->registerCssFile($baseScriptUrl.'/css/clockface.css');
		$cs->registerScriptFile($baseScriptUrl.'/js/clockface'. (Yii::app()->language == 'fa_ir' ? '.rtl' : '') .'.js');
		
		$options = !empty($this->options) ? CJavaScript::encode($this->options) : '';
		ob_start();

		echo "jQuery(\"#{$id}\").clockface({$options})"; 

		Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $id, ob_get_clean() . ';');

	}
}