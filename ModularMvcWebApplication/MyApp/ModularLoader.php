<?php

namespace
{
    APPLICATION_NAMESPACE
};

use DblEj\Application\IApplication,
    DblEj\Application\IMvcWebApplication,
    DblEj\Modular\IModularLoader,
    DblEj\Modular\Module as Module,
    DblEj\Modular\ModuleCollection,
    DblEj\Modular\Screen,
    DblEj\Modular\Widget,
    DblEj\Resources\Resource,
    DblEj\Resources\ResourceCollection,
    DblEj\Resources\ResourcePermissionCollection;

class ModularLoader
implements IModularLoader
{
    private $_modules;

    /**
     * A collection of this loaders resources.
     *
     * @var DblEj\Resources\ResourceCollection
     */
    private $_resources;

    /**
     * A collection of this loaders resource permissions.
     *
     * @var DblEj\Resources\ResourcePermissionCollection
     */
    private $_resourcePermissions;

    /**
     *
     * @param IMvcWebApplication $application
     * @return Module[]
     */
    public function GetModules(IApplication $application)
    {
        $webApp = $application;

        //these can be loaded from a database or a syrup file, or whatever you'd like
        //here we hard-code for demonstration purposes.
        if (!$this->_modules)
        {
            $this->_modules = new ModuleCollection();
            $module1        = new Module("ExampleModule1", "Example Module 1");
            foreach ($application->GetAllViews() as $view)
            {
                $module1->AddScreen(new Screen($view));
            }
            foreach ($module1->GetWidgets() as $widget)
            {
                $module1->AddWidget($widget);
            }

            $this->_modules->AddModule($module1);
        }
        return $this->_modules;
    }

    public function GetResources()
    {
        if (!$this->_resources)
        {
            $this->_resources      = new ResourceCollection();
            $exampleRestrictedPage = new Resource("Restricted page", "ExamplePage", Resource::RESOURCE_TYPE_SITEPAGE);
            $this->_resources->AddResource($exampleRestrictedPage);
        }
        return $this->_resources;
    }

    /**
     * Get all resource permissions.
     *
     * @return ResourcePermissionCollection
     */
    public function GetResourcePermissions()
    {
        //give current user owner access to all resources
        if (!$this->_resourcePermissions)
        {
            $examplePrivelegedUser      = \Wafl\Core::$CURRENT_USER;
            $this->_resourcePermissions = new ResourcePermissionCollection();
            foreach ($this->GetResources() as $restrictedResource)
            {
                $this->_resourcePermissions->SetPermission($examplePrivelegedUser, $restrictedResource, \DblEj\Resources\ResourcePermission::RESOURCE_PERMISSION_DELETE);
            }
        }
        return $this->_resourcePermissions;
    }

}
?>