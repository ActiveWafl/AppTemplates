{extends file="Master/MainLayout.tpl"}
{block name="PAGE_CONTENT"}
    <div class="Layout Grid">
        <div class="Row">
            <div class="Spans12">
                <h1>Http 404</h1>
                <p>The specified page cannot be found.</p>
                {nocache}{$ERROR_DETAILS}{/nocache}
            </div>
        </div>
    </div>
{/block}
