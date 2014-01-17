<?php

namespace Fabiang\Xmpp\Exception\Stream;

use Fabiang\Xmpp\Event\XMLEvent;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-01-17 at 11:18:45.
 */
class StreamErrorExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test create exception from XMLEvent.
     *
     * @covers Fabiang\Xmpp\Exception\Stream\StreamErrorException::createFromEvent
     * @return void
     */
    public function testCreateFromEventGeneric()
    {
        $document = new \DOMDocument;
        $element = new \DOMElement('error');
        $document->appendChild($element);
        $event   = new XMLEvent;
        $event->setParameters(array($element));
        
        $exception = StreamErrorException::createFromEvent($event);
        $this->assertSame('Generic stream error', $exception->getMessage());
        $this->assertSame('<error/>', $exception->getContent());
    }
    
    /**
     * Test create exception from XMLEvent.
     *
     * @covers Fabiang\Xmpp\Exception\Stream\StreamErrorException::createFromEvent
     * @return void
     */
    public function testCreateFromEventNamed()
    {
        $document = new \DOMDocument;
        $element = new \DOMElement('error');
        $document->appendChild($element);
        
        $reason = new \DOMElement('host-unknown');
        $element->appendChild($reason);
        
        $event   = new XMLEvent;
        $event->setParameters(array($element));
        
        $exception = StreamErrorException::createFromEvent($event);
        $this->assertSame('Stream Error: "host-unknown"', $exception->getMessage());
        $this->assertSame('<error><host-unknown/></error>', $exception->getContent());
    }

    /**
     * Test setting and getting content.
     *
     * @covers Fabiang\Xmpp\Exception\Stream\StreamErrorException::getContent
     * @covers Fabiang\Xmpp\Exception\Stream\StreamErrorException::setContent
     * @return void
     */
    public function testSetAndGetContent()
    {
        $object = new StreamErrorException;
        $this->assertSame('1', $object->setContent(1)->getContent());
    }

}
