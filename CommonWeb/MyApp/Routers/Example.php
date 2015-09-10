<?php

namespace {APPLICATION_NAMESPACE}\Routers;

use DblEj\Application\IApplication,
    DblEj\Communication\IRequest,
    DblEj\Communication\IRouter,
    DblEj\Communication\Http\Routing\Route;

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
        $action = $request->GetInput("Action")?$request->GetInput("Action"):"DefaultAction";

        //if the requested page is x (http://example.com/x), then route the request to the ExampleRequestHandler controller.
        //Otherwise, route all requests to the EntryPoint controller.
        if ($request->Get_Request() == "x")
        {
            $returnRoute = new Route($request, array(new \{APPLICATION_NAMESPACE}\Controllers\ExampleRequestHandler(),"CallAction"), array($action, $request, $app));
        }
        return $returnRoute;
    }
}
?>