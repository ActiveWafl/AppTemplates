<?php

namespace {APPLICATION_NAMESPACE}\Logic;

use DblEj\Application\IApplication,
    DblEj\Communication\IRequestHandler,
    DblEj\Communication\Response;

class EntryPoint
implements IRequestHandler
{

    public function HandleRequest($requestString, \DblEj\Communication\IRequest $request, IApplication $app)
    {
        if ($requestString == "v")
        {
            return new Response("{APPLICATION_NAME} version 1!");
        }
        else
        {
            return new Response("Available arguments: v=get version, x=example");
        }
    }

}
?>