<div id="{$PARAMS.Id}" style="{if isset($WIDTH)}width: {$WIDTH}px; {/if}" class="{CONTROL_NAME}">
    {if isset($PARAMS.SomeParam1)}Some parameter 1: {$PARAMS.SomeParam1}{/if} 
    {if isset($PARAMS.SomeParam2)}Some parameter 2: {$PARAMS.SomeParam2}{/if} 
</div>
<script type="text/javascript">
    Start
        (
            function()
            {
                $("{$PARAMS.Id}").{CONTROL_NAME} = new {CONTROLS_NAMESPACE_JS}.{CONTROL_NAME}.{CONTROL_NAME}($("SomeInput1")
                    .Get_Value(), $("SomeInput2")
                    .Get_Value());
            }
        );
</script>