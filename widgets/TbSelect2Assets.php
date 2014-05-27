<?php

/**
 * TbSelect2Assets widget will register select2 assets.
 */
class TbSelect2Assets extends CWidget
{
	/**
	 * @var string path to widget assets.
	 */
	public $assetPath;

	/**
	 * @var string locale to use.
	 */
	public $locale;

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();
		Yii::import('bootstrap.behaviors.TbWidget');
		$this->attachBehavior('tbWidget', new TbWidget);
		if (!isset($this->assetPath)) {
			$this->assetPath = realpath(dirname(__FILE__) . '/../assets');
		}
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		if ($this->assetPath !== false) {
			$this->publishAssets($this->assetPath);
			$this->registerCssFile('/css/select2.css');

			$this->getClientScript()->registerCoreScript('jquery');

			$this->registerScriptFile('/js/select2.js', CClientScript::POS_END);

			if (isset($this->locale)) {
				$this->locale = str_replace('_', '-', $this->locale);
				$this->registerScriptFile(
					"/js/locales/select2_locale_{$this->locale}.js",
					CClientScript::POS_END
				);
			}
		}
	}
}
