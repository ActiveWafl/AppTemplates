<?php

namespace {APPLICATION_NAMESPACE}\Logic;

use DblEj\Communication\Http\RequestHandlerBase;

class ExamplePage1
extends RequestHandlerBase
{
    public function HandleHttpRequest(\DblEj\Communication\IRequest $request, $requestString, \DblEj\Application\IApplication $app)
    {
        $inputs = $request->GetAllInputs();
        return new \DblEj\Communication\Http\Response("This is the example 1 page", \DblEj\Communication\Http\Response::HTTP_OK_200);
    }
}