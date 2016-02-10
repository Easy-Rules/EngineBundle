<?php
/**
 * Created by PhpStorm.
 * User: AJanssen
 * Date: 10-02-16
 * Time: 10:09
 */

namespace EasyRules\EngineBundle\Domain\Entity\Logic;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Ramsey\Uuid\Uuid;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;

/**
 * Trigger.
 *
 * @ORM\Table(name="LOGIC_TRIGGER")
 * @ORM\Entity
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class Trigger implements ContainsRecordedMessages
{
    use PrivateMessageRecorderCapabilities;

    /**
     * @var \Ramsey\Uuid\Uuid
     *
     * @ORM\Column(name="TRIGGER_ID", type="uuid")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @JMS\Type("Ramsey\Uuid\Uuid")
     * @JMS\AccessType("public_method")
     */
    protected $triggerId;

    /**
     * @var string
     *
     * @ORM\Column(name="COMMAND")
     * @JMS\Type("string")
     */
    protected $command;

    /**
     * @var string
     *
     * @ORM\Column(name="EVENT")
     * @JMS\Type("string")
     */
    protected $event;

    /**
     * @return Uuid
     */
    public function getTriggerId()
    {
        return $this->triggerId;
    }

    /**
     * @param Uuid $triggerId
     */
    public function setTriggerId($triggerId)
    {
        $this->triggerId = $triggerId;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param array $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param string $command
     */
    public function setCommand($command)
    {
        $this->command = $command;
    }

    /**
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param string $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }
}