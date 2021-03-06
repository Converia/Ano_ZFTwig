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
 * Wrapper for Zend Framework 1.1x placeholder helper.
 * Syntax :
 *   - set => {% holder 'title' with 'My super title' %}
 *   - render => {% holder 'title' %}
 *
 * @package     Ano_ZFTwig
 * @subpackage  TokenParser
 * @author      Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class Ano_ZFTwig_TokenParser_HolderTokenParser extends Twig_TokenParser
{
    /**
     * Parses a token and returns a node.
     *
     * @param  Twig_Token $token A Twig_Token instance
     * @return Twig_Node A Twig_NodeInterface instance
     */
    public function parse(Twig_Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();

        $placeholder = $this->parser->getStream()->expect(Twig_Token::STRING_TYPE)->getValue();

        $attributes = null;
        if ($stream->test('with')) {
            $stream->next();
            $attributes = $this->parser->getExpressionParser()->parseExpression();
        }

        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new Ano_ZFTwig_Node_HolderNode($placeholder, $attributes, $lineno, $this->getTag());
    }

	/**
	 * @return string
	 */
    public function getTag()
    {
        return 'holder';
    }
}
