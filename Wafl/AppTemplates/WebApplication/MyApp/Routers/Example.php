<?php

namespace MyApp\Routers;

use DblEj\Application\IApplication,
    DblEj\Communication\IRequest,
    DblEj\Communication\IRouter,
    DblEj\Communication\Route;

class Example
implements IRouter
{

    public function GetRoute(IRequest $request, IApplication $app = null, IRouter &$usedRouter = null)
    {
        $returnRoute = false;
        $usedRouter  = $this;
        if ($request->Get_Request() == "x")
        {
            $returnRoute = new Route(["\\MyApp\\Logic\\ExampleRequestHandler",
                "HandleRequest"], [$request->Get_Request(),
                $request,
                $app]);
        }
        else
        {
            $returnRoute = new Route(["\\MyApp\\Logic\\EntryPoint",
                "HandleRequest"], [$request->Get_Request(),
                $request,
                $app]);
        }
        return $returnRoute;
    }

}
?>