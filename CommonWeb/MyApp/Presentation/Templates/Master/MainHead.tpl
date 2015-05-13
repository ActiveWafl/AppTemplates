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
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <link rel="shortcut icon" type="image/x-icon" href="/Resources/Images/favicon.ico">

        {nocache}
        {display_condition isset($SKIN) && $SKIN->Get_MainFont() && $SKIN->Get_MainFont()->GetStylesheetUrl()}
            <link rel="stylesheet" type="text/css" href="{$SKIN->Get_MainFont()->GetStylesheetUrl()}">
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
        {/nocache}

        <link id="SitewideControls-Stylesheet" rel="stylesheet" type="text/css" href="{$WEB_ROOT_RELATIVE}SitewideControls.css" />
        <link id="WaflGlobal-Stylesheet" rel="stylesheet" type="text/css" href="{$WEB_ROOT_RELATIVE}Wafl.css" />
        {nocache}
        {if $CURRENT_SITEPAGE->HasControlCss()}
            <link id="SitepageControls-Stylesheet" rel="stylesheet" type="text/css" href="{$WEB_ROOT_RELATIVE}{$CURRENT_SITEPAGE->GetClientLogicFile()|replace:".js":"-Controls.css"}" />
        {/if}
        {/nocache}

        <script type="text/javascript" src="{$WEB_ROOT_RELATIVE}DblEj.js"></script>
        <script type="text/javascript" src="{$WEB_ROOT_RELATIVE}Wafl.js"></script>
        <script type="text/javascript" src="{$WEB_ROOT_RELATIVE}SitewideControls.js"></script>
        <script type="text/javascript" src="{$WEB_ROOT_RELATIVE}WaflAppConfig.js"></script>

        {nocache}
        {if $CURRENT_SITEPAGE->DoesClientLogicExist($APP)}
            <script type="text/javascript" src="{$WEB_ROOT_RELATIVE}{$CURRENT_SITEPAGE->GetClientLogicFile()}"></script>
        {/if}
        {if $CURRENT_SITEPAGE->HasClientControlObjects()}
            <script type="text/javascript" src="{$WEB_ROOT_RELATIVE}{$CURRENT_SITEPAGE->GetClientLogicFile()|replace:".js":"-Controls.js"}"></script>
        {/if}
        {if isset($ADDITIONAL_RAW_HEAD_HTML)}{$ADDITIONAL_RAW_HEAD_HTML}{/if}
        {block "APPEND_HEAD"}{/block}
        {/nocache}
</head>
{/block}