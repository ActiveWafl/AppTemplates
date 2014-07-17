<?php

namespace {APPLICATION_NAMESPACE}\Logic;

use DblEj\Communication\Http\RequestHandlerBase;

class LandingPage
extends RequestHandlerBase
{

    public function HandleHttpRequest(\DblEj\Communication\Http\Request $request, $requestString, \DblEj\Application\IWebApplication $app)
    {
        $sitePage = $app->GetSitePageByRequest($request);
        return new \DblEj\Communication\Http\SitePageResponse($sitePage);
    }

}
?>