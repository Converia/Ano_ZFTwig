<?php
/**
 * Wrapper for any Zend Framework 1.1x view helpers
 * Syntax : {% hlp 'myHelper' with ['param1': 'value1'] %}
 *
 * @package     Ano_ZFTwig
 * @subpackage  TokenParser
 * @author      Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class Ano_ZFTwig_TokenParser_HelperTokenParser extends Twig_TokenParser
{
    /**
     * Parses a token and returns a node.
     *
     * @param  Twig_Token $token A Twig_Token instance
     * @return Twig_NodeInterface A Twig_NodeInterface instance
     */
    public function parse(Twig_Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();        

        $helper = $this->parser->getStream()->expect(Twig_Token::STRING_TYPE)->getValue();

        $attributes = null;
        if ($stream->test('with')) {
            $stream->next();
            $attributes = $this->parser->getExpressionParser()->parseExpression();
        }

        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new Ano_ZFTwig_Node_HelperNode($helper, $attributes, $lineno, $this->getTag());
    }


    /**
     * Gets the tag name associated with this token parser.
     *
     * @param string The tag name
     */
    public function getTag()
    {
        return 'hlp';
    }
}