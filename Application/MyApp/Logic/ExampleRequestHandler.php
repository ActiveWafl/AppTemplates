<?php

namespace {APPLICATION_NAMESPACE}\Logic;

use DblEj\Application\IApplication,
    DblEj\Communication\IRequest,
    DblEj\Communication\IRequestHandler,
    DblEj\Communication\Response,
    Exception;

class ExampleRequestHandler
implements IRequestHandler
{

    public function HandleRequest($requestString, IRequest $request, IApplication $app)
    {
        if ($requestString == "x")
        {
            return new Response("Your request has been handled!");
        }
        else
        {
            throw new Exception("Invalid request");
        }
    }

}
?>