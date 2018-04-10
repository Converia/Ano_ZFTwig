<?php
/**
 * This file is part of the Ano_ZFTwig package
 * 
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 *
 * @copyright  Copyright (c) 2010-2011 Benjamin Dulau <benjamin.dulau@gmail.com>
 * @license    New BSD License
 */

/**
 * Twig environment for Zend Framework 1.1x
 *
 * @package     Ano_ZFTwig
 * @author      Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class Ano_ZFTwig_Environment extends Twig_Environment
{
    /**
     * @var Zend_View_Interface
     */
    protected $view;

    /**
     * @param Zend_View_Interface    $viw     A Zend Framework view object
     * @param Twig_Loader_Filesystem   $loader  A Twig_Loader_Filesystem instance
     * @param array                  $options An array of options
     *
     * @see Twig_Environment::__construct()
     */
    public function __construct(Zend_View_Interface $view, Twig_Loader_Filesystem $loader = null, $options = array())
    {
        $this->setView($view);
        parent::__construct($loader, $options);
    }

    /**
     * Returns the view
     *
     * @return Zend_View_Interface
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Sets the view
     *
     * @param Zend_View_Interface $view
     * @return Ano_ZFTwig_Environment
     */
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
        return $this;
    }

	final public function setLoader(Twig_LoaderInterface $loader)
	{
		if(!$loader instanceof Twig_Loader_Filesystem){
			throw new InvalidArgumentException('Only loaders of typ Twig_Loader_Filesystem are supported.');
		}
		parent::setLoader($loader);
	}


}