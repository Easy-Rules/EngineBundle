<?php
/**
 * Created by PhpStorm.
 * User: AJanssen
 * Date: 10-02-16
 * Time: 10:09
 */

namespace EasyRules\EngineBundle\Domain\Entity\Logic;

use Doctrine\ORM\Mapping as ORM;
use EasyRules\Engine\Model\Logic\RuleInterface;
use JMS\Serializer\Annotation as JMS;
use Ramsey\Uuid\Uuid;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;

/**
 * Rule.
 *
 * @ORM\Table(name="LOGIC_RULE")
 * @ORM\Entity
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class Rule implements RuleInterface, ContainsRecordedMessages
{
    use PrivateMessageRecorderCapabilities;

    /**
     * @var \Ramsey\Uuid\Uuid
     *
     * @ORM\Column(name="RULE_ID", type="uuid")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @JMS\Type("Ramsey\Uuid\Uuid")
     * @JMS\AccessType("public_method")
     */
    protected $ruleId;

    /**
     * @var string
     *
     * @ORM\Column(name="EXPRESSION")
     * @JMS\Type("string")
     */
    protected $expression;

    /**
     * @var integer
     *
     * @ORM\Column(name="WEIGHT")
     * @JMS\Type("integer")
     */
    protected $weight;

    /**
     * @var Logic
     *
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @ORM\ManyToOne(targetEntity="EasyRules\EngineBundle\Domain\Entity\Logic", inversedBy="rules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="LOGIC_ID", referencedColumnName="LOGIC_ID")
     * })
     * @JMS\Type("EasyRules\EngineBundle\Domain\Entity\Logic")
     */
    protected $logic;

    /**
     * @var ArrayCollection|Rule\Action[]
     *
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @ORM\OneToMany(targetEntity="EasyRules\EngineBundle\Domain\Entity\Logic\Rule\Action", mappedBy="rule")
     * @ORM\OrderBy({"weight" = "ASC"})
     * @JMS\Type("ArrayCollection<EasyRules\EngineBundle\Domain\Entity\Logic\Rule\Action>")
     */
    protected $actions;

    /**
     * @return Uuid
     */
    public function getRuleId()
    {
        return $this->ruleId;
    }

    /**
     * @param Uuid $ruleId
     */
    public function setRuleId($ruleId)
    {
        $this->ruleId = $ruleId;
    }

    /**
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * @param string $expression
     */
    public function setExpression($expression)
    {
        $this->expression = $expression;
    }

    /**
     * @return Logic
     */
    public function getLogic()
    {
        return $this->logic;
    }

    /**
     * @param Logic $logic
     */
    public function setLogic($logic)
    {
        $this->logic = $logic;
    }

    /**
     * @return ArrayCollection|Rule\Action[]
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param ArrayCollection|Rule\Action[] $actions
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
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
}