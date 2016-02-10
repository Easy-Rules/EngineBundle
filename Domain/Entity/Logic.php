<?php
/**
 * Created by PhpStorm.
 * User: AJanssen
 * Date: 10-02-16
 * Time: 09:59
 */

namespace EasyRules\EngineBundle\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use EasyRules\Engine\Model\LogicInterface;
use JMS\Serializer\Annotation as JMS;
use Ramsey\Uuid\Uuid;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;

/**
 * Logic.
 *
 * @ORM\Table(name="LOGIC")
 * @ORM\Entity
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class Logic implements LogicInterface, ContainsRecordedMessages
{
    use PrivateMessageRecorderCapabilities;

    /**
     * @var \Ramsey\Uuid\Uuid
     *
     * @ORM\Column(name="LOGIC_ID", type="uuid")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @JMS\Type("Ramsey\Uuid\Uuid")
     * @JMS\AccessType("public_method")
     */
    protected $logicId;

    /**
     * @var Logic\Trigger
     *
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @ORM\ManyToOne(targetEntity="EasyRules\EngineBundle\Domain\Entity\Logic\Trigger")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TRIGGER_ID", referencedColumnName="TRIGGER_ID")
     * })
     * @JMS\Type("EasyRules\EngineBundle\Domain\Entity\Logic\Trigger")
     */
    private $trigger;

    /**
     * @var ArrayCollection|Logic\Rule[]
     *
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @ORM\OneToMany(targetEntity="EasyRules\EngineBundle\Domain\Entity\Logic\Rule", mappedBy="logic")
     * @ORM\OrderBy({"weight"="ASC"})
     * @JMS\Type("ArrayCollection<EasyRules\EngineBundle\Domain\Entity\Logic\Rule>")
     */
    protected $rules;

    /**
     * @return Uui
     */
    public function getLogicId()
    {
        return $this->logicId;
    }

    /**
     * @param Uuid $logicId
     */
    public function setLogicId($logicId)
    {
        $this->logicId = $logicId;
    }

    /**
     * @return Logic\Trigger
     */
    public function getTrigger()
    {
        return $this->trigger;
    }

    /**
     * @param Logic\Trigger $trigger
     */
    public function setTrigger($trigger)
    {
        $this->trigger = $trigger;
    }

    /**
     * @return ArrayCollection|Logic\Rule[]
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param ArrayCollection|Logic\Rule[] $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    }
}