<?php

use Wafl\Routers\Api,
    Wafl\Routers\ApplicationGlobal,
    Wafl\Routers\Webpage,
    Wafl\Routers\ControlResource,
    Wafl\Routers\Extensions,
    Wafl\Routers\PageIncludes,
    Wafl\Routers\SitewideControls,
    Wafl\Routers\WaflIncludes,
    Wafl\Routers\Fonts,
    Wafl\Util\HttpRouter;

HttpRouter::AddRouter(new WaflIncludes());
HttpRouter::AddRouter(new SitewideControls());
HttpRouter::AddRouter(new SitepageControls());
HttpRouter::AddRouter(new Controls());
HttpRouter::AddRouter(new ApplicationGlobal());
HttpRouter::AddRouter(new ControlResource());
HttpRouter::AddRouter(new Extensions());
HttpRouter::AddRouter(new Webpage());
HttpRouter::AddRouter(new Models());
HttpRouter::AddRouter(new PageIncludes());
HttpRouter::AddRouter(new Fonts());
HttpRouter::AddRouter(new Api());
?>