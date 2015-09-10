Start(function()
{
    //Global js script here
    function NotifyAjaxError(response, prefixMessage)
    {
        var isError = IsDefined(response.ErrorMessage);
        if (isError)
        {
            if (prefixMessage)
            {
                NotifyInfo(prefixMessage, response.ErrorMessage);
            } else {
                NotifyInfo(response.ErrorMessage);
            }
        }
        return isError;
    }
    function NotifyInfo(title, description, finePrint, showDuration)
    {
        if (IsNullOrUndefined(showDuration))
        {
            showDuration = 10000;
        }
        $("InfoNotifcationContent")
            .AppendChild($create("<h3>" +
                title +
                "</h3>"));
        if (!IsNullOrUndefined(description))
        {
            $("InfoNotifcationContent")
                .AppendChild($create("<p style='margin-bottom: 2px;'>" +
                    description +
                    "</p>"));
        }
        if (!IsNullOrUndefined(finePrint))
        {
            $("InfoNotifcationContent")
                .AppendChild($create("<p style='margin-top: 2px;'><small>" +
                    finePrint +
                    "</small></p>"));
        }
        $("InfoNotificationPanel").Show();
        setTimeout(function() {
            $("InfoNotificationPanel").FadeOut(null, function(){$("InfoNotifcationContent").RemoveAllChildren();});
        }, showDuration);
    }});