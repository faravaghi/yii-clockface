# yii-clockface
Clockface timepicker for Twitter Bootstrap

## Demo, Docs and Download
See **http://vitalets.github.com/clockface**

## Contribution
Your support is appreciated. 
Please make pull requests on <code>dev</code> branch. Thank you!

## Example

	$this->widget('ext.clockface.ClockFace',
		array(
			'name'=>'time',
			'value' => $model->time,
			'options'=>array(
				'format'=>'HH:mm'
			),
			'htmlOptions' => array(
				'placeholder' 	=> 'Time',
			)
		)
	);

## License
Copyright (c) 2012 Vitaliy Potapov  
Licensed under the MIT licenses.
