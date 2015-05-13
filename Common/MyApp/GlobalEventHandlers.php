<?php
DblEj\Util\SystemEvents::AddSystemHandler(DblEj\Util\SystemEvents::AFTER_INITIALIZE, function()
{

    if (!defined("AM_WEBPAGE") || (AM_WEBPAGE === true))
    {
        \Wafl\Core::$RUNNING_APPLICATION->AddHandler(
            new \DblEj\EventHandling\DynamicEventHandler
            (
                \Wafl\Application\Application::EVENT_APPLICATION_BEFORE_INITIALIZE,
                function(\DblEj\EventHandling\EventInfo $eventInfo)
                {
                    \Wafl\Util\HttpRouter::AddRouter(new CaptchaImage());
                    \Wafl\Util\HttpRouter::AddRouter(new Glyphs());
                    \Wafl\Util\HttpRouter::AddRouter(new Icons());
                }
            )
        );
    }
    $traceHandler = new \DblEj\Logging\PhpLogTraceHandler();
    $traceHandler->SetOption("PhpLogType", \DblEj\Logging\PhpLogTraceHandler::LOGTYPE_SYSTEM);
    \DblEj\Logging\Tracing::SetTraceHandler($traceHandler);

    //setup clientside model load/save security
    Wafl\Api\DataModelHandlers::SetAuthenticateReadAccessMethod(AuthenticateModelRead);
    Wafl\Api\DataModelHandlers::SetAuthenticateWriteAccessMethod(AuthenticateModelWrite);

    function AuthenticateModelRead(\DblEj\Data\PersistableModel $model)
    {
        return $model->DoesCurrentUserHaveReadAccess();
    }

    function AuthenticateModelWrite(\DblEj\Data\PersistableModel $model)
    {
        return $model->DoesUserHaveWriteAccess();
    }
});
?>