{extends file="./Html5.tpl"}
{block "HTML_HEAD"}
    <head>
        {nocache}
        {if isset($PAGE)}
            <title>{block name="PAGE_TITLE"}{$PAGE->Get_FullTitle()} - {$SITE_DISPLAY_TITLE}{/block}</title>
            <meta name="description" content="{block name="PAGE_DESCRIPTION"}{$PAGE->Get_FullTitle()}{/block}">
        {else}
            <title>{block name="PAGE_TITLE"}{$SITE_DISPLAY_TITLE}{/block}</title>
        {/if}
        {/nocache}
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <link rel="shortcut icon" type="image/x-icon" href="/Resources/Images/favicon.ico">

        {nocache}
        {display_condition isset($SKIN) && $SKIN->Get_MainFont() && $SKIN->Get_MainFont()->GetStylesheetUrl()}
            <link rel="stylesheet" type="text/css" href="/{$SKIN->Get_MainFont()->GetStylesheetUrl()}">
        {/display_condition}
        {display_condition isset($SKIN) && $SKIN->Get_HeadingFont() && $SKIN->Get_HeadingFont()->GetStylesheetUrl()}
            <link rel="stylesheet" type="text/css" href="/{$SKIN->Get_HeadingFont()->GetStylesheetUrl()}">
        {/display_condition}
        {display_condition isset($SKIN) && $SKIN->Get_SubFont() && $SKIN->Get_SubFont()->GetStylesheetUrl()}
            <link rel="stylesheet" type="text/css" href="/{$SKIN->Get_SubFont()->GetStylesheetUrl()}">
        {/display_condition}
        {display_condition isset($SKIN) && $SKIN->Get_AccentFont() && $SKIN->Get_AccentFont()->GetStylesheetUrl()}
            <link rel="stylesheet" type="text/css" href="/{$SKIN->Get_AccentFont()->GetStylesheetUrl()}">
        {/display_condition}
        {foreach $STYLESHEETS as $SHEETOBJECT}
            {if $SHEETOBJECT->Get_SkinName() == ""}
                <link id="{$SHEETOBJECT->GetUniqueId()}-Stylesheet" rel="stylesheet" type="text/css" href="{$SHEETOBJECT->Get_Filename()}" />
            {elseif $CURRENT_SKIN_TITLE == $SHEETOBJECT->Get_SkinName()}
                <link id="{$SHEETOBJECT->GetUniqueId()}-Stylesheet" rel="stylesheet" title="{$SHEETOBJECT->Get_SkinName()}" type="text/css" href="{$SHEETOBJECT->Get_Filename()}?WaflSkin={$SHEETOBJECT->Get_SkinName()}&amp;rev={$APP_VERSION}" />
            {else}
                <link id="{$SHEETOBJECT->GetUniqueId()}-Stylesheet" rel="alternate stylesheet" title="{$SHEETOBJECT->Get_SkinName()}" type="text/css" href="{$SHEETOBJECT->Get_Filename()}?WaflSkin={$SHEETOBJECT->Get_SkinName()}&amp;rev={$APP_VERSION}" />
            {/if}
        {/foreach}
        <link id="WaflGlobal-Stylesheet" rel="stylesheet" type="text/css" href="/Wafl.css" />
        {if isset($CURRENT_SITEPAGE) && $CURRENT_SITEPAGE->HasControlCss()}
            <link id="SitepageControls-Stylesheet" rel="stylesheet" type="text/css" href="{$CURRENT_SITEPAGE->GetClientLogicFile()|replace:".js":"-Controls.css"}" />
        {/if}
        <script type="text/javascript" src="/DblEj.js"></script>
        <script type="text/javascript" src="/Wafl.js"></script>
        <script type="text/javascript" src="/WaflAppConfig.js"></script>
        {if isset($ADDITIONAL_RAW_HEAD_HTML)}{$ADDITIONAL_RAW_HEAD_HTML}{/if}
        {block "APPEND_HEAD"}{/block}
        {/nocache}
</head>
{/block}