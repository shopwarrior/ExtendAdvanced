<?php
/**
 * Frontend controller
 */
class Shopware_Controllers_Frontend_Example extends Enlight_Controller_Action
{

    public function indexAction()
    {
        $groupKeys = Shopware()->Plugins()->Frontend()->ExtendAdvanced()->Config()->get('groups');
        if($groupKeys instanceof \Enlight_Config)
            $groupKeys = $groupKeys->toArray();
        elseif(is_string($groupKeys)){
            $groupKeys = (trim($groupKeys) == '') ? array()  : array_map('trim',explode(',', $groupKeys));
        }

        $this->view->assign('groups', $groupKeys);
        $this->view->assign('variable', 'value');
        $this->view->assign('userId', Shopware()->Session()->sUserId);
    }
}