{extends file="parent:frontend/detail/index.tpl"}

{* Instead of tabs now we will see description tab content *}
{block name="frontend_detail_index_detail"}
    {include file="frontend/detail/tabs/description.tpl"}
{/block}

{* Crossselling tab panel - removed *}
{block name="frontend_detail_index_tabs_cross_selling"}{/block}