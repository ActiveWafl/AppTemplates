{extends file="./LayoutBase.tpl"}
{block "HTML_BODY_HEADER"}
    {nocache}
    {if isset($MASQUERADE)}
        {if $MASQUERADE == 1}
        <div class="Alert Warning">
            <b><i class="IconWarningSign"></i> Masquerade Mode</b> - You are currently using the site as the user <i>{$CURRENT_USER->Get_DisplayName()}</i>.
            <div style="float: right;">
                <a href="/?MasqueradeUserId=end"><i class="IconRemove"></i> Exit Masquerade Mode</a>
            </div>
        </div>
        {elseif $MASQUERADE == 2}
            <script type="text/javascript">
                Start(
                    function()
                    {
                        if (IsDefined(window.opener))
                        {
                            window.opener.focus();
                        }
                        window.Close();
                    })
            </script>
        {/if}
    {/if}
    <div class="Auto Grid Layout">
        {include file="Parts/MainHeaderBar.tpl" nocache}
        {include file="Parts/MainSubHeaderBar.tpl" nocache}
    </div>
    {/nocache}
{/block}
{block "HTML_BODY_CONTENTS"}
    <div id="MainLayoutPageContents">
        {nocache}
            {if count($GLOBAL_ERRORS)>0}
                {include file="Parts/GeneralErrors.tpl"}
            {/if}
            {include file="Parts/GeneralInfo.tpl"}
        {/nocache}
        {block name="PAGE_CONTENT"}Page Contents Go Here{/block}
    </div>
{/block}
{block "HTML_BODY_POSTCONTENT"}

{if !$DEBUG_MODE}
    {literal}
    <!--Start of Zopim Live Chat Script-->
    <!-- script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
    $.src='//v2.zopim.com/?2a1PFk9xmQqdwoSbmEax5pMk8YpnD4ZN';$.setAttribute('rel','nofollow'); z.t=+new Date;$.
    type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');

    $zopim(function() {
      $zopim.livechat.setEmail('{/literal}{nocache}{$CURRENT_USER->Get_EmailAddress()}{/nocache}{literal}');
    });
    </script>
    <!--End of Zopim Live Chat Script-->
    {/literal}
{/if}
{/block}