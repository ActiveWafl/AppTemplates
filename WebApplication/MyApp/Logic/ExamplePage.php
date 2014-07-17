<?php

namespace {APPLICATION_NAMESPACE}\Logic;

use DblEj\Communication\Http\RequestHandlerBase;

class ExamplePage
extends RequestHandlerBase
{

    public function HandleHttpRequest(\DblEj\Communication\Http\Request $request, $requestString)
    {
        $inputs = $request->GetAllInputs();
        return new \DblEj\Communication\Http\Response("This is the example page", \DblEj\Communication\Http\Response::HTTP_OK_200);
    }

}
?>