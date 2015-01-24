<?php
/**
 * Copyright 2014, Froala (http://www.froala.com)
 *
 */

/**
 * Froala Helper
 *
 * @package Froala
 * @subpackage Froala.View.Helper
 */

class FroalaHelper extends AppHelper {

/**
 * Other helpers used by FormHelper
 *
 * @var array
 */
	public $helpers = array('Html');

/**
 * Configuration
 *
 * @var array
 */
	public $configs = array();

/**
 * Default values
 *
 * @var array
 */
	protected $_defaults = array();

/**
 * Constructor
 *
 * @param View $View The View this helper is being attached to.
 * @param array $settings Configuration settings for the helper.
 */
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
		$configs = Configure::read('Froala.configs');
		if (!empty($configs) && is_array($configs)) {
			$this->configs = $configs;
		}
	}

/**
 * Adds a new editor to the script block in the head
 *
 * @see http://editor.froala.com/docs/options for a list of keys
 * @param mixed If array camel cased Froala Init config keys, if string it checks if a config with that name exists
 * @return void
 */
	public function editor($selector, $options = array()) {
		if (is_string($options)) {
			if (isset($this->configs[$options])) {
				$options = $this->configs[$options];
			} else {
				throw new OutOfBoundsException(sprintf(__('Invalid Froala configuration preset %s'), $options));
			}
		}
		$options = array_merge($this->_defaults, $options);
		$lines = '';

		foreach ($options as $option => $value) {
			$lines .= Inflector::underscore($option) . ' : "' . $value . '",' . "\n";
		}
		// remove last comma from lines to avoid the editor breaking in Internet Explorer
		$lines = rtrim($lines);
		$lines = rtrim($lines, ',');
		$this->Html->scriptBlock('$("' . $selector . '").editable({' . "\n" . $lines . "\n" . '});' . "\n", array('inline' => false));
	}

/**
 * beforeRender callback
 *
 * @param string $viewFile The view file that is going to be rendered
 *
 * @return void
 */
	public function beforeRender($viewFile) {
		$appOptions = Configure::read('Froala.editorOptions');
		if ($appOptions !== false && is_array($appOptions)) {
			$this->_defaults = $appOptions;
		}
		$this->Html->script(array(
      '/Froala/js/froala_editor.min.js',
      '/Froala/js/plugins/block_styles.min.js',
      '/Froala/js/plugins/colors.min.js',
      '/Froala/js/plugins/file_upload.min.js',
      '/Froala/js/plugins/font_family.min.js',
      '/Froala/js/plugins/media_manager.min.js',
      '/Froala/js/plugins/font_size.min.js',
      '/Froala/js/plugins/lists.min.js',
      '/Froala/js/plugins/tables.min.js',
      '/Froala/js/plugins/char_counter.min.js',
      '/Froala/js/plugins/inline_styles.min.js',
      '/Froala/js/plugins/urls.min.js',
      '/Froala/js/plugins/fullscreen.min.js',
      '/Froala/js/plugins/video.min.js'), array('inline' => false));
		$this->Html->css('/Froala/css/froala_editor.min.css');
	}

}
