{extends file='parent:frontend/account/sidebar.tpl'}

{* Your own sidebar link *}
{* append - after block *}
{* prepend - before block *}
{block name="frontend_account_menu_link_overview" append}
    <li class="navigation--entry">
        <a href="{url controller='index'}" >
            {s name="MyLinkName"}My own menu item going after `Overview`{/s}
        </a>
    </li>
{/block}

{* Link to the user downloads *}
{block name="frontend_account_menu_link_downloads"}
    <li class="navigation--entry">
        <a href="#" >
            {s name="MyLinkName"}There was downloads, but we replace it{/s}
        </a>
    </li>
{/block}