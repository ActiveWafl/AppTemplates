{extends file="./Html5.tpl"}
{block "HTML_HEAD"}
    <head>
        {if isset($PAGE)}
            <title>{block "HTML_HEAD_PAGE_AREA"}{$SITE_DISPLAY_TITLE}{/block} - {block "HTML_HEAD_PAGE_NAME"}{$PAGE->Get_FullTitle()}{/block}</title>
        {else}
            <title>{block "HTML_HEAD_PAGE_AREA"}{$SITE_DISPLAY_TITLE}{/block}</title>
        {/if}
        <meta name="description" content="{block name="PAGE_DESCRIPTION"}{$PAGE->Get_FullTitle()}{/block}">
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <link rel="shortcut icon" type="image/x-icon" href="/Resources/Images/favicon.ico">
        {display_condition isset($SKIN)}
            {display_condition $SKIN->Get_MainFont() && $SKIN->Get_MainFont()->Get_Provider() && $SKIN->Get_MainFont()->Get_Provider()->Get_StylesheetBaseUrl()}
            <link rel="stylesheet" type="text/css" href="{$SKIN->Get_MainFont()->GetStylesheetUrl()}">
            {/display_condition}
            {display_condition $SKIN->Get_HeadingFont() && $SKIN->Get_HeadingFont()->Get_Provider() && $SKIN->Get_HeadingFont()->Get_Provider()->Get_StylesheetBaseUrl()}
            <link rel="stylesheet" type="text/css" href="{$SKIN->Get_HeadingFont()->GetStylesheetUrl()}">
            {/display_condition}
            {display_condition $SKIN->Get_SubFont() && $SKIN->Get_SubFont()->Get_Provider() && $SKIN->Get_SubFont()->Get_Provider()->Get_StylesheetBaseUrl()}
            <link rel="stylesheet" type="text/css" href="{$SKIN->Get_SubFont()->GetStylesheetUrl()}">
            {/display_condition}
        {/display_condition}
        {foreach $STYLESHEETS as $SHEETOBJECT}
            {if $SHEETOBJECT->Get_SkinName() == ""}
                <link id="{$SHEETOBJECT->GetUniqueId()}-Stylesheet" rel="stylesheet" type="text/css" href="{$SHEETOBJECT->Get_Filename()}" />
            {elseif $CURRENT_SKIN_TITLE == $SHEETOBJECT->Get_SkinName()}
                <link id="{$SHEETOBJECT->GetUniqueId()}-Stylesheet" rel="stylesheet" title="{$SHEETOBJECT->Get_SkinName()}" type="text/css" href="{$SHEETOBJECT->Get_Filename()}?WaflSkin={$SHEETOBJECT->Get_SkinName()}" />
            {else}
                <link id="{$SHEETOBJECT->GetUniqueId()}-Stylesheet" rel="alternate stylesheet" title="{$SHEETOBJECT->Get_SkinName()}" type="text/css" href="{$SHEETOBJECT->Get_Filename()}?WaflSkin={$SHEETOBJECT->Get_SkinName()}" />
            {/if}
        {/foreach}

        <link id="SitewideControls-Stylesheet" rel="stylesheet" type="text/css" href="{$WEB_ROOT_RELATIVE}SitewideControls.css" />
        <link id="WaflGlobal-Stylesheet" rel="stylesheet" type="text/css" href="{$WEB_ROOT_RELATIVE}Wafl.css" />
        {nocache}
        <script type="text/javascript" src="{$WEB_ROOT_RELATIVE}Wafl/DblEj/{$CURRENT_SITEPAGE->GetClientLogicFile()}"></script>
        <script type="text/javascript" src="{$WEB_ROOT_RELATIVE}Wafl.js"></script>
        <script type="text/javascript" src="{$WEB_ROOT_RELATIVE}SitewideControls.js"></script>
        <script type="text/javascript" src="{$WEB_ROOT_RELATIVE}WaflAppConfig.js"></script>
        {if $CURRENT_SITEPAGE->DoesClientControllerExist($APP)}
        <script type="text/javascript" src="{$WEB_ROOT_RELATIVE}{$CURRENT_SITEPAGE->GetClientLogicFile()}.js"></script>
        {/if}
        <script type="text/javascript">
            {foreach $CURRENT_SITEPAGE->Get_JavascriptIncludesLib() as $JAVASCRIPT}
            DblEj.SiteStructure.SitePage.SetFileIncluded("{$JAVASCRIPT}");
            {/foreach}
        </script>
        {if isset($ADDITIONAL_RAW_HEAD_HTML)}{$ADDITIONAL_RAW_HEAD_HTML}{/if}
        {/nocache}

    {nominify}
    <script type="text/javascript">
        {nocache}document.CurrentUserDisplayName = "{if isset($CURRENT_USER) && $CURRENT_USER}{$CURRENT_USER->Get_Username()}{else}No User{/if}";{/nocache}
    </script>
    {/nominify}
</head>
{/block}