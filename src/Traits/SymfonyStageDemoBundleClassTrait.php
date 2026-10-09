<?php

namespace Wexample\SymfonyStageDemo\Traits;

use Wexample\SymfonyHelpers\Traits\BundleClassTrait;
use Wexample\SymfonyStageDemo\WexampleSymfonyStageDemoBundle;

trait SymfonyStageDemoBundleClassTrait
{
    use BundleClassTrait;

    public static function getBundleClassName(): string
    {
        return WexampleSymfonyStageDemoBundle::class;
    }
}
