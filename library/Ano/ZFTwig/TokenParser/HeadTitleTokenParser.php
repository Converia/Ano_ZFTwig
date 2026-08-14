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
 * @package     Ano_ZFTwig
 * @subpackage  TokenParser
 * @author      Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class Ano_ZFTwig_TokenParser_HeadTitleTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $expr = $this->parser->parseExpression();

        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);

        return new Ano_ZFTwig_Node_HeadTitleNode($expr, $token->getLine(), $this->getTag());
    }

	/**
	 * @return string
	 */
    public function getTag()
    {
        return 'headTitle';
    }
}
