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

use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

/**
 * Wrapper for Zend Framework 1.1x url view helper.
 * Syntax : {% url 'my_route' with ['param1': 'value1'] %}
 *
 * @package     Ano_ZFTwig
 * @subpackage  TokenParser
 * @author      Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class Ano_ZFTwig_TokenParser_UrlTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();

        $route = $this->parser->parseExpression();

        $attributes = null;
        if ($stream->test('with')) {
            $stream->next();
            $attributes = $this->parser->parseExpression();
        }

        $stream->expect(Token::BLOCK_END_TYPE);

        return new Ano_ZFTwig_Node_RouteNode($route, $attributes, $lineno, $this->getTag());
    }

	/**
	 * @return string
	 */
    public function getTag()
    {
        return 'url';
    }
}
