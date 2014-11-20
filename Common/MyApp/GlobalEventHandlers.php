<?php
DblEj\Util\SystemEvents::AddSystemHandler(DblEj\Util\SystemEvents::AFTER_INITIALIZE, function()
{
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