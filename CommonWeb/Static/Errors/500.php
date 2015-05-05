<!DOCTYPE html>
<html>
    <head>
        <title>Server Error</title>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <link rel="shortcut icon" type="image/x-icon" href="/Resources/Images/favicon.ico">
        <link id="DefaultSkin-Global-Stylesheet" rel="stylesheet" title="DefaultSkin" type="text/css" href="/Global.css?WaflSkin=DefaultSkin" />
        <link id="SitewideControls-Stylesheet" rel="stylesheet" type="text/css" href="/SitewideControls.css" />
        <link id="WaflGlobal-Stylesheet" rel="stylesheet" type="text/css" href="/Wafl.css" />
        <script type="text/javascript" src="/DblEj.js"></script>
        <script type="text/javascript" src="/Wafl.js"></script>
        <script type="text/javascript" src="/SitewideControls.js"></script>
        <script type="text/javascript" src="/WaflAppConfig.js"></script>
    </head>
    <body tabindex="-1" style="margin: 0px; padding: 0px;">
        <header>
            Server Error
        </header>
        <div class="Grid Layout">
            <div class="Row">
                <div class="Spans12">
                    <h3>
                        There was an error
                    </h3>
                    <p>
                        There appears to be an error with the requested page.  Please try again.<br>
                    </p>
                    <small>Server Error <?php print $errorCode; ?></small>
                </div>
            </div>
        </div>
    </body>
</html>
