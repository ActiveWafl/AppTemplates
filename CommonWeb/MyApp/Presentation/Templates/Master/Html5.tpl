<!DOCTYPE html>
<html>
    {block "HTML_HEAD"}
        <head></head>
    {/block}
    {block "HTML_BODY"}
        <body>To populate this page you'll need to add a block named HTML_BODY</body>
    {/block}

    {nocache}
    {if $CURRENT_SITEPAGE->DoesClientControllerExist($APP)}
        <script async type="text/javascript" src="{$WEB_ROOT_RELATIVE}{$CURRENT_SITEPAGE->Get_ControllerPath()}.js"></script>
    {/if}

    <script type="text/javascript">
        {foreach $CURRENT_SITEPAGE->Get_JavascriptIncludesLib() as $JAVASCRIPT}
        DblEj.SiteStructure.SitePage.SetFileIncluded("{$JAVASCRIPT}");
        {/foreach}
        {nominify}document.CurrentUserDisplayName = "{if isset($CURRENT_USER) && $CURRENT_USER}{$CURRENT_USER->Get_Username()}{else}No User{/if}";{/nominify}
    </script>
    {/nocache}


    {nominify}
    <script type="text/javascript">
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-50962011-1', 'plazko.com');
        ga('send', 'pageview');
    </script>

    {if $DEBUG_MODE}
    <script async type="text/javascript" src="https://plazko.atlassian.net/s/930e7cc9545e7c5422c2bda89cb96679-T/en_USujl9gy/64001/11/1.4.15/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=a7af1d24"></script>
    {/if}
    {/nominify}


</html>