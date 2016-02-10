<?php
/**
 * Created by PhpStorm.
 * User: AJanssen
 * Date: 10-02-16
 * Time: 10:38
 */

namespace EasyRules\EngineBundle\Infrastructure\DoctrineORM;

use Doctrine\Common\Persistence\ManagerRegistry;
use EasyRules\EngineBundle\Domain\Entity\Logic;
use EasyRules\EngineBundle\Model\LogicRepositoryInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class LogicRepository
 *
 * @package EasyRules\EngineBundle\Infrastructure\DoctrineORM
 */
class LogicRepository implements LogicRepositoryInterface
{
    protected $class = Logic::class;

    /**
     * @param $command
     *
     * @return Logic
     */
    public function byCommand($command)
    {
        $queryBuilder = $this->getRepository()->createQueryBuilder('l');
        $queryBuilder->join('l.trigger', 't');
        $queryBuilder->andWhere('t.command = :command');
        $queryBuilder->setParameter('command', $command);

        return $queryBuilder->getQuery()->getResult();
    }


    /**
     * @param string $class
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository($class = null)
    {
        if (!$class) {
            $class = $this->class;
        }

        return $this->getManager()->getRepository($class);
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    public function getManager()
    {
        return $this->doctrine->getManager();
    }

    /**
     * @var ManagerRegistry
     */
    protected $doctrine;

    /**
     * @param \Doctrine\Common\Persistence\ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }


}