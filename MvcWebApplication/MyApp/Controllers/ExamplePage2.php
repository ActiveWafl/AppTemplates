<?php

namespace {APPLICATION_NAMESPACE}\Controllers;

use DblEj\Application\IMvcWebApplication,
    DblEj\Communication\Http\Request,
    DblEj\Mvc\ControllerBase;

class ExamplePage2
extends ControllerBase
{
    public function DefaultAction(Request $request, IMvcWebApplication $app)
    {
        $app->SetLocaleByCode("us");
        return $this->createResponseFromRequest($request, $app);
    }
}