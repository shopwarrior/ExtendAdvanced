<?php
class Shopware_Plugins_Frontend_ExtendAdvanced_Bootstrap extends Shopware_Components_Plugin_Bootstrap {
    /**
     * Helper for cache array
     * @return array
     */
    private function getInvalidateCacheArray()
    {
        return array('config', 'template', 'theme');
    }

    /**
     * Helper for availability capabilities
     * @return array
     */
    public function getCapabilities(){
        return array(
            'install' => true,
            'update' => true,
            'enable' => true,
            'secureUninstall' => true
        );
    }

    /**
     * Returns the version of plugin as string.
     *
     * @return string
     */
    public function getVersion() {
        return '0.0.1';
    }

    /**
     * Returns the plugin name for backend
     *
     * @return string
     */
    public function getLabel() {
        return 'Extend Advanced Example';
    }

    /**
     * Returns the meta information about the plugin.
     *
     * @return array
     */
    public function getInfo()
    {
        return array(
            'version' => $this->getVersion(),
            'author' => 'Best Shopware Newbie',
            'supplier' => 'Best Shopware Newbie',
            'label' => $this->getLabel(),
            'copyright' => 'Copyright &copy; '.date('Y').', Best Shopware Newbie',
            'support' => 'info@BestShopwareNewbie',
            'link' => 'http://BestShopwareNewbie/'
        );
    }

    /**
     * Standard plugin install method to register all required components.
     * @return array
     */
    public function install() {
        $this->subscribeEvents()
            ->createControllers()
            ->createConfig();

        return array(
            'success' => true,
            'message' => 'Plugin was successfully installed',
            'invalidateCache' => $this->getInvalidateCacheArray()
        );
    }

    /**
     * @param Enlight_Controller_ActionEventArgs $arguments
     */
    public function onPostDispatchCheckout(Enlight_Controller_ActionEventArgs $arguments){
        /**@var $controller Shopware_Controllers_Frontend_Checkout */
        $controller = $arguments->getSubject();
        $request  = $controller->Request();
        $response = $controller->Response();
        $action = $request->getActionName();
        $view = $controller->View();

//      Extend only ajaxCart Action, all other actions - don't do anything
        if (  $action !== 'ajaxCart' || !$request->isDispatched()
            || $response->isException() || !$view->hasTemplate()
        ) {
            return;
        }

        $view->addTemplateDir($this->Path() . 'Views/');
    }

    /**
     * @param Enlight_Controller_ActionEventArgs $arguments
     */
    public function onPostDispatchAccount(Enlight_Controller_ActionEventArgs $arguments){
        /**@var $controller Shopware_Controllers_Frontend_Checkout */
        $controller = $arguments->getSubject();
        $view = $controller->View();

//      There we will add menu item to our account sidebar manu
        $view->addTemplateDir($this->Path() . 'Views/');
    }

    /**
     * @param Enlight_Controller_ActionEventArgs $arguments
     */
    public function onPostDispatchDetail(Enlight_Controller_ActionEventArgs $arguments){
        /**@var $controller Shopware_Controllers_Frontend_Checkout */
        $controller = $arguments->getSubject();
        $view = $controller->View();

//      Delete crosselling slider, show description instead tabs view
        $view->addTemplateDir($this->Path() . 'Views/');
    }

    /**
     * @param Enlight_Controller_ActionEventArgs $arguments
     */
    public function onPostDispatchIndex(Enlight_Controller_ActionEventArgs $arguments){
        /**@var $controller Shopware_Controllers_Frontend_Checkout */
        $controller = $arguments->getSubject();
        $view = $controller->View();

//      There we will add menu item to our account sidebar manu
        $view->addTemplateDir($this->Path() . 'Views/');
    }

    /**
     * @param Enlight_Controller_ActionEventArgs $arguments
     */
    public function onPostDispatchListing(Enlight_Controller_ActionEventArgs $arguments){
        /**@var $controller Shopware_Controllers_Frontend_Checkout */
        $controller = $arguments->getSubject();
        $view = $controller->View();

//      Remove order and pagination, replace filters options to message
        $view->addTemplateDir($this->Path() . 'Views/');
    }

