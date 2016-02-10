<?php
/**
 * Created by PhpStorm.
 * User: AJanssen
 * Date: 10-02-16
 * Time: 13:22
 */

namespace EasyRules\EngineBundle\Model;

use EasyRules\Engine\Model\LogicInterface;

/**
 * Interface LogicRepositoryInterface
 *
 * @package EasyRules\EngineBundle\Model
 */
interface LogicRepositoryInterface
{
    /**
     * @param $command
     *
     * @return LogicInterface
     */
    public function byCommand($command);
}