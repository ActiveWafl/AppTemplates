{extends file="./MainHead.tpl"}
{block "HTML_BODY"}
    <body>
		<header class="Dock Top">
			<grid-layout auto>
				<layout-row>
					<layout-cell spans="2">
						<a href="/">
							<img src="/Resources/Images/ActiveWafl_Small.png" style="max-height: 42px; margin: 10px 0 0 4px;" />
                            <h5>You have successfully setup your new Web Application</h5>
						</a>
					</layout-cell>
					<layout-cell spans="10">
						{block name="MainLayoutMenuBar"}{/block}
					</layout-cell>
				</layout-row>
			</grid-layout>
            <div style="clear: both;"></div>
            {block name="MainLayoutSubMenuBar"}{/block}
		</header>

        {block "HTML_BODY_CONTENTS"}
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

            {block name="PAGE_CONTENT"}Page Contents Go Here{/block}
        {/block}

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
        <script src="/GlobalScript.js"></script>
        {if isset($CURRENT_SITEPAGE) && $CURRENT_SITEPAGE->DoesClientLogicExist($APP)}
            <script src="/{$CURRENT_SITEPAGE->GetClientLogicFile()}"></script>
        {/if}
        {if isset($CURRENT_SITEPAGE) && $CURRENT_SITEPAGE->HasClientControlObjects()}
            <script src="/{$CURRENT_SITEPAGE->GetClientLogicFile()|replace:".js":"-Controls.js"}}"></script>
        {/if}
        {if isset($ADDITIONAL_RAW_FOOT_HTML)}{$ADDITIONAL_RAW_FOOT_HTML}{/if}
        {block "HTML_BODY_POSTCONTENT"}{/block}
        {nocache}
        {block "SCRIPT_POST_BODY"}
            <script>
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