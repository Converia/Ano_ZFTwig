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

use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;

/**
 * Twig environment for Zend Framework 1.1x
 *
 * @package     Ano_ZFTwig
 * @author      Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class Ano_ZFTwig_Environment extends Environment
{
    /**
     * @var Zend_View_Interface
     */
    protected $view;

    public function __construct(Zend_View_Interface $view, FilesystemLoader $loader = null, $options = array())
    {
        $this->setView($view);
        if (null === $loader) {
            $loader = new ArrayLoader();
        }
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

	final public function setLoader(LoaderInterface $loader)
	{
		if(!$loader instanceof FilesystemLoader){
			throw new InvalidArgumentException('Only loaders of typ Twig_Loader_Filesystem are supported.');
		}
		parent::setLoader($loader);
	}


}