{extends file="./MainHead.tpl"}
{block "HTML_BODY"}
    <body>
		<header style="width: 100%; background-color: rgba(240,240,240,.95); position: fixed;z-index: 999;">
			<grid-layout auto>
				<layout-row>
					<layout-cell spans="2">
						<a href="/">
							<img src="/Resources/Images/ActiveWafl_Small.png" style="max-height: 42px; margin: 10px 0 0 4px;" />
						</a>
					</layout-cell>
					<layout-cell spans="10">
                        <hgroup>
                            <h1>{$SITE_DISPLAY_TITLE}</h1>
                            <h2>You have successfully setup your new Modular Mvc Web Application</h2>
                        </hgroup>
					</layout-cell>
				</layout-row>
			</grid-layout>
            <div style="clear: both;"></div>
            {block name="MainLayoutSubMenuBar"}{/block}
		</header>

		{block name="MainLayoutErrorBox"}
			{if count($GLOBAL_ERRORS)>0}
				{include file="Parts/GeneralErrors.tpl"}
			{/if}
		{/block}
		{block name="MainLayoutInfoBox"}
			{if count($GLOBAL_INFO)>0}
				{include file="Parts/GeneralInfo.tpl"}
			{/if}
		{/block}
        {block "HTML_BODY_CONTENTS"}{/block}

        <footer class="Bottom Dock">
            <div class="Auto Layout Grid">
                <div class="Row">
                    <div class="Spans12 Align Center">
                        (c) 2017 Acme Inc.
                    </div>
                </div>
            </div>
        </footer>
        {block "ABSOLUTE_CONTENTS"}{/block}
        <script type="text/javascript" src="/GlobalScript.js"></script>
        {if isset($CURRENT_SITEPAGE) && $CURRENT_SITEPAGE->DoesClientLogicExist($APP)}
            <script type="text/javascript" src="/{$CURRENT_SITEPAGE->GetClientLogicFile()}"></script>
        {/if}
        {if isset($CURRENT_SITEPAGE) && $CURRENT_SITEPAGE->HasClientControlObjects()}
            <script type="text/javascript" src="/{$CURRENT_SITEPAGE->GetClientLogicFile()|replace:".js":"-Controls.js"}}"></script>
        {/if}
        {if isset($ADDITIONAL_RAW_FOOT_HTML)}{$ADDITIONAL_RAW_FOOT_HTML}{/if}
        {block "HTML_BODY_POSTCONTENT"}{/block}
        {nocache}
            {block "SCRIPT_POST_BODY"}
            <script type="text/javascript">
                {if isset($CURRENT_SITEPAGE)}
                {foreach $CURRENT_SITEPAGE->Get_JavascriptIncludesLib() as $JAVASCRIPT}
                DblEj.SiteStructure.SitePage.SetFileIncluded("{$JAVASCRIPT}");
                {/foreach}
                {/if}
                {nominify}document.CurrentUserDisplayName = "{if isset($CURRENT_USER) && $CURRENT_USER}{$CURRENT_USER->Get_Username()}{else}No User{/if}";{/nominify}
                DblEj.StartApp();
            </script>
            {/block}
        {/nocache}
	</body>
{/block}