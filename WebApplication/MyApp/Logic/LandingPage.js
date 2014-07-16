Start(function() {
    DblEj.EventHandling.Events.AddHandler(window, "hashchange", function(e)
    {
        SetMenuClassFromUrl();
    });

    SetMenuClassFromUrl();
});

function SetMenuClassFromUrl()
{
    $$q('#PageMenu a')
        .RemoveClass('Selected');
    if (window.location.hash.length == 0)
    {
        $("MenuInstallComplete")
            .AddClass('Selected');
    } else {
        $("Menu" + window.location.hash.substring(1))
            .AddClass('Selected');
    }
}