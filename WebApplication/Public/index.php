<?php
use Wafl\AppSupport\WebIndex,
    Wafl\Util\HttpRouter;
try
{
    require_once(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."Application.php");
    $requestUri   = $_SERVER["REQUEST_URI"]; //@todo do all http servers use this header?  Tested in apache. And what about REDIRECT_URL, I was checking that as well elsewhere

    $appUid = "{APPLICATION_NAMESPACE}";
    if (WebIndex::OutputCachedStaticResources($requestUri, 86400, $appUid)) //static resources such as images and scripts can be cached on disk
    {
        exit(0);
    } else {
        $application  = WebIndex::BootstrapApplication(__DIR__ . DIRECTORY_SEPARATOR ."..".DIRECTORY_SEPARATOR."Application.syrp", null, "\\Wafl\\Application\\MvcWebApplication");

        //delete old caches
        WebIndex::UncacheStaticResources(null, true, $appUid);

        //first, let the router chain have a look at it.
        //Maybe someone can handle it right away with no need for all the init stuff.
        $preAppRouter = null;
        $preappRawOutput = "";
        $preappOutputHash = null;
        HttpRouter::RouteThruNonAppCalls($requestUri, $preAppRouter, $preappRawOutput, $preappOutputHash);
        if ($preAppRouter !== null)
        {
            WebIndex::CacheRawStaticResource($requestUri, $preappRawOutput, $preappOutputHash, $appUid);//static resources such as images and scripts can be cached on disk
            $exitCode = 0; //successful prerouting
        } else {
            $exitCode = -1;
            if (getenv("WAFL_MAINTENANCE") == 1)
            {
                http_response_code(503);
                require(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."Static".DIRECTORY_SEPARATOR."Maintenance.php");
            }
            $result = WebIndex::RunApplication($application, $exitCode);
            if ($result->Get_ResponseCode() == \DblEj\Communication\Http\Response::HTTP_OK_200)
            {
                WebIndex::CacheStaticResource($requestUri, $result, $appUid);//static resources such as images and scripts can be cached on disk
            }
        }
        exit($exitCode);
    }
}
catch (\DblEj\Communication\Http\Exception $e)
{
    if (\Wafl\Core::$RUNNING_APPLICATION->Get_Settings()->Get_Debug()->Get_DebugMode() && !\Wafl\Core::$RUNNING_APPLICATION->Get_Settings()->Get_Debug()->Get_SuppressErrors())
    {
        throw $e;
    }
    WebIndex::OutputHttpException($e, __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."Static".DIRECTORY_SEPARATOR."Errors".DIRECTORY_SEPARATOR);
}
catch (\Exception $e)
{
    if (class_exists("\\Wafl\\Core") && \Wafl\Core::$RUNNING_APPLICATION->Get_Settings()->Get_Debug()->Get_DebugMode() && !\Wafl\Core::$RUNNING_APPLICATION->Get_Settings()->Get_Debug()->Get_SuppressErrors())
    {
        throw $e;
    }
    WebIndex::OutputException($e, __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."Static".DIRECTORY_SEPARATOR."Errors".DIRECTORY_SEPARATOR);
}
?>