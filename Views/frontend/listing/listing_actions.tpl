{extends file="parent:frontend/listing/listing_actions.tpl"}

{* Order by selection removed *}
{block name='frontend_listing_actions_sort'}{/block}

{* Listing pagination removed *}
{block name='frontend_listing_actions_paging'}{/block}

{* Filter options was there, but now some message *}
{block name="frontend_listing_actions_filter_options"}
    <div class="block filter--category">{s name="listingOptions"}THis our custom link to this category! <a href="{url controller='cat' sPage=1 sCategory=$sCategoryContent.id}">{$sCategoryContent.description|escape}</a>{/s}</div>
{/block}