    /**
     * @param Enlight_Controller_ActionEventArgs $arguments
     */
    public function onPostDispatchFrontend(Enlight_Controller_ActionEventArgs $arguments){
        /**@var $controller Shopware_Controllers_Frontend_Checkout */
        $controller = $arguments->getSubject();
        $request  = $controller->Request();
        $response = $controller->Response();
        $actionName = $request->getActionName();
        $controllerName = $request->getControllerName();
        $view = $controller->View();

        if (  ($actionName !== 'someActionName' && $controllerName!=='someControllerName') || 
            !$request->isDispatched() || $response->isException() || !$view->hasTemplate()
        ) {
//            Do something
        }        
    }

    /**
     * @return Shopware_Plugins_Frontend_ExtendAdvanced_Bootstrap
     */
    private function subscribeEvents(){
//      Frontend_Checkout -> Frontend/Backend, Checkout mean controller checkout
        $this->subscribeEvent( 'Enlight_Controller_Action_PostDispatch_Frontend_Checkout', 'onPostDispatchCheckout' );
//      Controller Account
        $this->subscribeEvent( 'Enlight_Controller_Action_PostDispatch_Frontend_Account', 'onPostDispatchAccount' );
//      Controller Detail(product info)
        $this->subscribeEvent( 'Enlight_Controller_Action_PostDispatch_Frontend_Detail', 'onPostDispatchDetail' );
//      Controller Index
        $this->subscribeEvent( 'Enlight_Controller_Action_PostDispatch_Frontend_Index', 'onPostDispatchIndex');
//      Controller Listing(category)
        $this->subscribeEvent( 'Enlight_Controller_Action_PostDispatch_Frontend_Listing', 'onPostDispatchListing' );
//      Extend all frontend controllers
        $this->subscribeEvent( 'Enlight_Controller_Action_PostDispatch_Frontend', 'onPostDispatchFrontend' );

        return $this;
    }

    /**
     * @return Shopware_Plugins_Frontend_ExtendAdvanced_Bootstrap
     */
    private function createControllers(){
//        There we register our own controller
        $this->registerController('Frontend', 'Example');

        return $this;
    }

    /**
     * @return Shopware_Plugins_Frontend_ExtendAdvanced_Bootstrap
     */
    private function createConfig(){
        $this->Form()->setElement('checkbox', 'var1', array(
            'value' => true,
            'label' => 'Yes/No?',
            'scope' => Shopware\Models\Config\Element::SCOPE_SHOP
        ));

        $preDefinedCountry = 0;
        $store = array();

        $countries = \Shopware()->Db()->fetchAll("
            SELECT `id`, `countryname`
            FROM `s_core_countries`
            WHERE `countryname` IS NOT NULL
            ORDER BY `position` ASC");
        foreach($countries as $country){
            if(!$preDefinedCountry) $preDefinedCountry = $country['id'];
            $store[] = array(
                $country['id'], $country['countryname']
            );
        }
        $this->Form()->setElement('select', 'country', array(
            'label' => 'Country',
            'store' =>  $store,
            'value' =>  $preDefinedCountry,
            'scope' => \Shopware\Models\Config\Element::SCOPE_SHOP,
            'description' => 'Just example, select country'
        ));

        $store = $preDefinedGroups = array();
        $groups = \Shopware()->Db()->fetchAll("SELECT `groupkey`, `description`
        FROM s_core_customergroups
        ORDER BY `groupkey` ASC");
        foreach($groups as $group){
            $preDefinedGroups[] = $group['groupkey'];
            $store[] = array(
                $group['groupkey'], $group['description']
            );
        }
        $this->Form()->setElement('select', 'groups', array(
            'label' => 'Customer Group',
            'store' =>  $store,
            'value' =>  $preDefinedGroups,
//            Multiselect - can select many items in dropdown
            'multiSelect' => true,
//            Scope not set - same config data for all subshops
//            'scope' => \Shopware\Models\Config\Element::SCOPE_SHOP,
            'des
            cription' => 'Just example, select customer groups'
        ));

        $this->Form()->setElement(
            'select',
            'some',
            array(
                'label' =>  'Dont know..',
                'store' =>  array(
                    array(true, 'Maybe'),
                    array(false, 'Not sure'),
                ),
                'value' =>  true,
                'scope' =>  \Shopware\Models\Config\Element::SCOPE_SHOP,
                'description'   =>  'Should?'
            )
        );

        return $this;
    }
}