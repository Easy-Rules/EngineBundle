<?php
/**
 * Created by PhpStorm.
 * User: AJanssen
 * Date: 10-02-16
 * Time: 10:09
 */

namespace EasyRules\EngineBundle\Domain\Entity\Logic\Rule;

use Doctrine\ORM\Mapping as ORM;
use EasyRules\Engine\Model\Logic\Rule\ActionInterface;
use JMS\Serializer\Annotation as JMS;
use Ramsey\Uuid\Uuid;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;

/**
 * Action.
 *
 * @ORM\Table(name="LOGIC_RULE_ACTION")
 * @ORM\Entity
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class Action implements ActionInterface, ContainsRecordedMessages
{
    use PrivateMessageRecorderCapabilities;

    /**
     * @var \Ramsey\Uuid\Uuid
     *
     * @ORM\Column(name="ACTION_ID", type="uuid")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @JMS\Type("Ramsey\Uuid\Uuid")
     * @JMS\AccessType("public_method")
     */
    protected $actionId;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPE")
     * @JMS\Type("string")
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="PARAMETER")
     * @JMS\Type("string")
     */
    protected $parameter;

    /**
     * @var integer
     *
     * @ORM\Column(name="WEIGHT")
     * @JMS\Type("integer")
     */
    protected $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="RESULT")
     * @JMS\Type("string")
     */
    protected $result;

    /**
     * @var Rule
     *
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @ORM\ManyToOne(targetEntity="EasyRules\EngineBundle\Domain\Entity\Logic\Rule", inversedBy="actions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RULE_ID", referencedColumnName="RULE_ID")
     * })
     * @JMS\Type("EasyRules\EngineBundle\Domain\Entity\Logic\Rule")
     */
    protected $rule;

    /**
     * @return Uuid
     */
    public function getActionId()
    {
        return $this->actionId;
    }

    /**
     * @param Uuid $actionId
     */
    public function setActionId($actionId)
    {
        $this->actionId = $actionId;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return Rule
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @param Rule $rule
     */
    public function setRule($rule)
    {
        $this->rule = $rule;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param string $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * @param string $parameter
     */
    public function setParameter($parameter)
    {
        $this->parameter = $parameter;
    }

    public function getCommandExpression()
    {
        return "(command.setDiscount(10)) + command.setBookingId(message.getBookingId())";
    }

    public function getEventExpression()
    {
        return "(event.setDiscount(10)) + event.setBookingId(message.getBookingId())";
    }
}