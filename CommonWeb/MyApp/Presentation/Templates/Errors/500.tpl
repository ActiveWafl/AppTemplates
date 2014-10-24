{extends file="Master/MainLayout.tpl"}
{block name="PAGE_CONTENT"}
    {nocache}
    <div class="Layout Grid">
        <div class="Row">
            <div class="Spans12">
                <h1>Error 500</h1>
                {$ERROR_MESSAGE}
            </div>
        </div>
    </div>
    {/nocache}
{/block}