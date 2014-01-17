<?php

/**
 * Copyright 2014 Fabian Grutschus. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * The views and conclusions contained in the software and documentation are those
 * of the authors and should not be interpreted as representing official policies,
 * either expressed or implied, of the copyright holders.
 *
 * @author    Fabian Grutschus <f.grutschus@lubyte.de>
 * @copyright 2014 Fabian Grutschus. All rights reserved.
 * @license   BSD
 * @link      http://github.com/fabiang/xmpp
 */

namespace Fabiang\Xmpp\Exception\Stream;

use Fabiang\Xmpp\Exception\RuntimeException;
use Fabiang\Xmpp\Event\XMLEvent;

/**
 * Exception class for error generated by stream,
 *
 * @package Xmpp\Exception\Stream
 */
class StreamErrorException extends RuntimeException
{

    /**
     * XML content.
     *
     * @var string
     */
    protected $content;

    /**
     * Create exception from XMLEvent object.
     *
     * @param \Fabiang\Xmpp\Event\XMLEvent $event XMLEvent object
     * @return static
     */
    public static function createFromEvent(XMLEvent $event)
    {
        /* @var $element \DOMElement */
        list($element) = $event->getParameters();

        /* @var $first \DOMElement */
        $first = $element->firstChild;

        if (null !== $first && XML_ELEMENT_NODE === $first->nodeType) {
            $message = 'Stream Error: "' . $first->localName . '"';
        } else {
            $message = 'Generic stream error';
        }

        $exception = new static($message);
        $exception->setContent($element->ownerDocument->saveXML($element));
        return $exception;
    }

    /**
     * Get xml content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set XML contents.
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = (string) $content;
        return $this;
    }

}
