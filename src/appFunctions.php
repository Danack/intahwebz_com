<?php

use Amp\Artax\Client as ArtaxClient;
use ArtaxServiceBuilder\ResponseCache;
use Arya\Response;
use Jig\JigConfig;
use Jig\Jig;
use Tier\ResponseBody\HtmlBody;
use Jig\JigBase;
use Tier\Tier;
use Tier\InjectionParams;
use Tier\Data\RouteList;
use GithubService\GithubArtaxService\GithubService;
use Tier\Data\ErrorInfo;



/**
 * @return JigConfig
 */
function createJigConfig()
{
    $jigConfig = new JigConfig(
        __DIR__."/../templates/",
        __DIR__."/../var/compile/",
        'tpl',
        getEnvWithDefault('jig.compile', \Jig\Jig::COMPILE_ALWAYS)
    );

    return $jigConfig;
}
