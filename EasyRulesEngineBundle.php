<?php

namespace EasyRules\EngineBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use EasyRules\EngineBundle\Domain\Entity\EasyRulesEngineMapping;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EasyRulesEngineBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {

        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createAnnotationMappingDriver(
                [
                    EasyRulesEngineMapping::NAMESPACE_PREFIX,
                ],
                [
                    EasyRulesEngineMapping::DIRECTORY,
                ]
            )
        );
    }

}
