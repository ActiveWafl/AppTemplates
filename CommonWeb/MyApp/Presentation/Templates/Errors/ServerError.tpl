{extends file="Master/MainLayout.tpl"}
{block name="PAGE_CONTENT"}
    <div class="Layout Grid">
        <div class="Row">
            <div class="Spans12">
                {nocache}{$ERROR_DETAILS}{/nocache}
            </div>
        </div>
    </div>
{/block}