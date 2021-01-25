<?php
namespace {APPLICATION_NAMESPACE}\Routers;

use DblEj\Application\IApplication,
    DblEj\Communication\IRequest,
    DblEj\Communication\IRouter,
    DblEj\Communication\Http\Routing\Route;

class ExampleInternalRouter
implements \DblEj\Communication\Http\Routing\IInternalRouter
{

    public function GetRoute(IRequest $request, IApplication $app = null, IRouter &$usedRouter = null)
    {
        return $this->GetHttpRoute($request, $app, $usedRouter);
    }

    public function GetHttpRoute(\DblEj\Communication\Http\Request $request, \DblEj\Application\IWebApplication $app = null, \DblEj\Communication\Http\Routing\IRouter &$usedRouter = null)
    {
        //Return the Route, or false if this Router does not have a Route for this request
        $returnRoute = false;

        //if the requested page is "x1" or "x2" (i.e. http://{APPLICATION_DOMAIN}/x1),
        //then route the request to the "ExamplePage1" or "ExamplePage2" handler, respectively
        //Otherwise, don't route it (it will end up being routed by other app routers or default framework routers)
        if ($request->Get_Request() == "x1")
        {
            $returnRoute = new Route($request, array(new \{APPLICATION_NAMESPACE}\Logic\ExamplePage1(),"CallAction"), array($request->Get_RequestUrl(), $request, $app));

            //modify the usedRouter argument (it is passed by ref) so the RouterChain knows who provided the returned Route
            $usedRouter  = $this;
        }
        elseif ($request->Get_Request() == "x2")
        {
            $returnRoute = new Route($request, array(new \{APPLICATION_NAMESPACE}\Controllers\ExamplePage2(),"CallAction"), array($request->Get_RequestUrl(), $request, $app));

            //modify the usedRouter argument (it is passed by ref) so the RouterChain knows who provided the returned Route
            $usedRouter  = $this;
        }
        return $returnRoute;
    }
}