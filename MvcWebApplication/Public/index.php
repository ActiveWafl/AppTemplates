<?php
use Wafl\AppSupport\WebIndex,
    Wafl\Util\HttpRouter;

$requestUri   = $_SERVER["REQUEST_URI"]; //@todo do all http servers use this header?  Tested in apache. And what about REDIRECT_URL, I was checking that as well elsewhere
try
{
    require_once(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."Application.php");

    $appUid = "{APPLICATION_NAMESPACE}";
    if (WebIndex::OutputCachedStaticResources($requestUri, 86400, $appUid)) //static resources such as images and scripts can be cached on disk
    {
        exit(0);
    } else {
        $application  = WebIndex::BootstrapApplication(__DIR__ . DIRECTORY_SEPARATOR ."..".DIRECTORY_SEPARATOR."Application.syrp", null, "\\Wafl\\Application\\MvcWebApplication");

        //delete old caches
        //when a page is requested there are actually several files that get requested through index
        //and so this gets called many times.
        //This can cause a race condition where one thread is trying to delete a resource that another thread has already deleted
        //to help avoid this, we will only try to uncache on landing pages (urls ending with slash)
        if (stristr($requestUri, "?"))
        {
            $baseUri = substr($requestUri, 0, stripos($requestUri, "?"));
        } else {
            $baseUri = $requestUri;
        }
        if (\DblEj\Util\Strings::EndsWith($baseUri, "/"))
        {
            WebIndex::UncacheStaticResources(null, true, $appUid);
        }

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
    $reqExt = substr($_SERVER["REQUEST_URI"], strlen($_SERVER["REQUEST_URI"]) - 3);
    $exMessage = "Unhandled HTTP exception: ".$e->getMessage();
    while ($e->getPrevious())
    {
        $e = $e->getPrevious();
        $exMessage.="\nInner Exception: ".$e->getMessage();
    }
    $exMessage .= "\n".$e->getTraceAsString();

    if (\Wafl\Core::$RUNNING_APPLICATION->Get_Settings()->Get_Debug()->Get_DebugMode() && !\Wafl\Core::$RUNNING_APPLICATION->Get_Settings()->Get_Debug()->Get_SuppressErrors())
    {
        throw $e;
    }
    else if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest")
    {
        die(\DblEj\Communication\JsonUtil::EncodeJson($e));
    }
    else
    {
        WebIndex::OutputHttpException($e, __DIR__.DIRECTORY_SEPARATOR);
    }
}
catch (\Exception $e)
{
    if (class_exists("\\Wafl\\Core") && (!\Wafl\Core::$RUNNING_APPLICATION || (\Wafl\Core::$RUNNING_APPLICATION->Get_Settings()->Get_Debug()->Get_DebugMode() && !\Wafl\Core::$RUNNING_APPLICATION->Get_Settings()->Get_Debug()->Get_SuppressErrors())))
    {
        throw $e;
    }
    if (class_exists("\\Wafl\\AppSupport\\WebIndex"))
    {
        WebIndex::OutputException($e, __DIR__.DIRECTORY_SEPARATOR);
    }
    $exMessage = "Unhandled exception: ".$e->getMessage();
    $prevE = $e;
    while ($prevE->getPrevious())
    {
        $prevE = $prevE->getPrevious();
        $exMessage.="\nInner Exception: ".$prevE->getMessage();
    }
    $exMessage .= "\n".$e->getTraceAsString();
    error_log($exMessage);
}
?>