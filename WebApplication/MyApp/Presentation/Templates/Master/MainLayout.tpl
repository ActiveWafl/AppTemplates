{extends file="./MainHead.tpl"}
{block "HTML_BODY"}
    <!DOCTYPE html>
    <body>
        <header class="Top Dock">
            <div class="Auto Layout Grid">
                <div class="Row">
                    <div class="Spans1">
                        <img src="{$WEB_ROOT_RELATIVE}Resources/Images/WaflIcon_Small.png" />
                    </div>
                    <div class="Spans10">
                        <hgroup>
                            <h1>{$SITE_DISPLAY_TITLE}</h1>
                            <h5>You have successfully setup your new Web Application</h5>
                        </hgroup>
                    </div>					 
                </div>
            </div>
        </header>
    <main id="MainLayoutPageContents">
        {nocache}
            {if count($GLOBAL_ERRORS)>0}
                {include file="Parts/GeneralErrors.tpl"}
            {/if}
            {include file="Parts/GeneralInfo.tpl"}
        {/nocache}
        {block name="PAGE_CONTENT"}Page Contents Go Here{/block}
    </main>
    <footer class="Bottom Dock">
        <div class="Auto Layout Grid">
            <div class="Row">
                <div class="Spans12 Align Center">
                    (c) 2013 Acme Inc.
                </div>
            </div>
        </div>
    </footer>

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