{extends file="Master/MainLayout.tpl"}
{block "HTML_HEAD_PAGE_AREA"}Override the Site Area{/block}
{block "HTML_HEAD_PAGE_NAME"}Override the Page Name{/block}
{block name="PAGE_CONTENT"}
    <div id="LandingPageContents" class="PageInnerContents">
        <div class="Auto Grid Layout">
            <div class="Row">
                {nocache}
                {/nocache}
            </div>
        </div>
    </div>
{/block}