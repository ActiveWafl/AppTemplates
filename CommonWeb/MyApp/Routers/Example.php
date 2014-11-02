<?php

namespace {APPLICATION_NAMESPACE}\Routers;

use DblEj\Application\IApplication,
    DblEj\Communication\IRequest,
    DblEj\Communication\IRouter,
    DblEj\Communication\Route;

class Example
implements IInternalRouter
{

    public function GetRoute(IRequest $request, IApplication $app = null, IRouter &$usedRouter = null)
    {
        return $this->GetHttpRoute($request, $app, $usedRouter);
    }

    public function GetHttpRoute(\DblEj\Communication\Http\Request $request, \DblEj\Application\IWebApplication $app = null, \DblEj\Communication\Http\Routing\IRouter &$usedRouter = null)
    {
        $returnRoute = false;
        $usedRouter  = $this;

        //if the requested page is x (http://example.com/x), then route the request to the ExampleRequestHandler controller.
        //Otherwise, route all requests to the EntryPoint controller.
        if ($request->Get_Request() == "x")
        {
            $returnRoute = new Route(["\\{APPLICATION_NAMESPACE}\\Controllers\\ExampleRequestHandler",
                "HandleRequest"], [$request->Get_Request(),
                $request,
                $app]);
        }
        //Note: You don't need a catch-all "else" like we have here.  There is a set of default
        //routers already installed that will handle most normal routing needs.
        else
        {
            $returnRoute = new Route(["\\{APPLICATION_NAMESPACE}\\Controllers\\EntryPoint",
                "HandleRequest"], [$request->Get_Request(),
                $request,
                $app]);
        }
        return $returnRoute;
    }

}
?>