{extends file='parent:frontend/index/index.tpl'}
{block name='frontend_index_after_body'}
    <div class="container"><h1>We replace block `frontend_index_after_body` with our own content. Link to our controller <a href="{url controller="example"}">HERE</a></h1></div>
{/block}