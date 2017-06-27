{extends file='frontend/index/index.tpl'}

{* Breadcrumb *}
{block name='frontend_index_start' append}
    {$sBreadcrumb[] = ['name'=>"Example Controller"]}
{/block}

{* Remove sidebar *}
{block name='frontend_index_content_left'} {/block}

{block name="frontend_index_content"}
    <div class="listing--wrapper">
        <div class="container">
            {if $userId}
                <h1>{s name="helloUser"}Hello, your userId{/s} &mdash; {$userId}</h1>
            {else}
                <h2>{s name="undefinedUser"}Hello, your userId is undefined, try to login{/s}</h2>
            {/if}
            <div>{$groups|var_dump}</div>
        </div>
    </div>
{/block}