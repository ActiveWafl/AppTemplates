{extends file="./MainHead.tpl"}
{block "HTML_BODY"}
    <body tabindex="-1">
        {nocache}
            {if count($GLOBAL_ERRORS)>0}
                {include file="Parts/GeneralErrors.tpl"}
            {/if}
            {if count($GLOBAL_INFO)>0}
                {include file="Parts/GeneralInfo.tpl"}
            {/if}
        {/nocache}		
        {block name="PAGE_CONTENT"}Page Contents Go Here{/block}
    <script type="text/javascript" src="/GlobalScript.js"></script>
    {if $APP && isset($CURRENT_SITEPAGE) && $CURRENT_SITEPAGE->DoesClientLogicExist($APP)}
        <script type="text/javascript" src="/{$CURRENT_SITEPAGE->GetClientLogicFile()}"></script>
    {/if}
    {if isset($CURRENT_SITEPAGE) && $CURRENT_SITEPAGE->HasClientControlObjects()}
        <script type="text/javascript" src="/{$CURRENT_SITEPAGE->GetClientLogicFile()|replace:".js":"-Controls.js"}"></script>
    {/if}
    {if isset($ADDITIONAL_RAW_FOOT_HTML)}{$ADDITIONAL_RAW_FOOT_HTML}{/if}

    {nocache}
    <script type="text/javascript">
        {foreach $CURRENT_SITEPAGE->Get_JavascriptIncludesLib() as $JAVASCRIPT}
        DblEj.SiteStructure.SitePage.SetFileIncluded("{$JAVASCRIPT}");
        {/foreach}
        {nominify}document.CurrentUserDisplayName = "{if isset($CURRENT_USER) && $CURRENT_USER}{$CURRENT_USER->Get_Username()}{else}No User{/if}";{/nominify}
        DblEj.StartApp();
    </script>
    {/nocache}
</body>
{/block}