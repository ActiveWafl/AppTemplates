Namespace("{EXTENSIONS_NAMESPACE_JS}.{EXTENSION_NAME}.Controllers");

{EXTENSIONS_NAMESPACE_JS}.{EXTENSION_NAME}.Controllers.SomePage = DblEj.Mvc.ControllerBase.extend({
	DefaultAction: function()
	{
		$("SomeElement")
			.AddClickHandler
			(
				function()
				{
					  //do something
				}
			);
	}
});