<?php

use Wafl\Routers\Api,
    Wafl\Routers\ApplicationGlobal,
    Wafl\Routers\Controller,
    Wafl\Routers\ControlResource,
    Wafl\Routers\Extensions,
    Wafl\Routers\Models,
    Wafl\Routers\PageIncludes,
    Wafl\Routers\SitewideControls,
    Wafl\Routers\SitepageControls,
    Wafl\Routers\Controls,
    Wafl\Routers\WaflIncludes,
    Wafl\Util\HttpRouter;

HttpRouter::AddRouter(new WaflIncludes());
HttpRouter::AddRouter(new SitewideControls());
HttpRouter::AddRouter(new SitepageControls());
HttpRouter::AddRouter(new Controls());
HttpRouter::AddRouter(new ApplicationGlobal());
HttpRouter::AddRouter(new ControlResource());
HttpRouter::AddRouter(new Extensions());
HttpRouter::AddRouter(new Controller());
HttpRouter::AddRouter(new Models());
HttpRouter::AddRouter(new PageIncludes());
HttpRouter::AddRouter(new Wafl\Routers\Fonts());
HttpRouter::AddRouter(new Api());
HttpRouter::AddRouter(new \{APPLICATION_NAMESPACE}\Routers\ExampleInternalRouter());
HttpRouter::AddUrlRewriter(new \{APPLICATION_NAMESPACE}\Routers\ExampleUrlRewriter());