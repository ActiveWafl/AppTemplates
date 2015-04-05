<?php
use Wafl\AppSupport\WebIndex;
use Wafl\Util\HttpRouter;

//WAFL web application support file
require_once(__DIR__."/../AppSupport.phar");

//This is here to warn you of configuration errors
//It can be deleted
$requestDomain = $_SERVER["SERVER_NAME"];
if (strtolower($requestDomain) != strtolower($application->Get_Settings()->Get_Web()->Get_DomainName()))
{
    throw new Wafl\Application\Settings\InvalidSettingException("DomainName","The domain name that you have set in Settings.".WAFL_ENVIRONMENT.".syrp (".$application->Get_Settings()->Get_Web()->Get_DomainName().") does not match the domain name in the current request URL ($requestDomain).  Please specify the correct domain or access the page through the specified URL.");
}

//Get the requested URI so we know what to do
$requestUri		 = $_SERVER["REQUEST_URI"];

//once rendered, dynamic resources such as dynamic images and dynamic scripts can be cached on disk in their static state for improved performance
//This is important in WAFL as many of these resources are generated dynamically
if (WebIndex::OutputCachedStaticResources($requestUri))
{
    $exitCode = 0;
} else {

    //Initialize the application
    $application = WebIndex::BootstrapApplication(__DIR__."/../Application.syrp",null,"\\Wafl\\Application\\MvcWebApplication");

    //delete expired caches
    WebIndex::UncacheStaticResources(null, true);

    //give all of the routers an opportunity to handle the request right away, before executing the application logic
    //this improves performance for those requests that do not require the application logic
    HttpRouter::RouteThruNonAppCalls($requestUri, $preAppRouter);

    if ($preAppRouter !== null)
    {
        //If a router handled the request in the pre-routing stage,
        //and it returned a dynamically generated resource such as an image or a script
        //then cache its response, so that next time we can just serve it in its already-compiled form.
        WebIndex::CacheRawStaticResource($requestUri, $preappRawOutput, $preappOutputHash);

        //set the exit code to indicate success
        $exitCode = 0;
    } else {

        //If a router did not handle the request in the pre-routing stage,
        //then run the full application, which will route the request and return the result.
        //(it will also output any generated HTML to the browser along with appropriate HTTP headers)
        $result = WebIndex::RunApplication($application, $exitCode);

        if ($result->Get_ResponseCode() == \DblEj\Communication\Http\Response::HTTP_OK_200)
        {

            //If the application returned a dynamically generated resource such as an image or a script
            //then cache its response, so that next time we can just serve it in its already-compiled form.
            WebIndex::CacheStaticResource($requestUri, $result);

            //set the exit code to indicate success
            $exitCode = 0;
        } else {
            //set the exit code to indicate a non-normal response
            $exitCode = -1;
        }
    }
}

//return the exit code
exit($exitCode);
?>