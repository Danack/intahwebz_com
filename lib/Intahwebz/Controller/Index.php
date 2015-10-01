<?php

namespace Intahwebz\Controller;

use Tier\JigBridge\TierJig;
use Tier\InjectionParams;

class Index
{
    public function renderIndexPage(TierJig $tierJig)
    {

//        $injectionParams = InjectionParams::fromParams(['pageTitle' => "Imagick demos"]);
//        $injectionParams->alias('ImagickDemo\Navigation\Nav', 'ImagickDemo\Navigation\NullNav');

        return $tierJig->createTemplateTier('pages/index');
    }

}
