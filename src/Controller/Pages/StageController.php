<?php

namespace Wexample\SymfonyStageDemo\Controller\Pages;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Wexample\SymfonyHelpers\Helper\VariableHelper;
use Wexample\SymfonyLoader\Controller\AbstractPagesController;
use Wexample\SymfonyStageDemo\Traits\SymfonyStageDemoBundleClassTrait;

/**
 * The stage of symfony-stage: a timeline moved along its line, as a process
 * reads, then a diagram moved every way.
 */
#[Route(path: '/stage/', name: 'stage_demo_')]
final class StageController extends AbstractPagesController
{
    use SymfonyStageDemoBundleClassTrait;

    final public const string ROUTE_INDEX = VariableHelper::INDEX;

    final public const string ROUTE_DIAGRAM = 'diagram';

    #[Route(path: '', name: self::ROUTE_INDEX)]
    public function index(): Response
    {
        return $this->renderPage(self::ROUTE_INDEX);
    }

    #[Route(path: self::ROUTE_DIAGRAM, name: self::ROUTE_DIAGRAM)]
    public function diagram(): Response
    {
        return $this->renderPage(self::ROUTE_DIAGRAM);
    }
}
