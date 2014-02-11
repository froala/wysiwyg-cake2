<?php
/**
 * CakePHP Froala WYSIWYG Plugin
 *
 * Copyright 2014, Froala (http://www.froala.com)
 *
 */
 
App::uses('Controller', 'Controller');
App::uses('HtmlHelper', 'View/Helper');
App::uses('FroalaHelper', 'Froala.View/Helper');

/**
 * TheFroalaTestController class
 *
 * @package       Froala.Test.Case.View.Helper
 */
class TheFroalaTestController extends Controller {

/**
 * name property
 *
 * @var string 'TheTest'
 */
	public $name = 'TheTest';

/**
 * uses property
 *
 * @var mixed null
 */
	public $uses = null;
}

/**
 * FroalaHelperTest class
 *
 * @package       Froala.Test.Case.View.Helper
 */
class FroalaTest extends CakeTestCase {

/**
 * Helper being tested
 *
 * @var object FroalaHelper
 * @access public
 */
	public $Froala = null;

/**
 * @var array
 * @access public
 */
	public $configs = array(
		'basic' => array(
			'inline' => false,
			'buttons' => "['bold', 'italic', 'underline']"
		)
	);

/**
 * startTest
 *
 * @return void
 * @access public
 */
	public function setUp() {
		Configure::write('Asset.timestamp', false);

		$this->View = new View(null);
		$this->Froala = new FroalaHelper($this->View);
		$this->Froala->Html = $this->getMock('HtmlHelper', array('script'), array($this->View));
	}

/**
 * endTest
 *
 * @return void
 * @access public
 */
	public function tearDown() {
		unset($this->Froala, $this->View);
	}

/**
 * testEditor
 *
 * @return void
 * @access public
 */
	public function testEditor() {
		$this->Froala->Html->expects($this->any())
			->method('scriptBlock')
			->with(
				'<script type="text/javascript">
				//<![CDATA[
				Froala.init({
				inline : "false",
				buttons : ['bold', 'italic', 'underline']
				});

				//]]>
				</script>',
				array('inline' => false));
		$this->Froala->configs = $this->configs;
		$this->Froala->editor(".selector", 'basic');

		$this->expectException('OutOfBoundsException');
		$this->Froala->editor(".selector", 'invalid-config');
	}

/**
 * testEditor with app wide options
 *
 * @return void
 * @access public
 */
	public function testEditorWithDefaults() {
		$this->assertTrue(Configure::write('Froala.editorOptions', array('height' => '100px')));

		$this->Froala->Html->expects($this->any())
			->method('scriptBlock')
			->with(
				'<script type="text/javascript">
				//<![CDATA[
				Froala.init({
				height : "100px"
				});

				//]]>
				</script>',
				array('inline' => false));
		$this->Froala->beforeRender('test.ctp');
		$this->Froala->editor('.selector', array());

		$this->Froala->Html->expects($this->any())
			->method('scriptBlock')
			->with(
				'<script type="text/javascript">
				//<![CDATA[
				Froala.init({
				height : "50px"
				});

				//]]>
				</script>',
				array('inline' => false));
		$this->Froala->editor('.selector', array('height' => '50px'));
	}

/**
 * testBeforeRender
 *
 * @return void
 * @access public
 */
	public function testBeforeRender() {
		$this->Froala->Html->expects($this->any())
			->method('script')
			->with(
				'/Froala/js/froala_editor.min.js',
				array('inline' => false));
		$this->Froala->beforeRender('test.ctp');

		$this->Froala->Html->expects($this->any())
            ->method('css')
            ->with(
                '/Froala/css/froala_editor.min.css');
        $this->Froala->beforeRender('test.ctp');
	}

}