function NotifyAjaxError(response, prefixMessage, showDuration)
{
    var isError = IsDefined(response.ErrorMessage);
    if (isError)
    {
        if (prefixMessage)
        {
            NotifyInfo(prefixMessage, response.ErrorMessage, null, showDuration);
        } else {
            NotifyInfo(response.ErrorMessage, null, null, showDuration);
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
    if (IsDefined($("InfoNotificationPanel")["_hideTimer"]) && $("InfoNotificationPanel")._hideTimer != null)
    {
        clearTimeout($("InfoNotificationPanel")._hideTimer);
        $("InfoNotificationPanel")._hideTimer = null;
    }

    $("InfoNotificationPanel").SetCss("top","auto");
    $("InfoNotificationPanel").SetCss("height","auto");
    $("InfoNotificationPanel").SetCss("bottom", "auto");
    $("InfoNotificationPanel").SetCss("left","auto");
    var notifyHeight = $("InfoNotificationPanel").GetAbsoluteSize().Get_Y();
    var bodySize = document.body.GetAbsoluteSize();
    var bodyWidth = bodySize.Get_X();
    $("InfoNotificationPanel").SetData("last-title", title);
    $("InfoNotificationPanel").SetData("last-description", description);
    $("InfoNotificationPanel").SetCss("bottom", -notifyHeight+"px");
    $("InfoNotifcationContent").RemoveAllChildren();
    $("InfoNotifcationContent")
        .AppendChild($create("<header>" +
            title +
            "</header>"));
    if (!IsNullOrUndefined(description))
    {
        $("InfoNotifcationContent")
            .AppendChild($create("<p>" +
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
    $("InfoNotificationPanel").Show().BringToFront();
    if (bodyWidth > 1029)
    {
        $("InfoNotificationPanel").SetCss("right","0px");
        $("InfoNotificationPanel").SetCss("left","auto");
        $("InfoNotificationPanel").SetCss("width","30em");
        var footerHeight = $q("body>footer").GetAbsoluteSize().Get_Y();
        var scrollMax = window.GetSize().Get_Y() - window.innerHeight;
        var distanceFromBottom = scrollMax - window.GetOffsetPoint().Get_Y();
        if (($q("footer").GetStyle("position") == "fixed") || (footerHeight > distanceFromBottom))
        {
            $("InfoNotificationPanel").AnimateProperty("bottom", (footerHeight-distanceFromBottom), "px", 40000);
        } else {
            $("InfoNotificationPanel").AnimateProperty("bottom", 0, "px");
        }
    } else {
        $("InfoNotificationPanel").SetCss("right","0px");
        $("InfoNotificationPanel").SetCss("left","0px");
        $("InfoNotificationPanel").SetCss("width","auto");
        $("InfoNotificationPanel").AnimateProperty("bottom", 0, "px");
    }
    $("InfoNotificationPanel")._hideTimer =
        setTimeout(function() {
            $("InfoNotificationPanel").FadeOut(null, function(){ $("InfoNotificationPanel")._hideTimer = null; $("InfoNotifcationContent").RemoveAllChildren();});
        }, showDuration);
}