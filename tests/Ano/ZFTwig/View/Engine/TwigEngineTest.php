<?php
/**
 * Created by PhpStorm.
 * User: boellmann
 * Date: 11.04.18
 * Time: 08:28
 */

class Ano_ZFTwig_View_Engine_TwigEngineTest extends PHPUnit_Framework_TestCase
{
	private $templatePath;

	protected function setUp()
	{
		$this -> templatePath = __DIR__.'/../../../_files/templates';
	}

	public function testBasicTwigRendering(){
		$view = new Ano_View();
		$view -> addBasePath($this -> templatePath);
		$viewEngine = new Ano_ZFTwig_View_Engine_TwigEngine(
			$view
		);
		$view->addTemplateEngine('twig', $viewEngine);
		$view->setTemplateEngine('twig');
		$view->assign('name','Ano1602');
		$content = $view -> render('basic.twig');
		$this -> assertEquals('Hello Ano1602',$content);
	}

	public function testTransViewHelper(){
		$view = $this -> getMockBuilder('Ano_View')
			->setMethods(array('translate'))
			->getMock();
		$view->expects($this->once())
			->method('translate')
			->with('test_key')
			->will($this -> returnValue('MyTranslation'));

		$view -> addBasePath($this -> templatePath);
		$engineOptions = array(
			'extensions'=>array(
				'trans'=>array('class'=>'Ano_ZFTwig_Extension_TransExtension')
			)
		);
		$viewEngine = new Ano_ZFTwig_View_Engine_TwigEngine(
			$view,
			$engineOptions
		);
		$view->addTemplateEngine('twig', $viewEngine);
		$view->setTemplateEngine('twig');
		$content = $view -> render('translation.twig');
		$this -> assertEquals('Hello MyTranslation',$content);
	}
}