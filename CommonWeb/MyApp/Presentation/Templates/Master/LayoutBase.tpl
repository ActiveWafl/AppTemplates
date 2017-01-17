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
						{block name="MainLayoutMenuBar"}{/block}
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

		<footer>
			<div id="MainContentFooter">
				<div style="position: absolute; right: 0px; z-index: 9999">
					<button onclick="$('CollapseFooterButton').ToggleClass('IconChevronUp').ToggleClass('IconChevronDown'); $('FooterLinks').ToggleOpenVertical();"><i id="CollapseFooterButton" class="IconChevronUp"></i></button>
				</div>
				<grid-layout auto id="FooterLinks">
					<layout-row>
						<layout-cell class="Align Center" spans="4">
							<ul class="Unstyled">
								<li><a href="{$WEB_ROOT_RELATIVE}Manual/">Developer&apos;s Manual</a></li>
								<li><a href="{$WEB_ROOT_RELATIVE}Api-Reference">Wafl and DblEj Class Reference</a></li>
							</ul>
						</layout-cell>
						<layout-cell class="Align Center" spans="4">
							<ul class="Unstyled">
								<li><a href="{$WEB_ROOT_RELATIVE}Support/Feedback">Provide Feedback</a></li>
								<li><a href="{$WEB_ROOT_RELATIVE}Support/BugReport">Report a Bug</a></li>
								<li><a href="{$WEB_ROOT_RELATIVE}Resources/Downloads/">Download Center</a></li>
							</ul>
						</layout-cell>
						<layout-cell class="Align Center" spans="4">
							<ul class="Unstyled">
								<li><a href="{$WEB_ROOT_RELATIVE}Resources/Blog/">ActiveWAFL Blog</a></li>
								<li><a href="http://dblej.com">DblEj Website</a></li>
							</ul>
						</layout-cell>
					</layout-row>
				</grid-layout>
				<div style="text-align: center;">
					<div>
						<a href="{$WEB_ROOT_RELATIVE}License">
							<small>ActiveWAFL is released under the Revised BSD License</small>
						</a>
					</div>
					<small>&copy; 2008 - 2016 wafl.org</small>
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
            <script type="text/javascript">
                {if isset($CURRENT_SITEPAGE)}
                {foreach $CURRENT_SITEPAGE->Get_JavascriptIncludesLib() as $JAVASCRIPT}
                DblEj.SiteStructure.SitePage.SetFileIncluded("{$JAVASCRIPT}");
                {/foreach}
                {/if}
                {nominify}document.CurrentUserDisplayName = "{if isset($CURRENT_USER) && $CURRENT_USER}{$CURRENT_USER->Get_Username()}{else}No User{/if}";{/nominify}
                DblEj.StartApp();
            </script>
        {/nocache}
	</body>
{/block}