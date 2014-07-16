{extends file="Master/MainLayout.tpl"}
{block name="PAGE_CONTENT"}
    <article>
        <div class="Panel Dock Left">
            <ul id="PageMenu" class="Menu">
                <li><a href="#InstallComplete" id="MenuInstallComplete">Finished Install</a>
                <li><a href="#WhatsNext" id="MenuWhatsNext">What&apos;s Next</a>
                <li><a href="#Html" id="MenuHtml">HTML</a>
                <li><a href="#SiteStructure" id="MenuSiteStructure">Site Structure</a>
                <li><a href="#Database" id="MenuDatabase">Database</a>
                <li><a href="#DataModels" id="MenuDataModels">Data Models</a>
                <li><a href="#Logic" id="MenuLogic">Business Logic</a>
                <li><a href="#LearnMore" id="MenuLearnMore">Learn More</a>
                <li><a href="#Notes" id="MenuNotes">Notes</a>
                <li><a href="#Support" id="MenuSupport">Support</a>
            </ul>			
        </div>
        <div class="Auto Layout Grid">
            <div class="Row">
                <div class="Spans9">

                    <section class="Notification Success">
                        <h1>Congratulations!</h1><a href="#InstallComplete" id="InstallComplete" class="NavJump"></a>
                        <p>
                            Your application is installed at <b>{$LOCAL_ROOT}</b>.
                        </p>
                        <section>
                            <h3>Some important directories</h3>
                            <dl>
                                <dt>App config file</dt>
                                <dd>{$APP_CONFIG_FILE}</dd>

                                <dt>Environment config file</dt>
                                <dd>{$ENV_CONFIG_FILE}</dd>
                                <dt>Public Web Folder
                                <dd>{$LOCAL_WEB_ROOT}

                                <dt>ActiveWAFL Folder
                                <dd>{$LOCAL_WAFL_FOLDER}

                                <dt>DblEj Folder
                                <dd>{$LOCAL_DBLEJ_FOLDER}
                            </dl>
                        </section>
                    </section>

                    <section class="Panel">
                        <h1>What&apos;s Next?</h1><a href="#WhatsNext" id="WhatsNext" class="NavJump"></a>
                        <p>
                            In order to run the new application, ActiveWAFL needs to know what environment (dev, test, stage, prod, etc.) it is running on.&emsp;
                            You can specify the ActiveWAFL environment by setting the <a href="http://www.activewafl.com/GettingStarted/Installation#Environment">WAFL_ENVIRONMENT environment variable</a>.
                        </p>
                        <br>
                        <aside class="Notification">
                            <p><i class="IconInfoSign"></i> If PHP is running under the Apache Web server (or any web server that supports .htaccess), you can set the environment in an .htaccess file in the public web documents folder as in the following example.</p>
                            {highlightcode Language="Apache" LineNumbers=false Heading="The SetEnv directive can be used to set the WAFL_ENVIRONMENT environment variable."}
                            {literal}
                                AddType application/x-httpd-php .php .phar
                                SetEnv WAFL_ENVIRONMENT dev
                                RewriteEngine On
                                RewriteCond %{REQUEST_FILENAME} -s [OR]
                                RewriteCond %{REQUEST_FILENAME} -l [OR]
                                RewriteCond %{REQUEST_FILENAME} -d
                                RewriteRule ^.*$ - [NC,L]
                                RewriteRule ^.*$ index.php [NC,L]
                            {/literal}
                            {/highlightcode}

                            <p>You can also set the environment inside of any apache config DIRECTORY directive, including inside of httpd.conf and any included Apache configs such as a virtual host configuration file.</p>

                        </aside>
                        <aside class="Notification">
                            <h3>Single-environment deployments</h3> 
                            <p><i class="IconInfoSign"></i> If you have a machine dedicated to a single application instance, you can set the environment variable globally for the web server (or its parent service / daemon) user or machine-wide for all users.&emsp;
                                This can be done using the tools provided by the OS.&emsp;
                                <a href="http://www.activewafl.com/GettingStarted/Installation#Environment">More details can be found here</a>.</p>
                        </aside>
                        <aside class="Notification Warning">
                            <h3>URL Rewrites on non-Apache Web Servers</h3>
                            <p><i class="IconInfoSign"></i> ActiveWAFL applications come with a standard .htaccess file that sets the rewrite rules necessary to route incoming requests properly.</p>
                            <p>If you're using a Web server that does not support .htaccess, then you must use some other mechanism to router incoming requests.
                                <br>
                                All incoming requests should be routed to <b>./Public/index.php</b>.
                            </p>
                        </aside>

                        <p>If you have not already done so, double-check that all of the <a href="http://www.activewafl.com/GettingStarted/Configuration#AppConfigure">application settings</a> in [Installation Folder]<mark>/Config/Application.syrp</mark> and [Installation Folder]<mark>/Config/Settings.[environment].syrp</mark> are set to the correct values.&emsp;
                            Some of those values are listed in the side-bar on this page.

                    </section>

                    <section class="Panel">
                        <h1>Edit this Page&apos;s Content</h1><a id="Html" href="#Html" class="NavJump"></a>
                        <p>The HTML for this page is at ./<mark>MyApp/Presentation/Templates/LandingPage.tpl</mark>.&emsp;
                            <br>Making changes to this file will update the contents you see here on this page.

                    </section>

                    <section class="Panel">
                        <h1>Setup the Site Structure</h1><a id="SiteStructure" href="#SiteStructure" class="NavJump"></a>
                        <p>Edit the ./<mark>Config/SiteStructure.syrp</mark> file to make changes to the <a href="http://www.activewafl.com/GettingStarted/SiteStructure">site structure</a>.&emsp;

                    </section>

                    <section class="Panel">
                        <h1>Connect to a database</h1><a id="Database" href="#Database" class="NavJump"></a>
                        <p>Database settings are set on a per-environment basis.&emsp;
                            Environment settings can be found in the ./<mark>Config/Settings.[environment].syrp</mark> files.&emsp;

                    </section>

                    <section class="Panel">
                        <h1>Create the data models</h1><a id="DataModels" href="#DataModels" class="NavJump"></a>
                        <p>Create data models for your database automatically using the script ./<mark>MyApp/Bin/UpdateDataModels</mark>.
                        <aside class="Notification Info">
                            <i class="IconInfoSign"></i> Before you can generate the data models, you must
                            <ul>
                                <li>Set the application&apos;s namespace in <mark>./Application.syrp</mark>.&emsp;
                                    <br>The generated models will be a part of the specified namespace.
                                <li>Setup the database connection in <mark>./Settings.[environment].syrp</mark>.
                            </ul>							
                        </aside>

                    </section>

                    <section class="Panel">
                        <h1>Add Functionality</h1><a id="Logic" href="#Logic" class="NavJump"></a>
                        <p>Application logic for web applications is usually handled in the Functional Models or the <mark>MyApp/Controllers/[Pagename].php</mark> files.
                    </section>
                    <section class="Panel">
                        <h1>Learn More</h1><a href="#LearnMore" id="LearnMore" class="NavJump"></a>
                        <ul>
                            <li><a href="http://activewafl.com">Online Documentation</a>
                            <li><a href="http://activewafl.com/CrashCourse/">Crash Course</a>
                            <li><a href="http://activewafl.com/Blog/">Blog</a>
                            <li><a href="http://activewafl.com/ApiDocs/">API Docs</a>
                        </ul>
                    </section>					
                    <section class="Panel">
                        <h1>Notes</h1><a href="#Notes" id="Notes" class="NavJump"></a>

                        <h2>Syrup Configuration Files</h2>
                        <p>
                            ActiveWAFL uses <a href="http://syrupfile.org">Syrup files</a> to store configuration settings.
                        </p>

                        <h2>Minification</h2>
                        <p>
                            By default, everything output to the browser is automatically minified.&emsp;
                            This includes HTML, Javascript, and CSS.
                        </p>
                        <aside class="Notification Warning">
                            <i class="IconInfoSign"></i>&emsp;
                            In HTML, double-spaces will be collapsed down to nothing during minification.&emsp;
                            To use double-spaces within text content, use the &amp;emsp&semi; entity.
                        </aside>

                        <h2>Server-side Caches</h2>
                        <p>
                            By default, a static version of everything output to the browser is stored on disk.&emsp;
                            Subsequent requests to the same URL will result in the cached static data being served.&emsp;
                            If you make a change to the HTML (.tpl files) then the cache for that content will be invalidated and the output will be freshly rendered.&emsp;
                            Other ways to get a fresh render include: delete the cache file(s) from disk, programatically clear the cache file(s), marking certain content as being non-cachable on the server-side, or completely disabling server-side caching (not recommended).&emsp;
                        </p>
                        <aside class="Notification Info">
                            <i class="IconInfoSign"></i>&emsp;
                            Server-side caches are not in any way related to HTTP client (web browser) caches, HTTP proxy caches, or HTTP no-cache headers.
                        </aside>
                        <aside class="Notification Info">
                            <i class="IconInfoSign"></i>&emsp;
                            If you make changes to the application logic or you make database updates and you do not see the expected updated output, it might be that you are seeing a server-side cached version of the output.
                        </aside>
                    </section>
                    <section class="Panel">
                        <h1>Support</h1><a href="#Support" id="Support" class="NavJump"></a>
                        <p>There are a few ways to get help.</p>
                        <ul>
                            <li>Look over the <a href="http://www.activewafl.com">online documentation</a> and the <a href="http://www.activewafl.com/ApiDocs/">API docs</a>.</li>
                            <li>Ask a question (or see previously answered questions) from the <a href="http://www.activewafl.com/Answers">ActiveWAFL Answer Database</a></li>
                            <li>Report a bug or request a feature using the <a href="http://www.activewafl.com/Issues">ActiveWAFL Issue Tracker</a></li>
                        </ul>
                    </section>

                </div>
                <div class="Spans3">
                    <div class="Panel Sidebar">
                        <h1>About this application</h1>
                        <dl>
                            <dt>Site Name
                            <dd>{$SITE_DISPLAY_TITLE}

                            <dt>URL
                            <dd>{$WEB_ROOT}

                            <dt>Current environment</dt>
                            <dd>{$WAFL_ENVIRONMENT}</dd>

                            <dt>Debug Mode
                            <dd>{if $DEBUG_MODE}On{else}Off{/if}

                            <dt>Current Skin
                            <dd>{$CURRENT_SKIN_TITLE}

                            <dt>Site Email
                            <dd>{$SITE_EMAIL}
                        </dl>
                    </div>
                </div>
            </div>
        </div>

    </article>
{/block}