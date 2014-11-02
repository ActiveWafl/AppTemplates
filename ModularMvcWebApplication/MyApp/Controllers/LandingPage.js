Namespace("{APPLICATION_NAMESPACE}.Controllers");

{APPLICATION_NAMESPACE}.Controllers.LandingPage = DblEj.Mvc.ControllerBase.extend({
    init: function()
    {
        this._setMenuClassFromUrl = function()
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
        };              
    },
	DefaultAction: function()
	{
        DblEj.EventHandling.Events.AddHandler(window, "hashchange", function(e)
        {
            this._setMenuClassFromUrl();
        }.Bind(this));
    }
});