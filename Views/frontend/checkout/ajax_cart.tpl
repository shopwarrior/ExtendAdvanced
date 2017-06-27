{extends file='parent:frontend/checkout/ajax_cart.tpl'}
{block name='frontend_checkout_ajax_cart_prices_container_inner'}
    <div class="prices--articles">
        <span class="prices--articles-text">{s name="AjaxCartTotalAmount"}{/s}</span>
        <span class="prices--articles-amount">{$sBasket.Amount|currency}</span>
    </div>
    <div class="prices--articles">
        <span class="prices--articles-text">{s name="AjaxSomething"}Something{/s}</span>
        <span class="prices--articles-amount">{$sBasket.Amount}</span>
    </div>
    <div class="prices--articles">
        <span class="prices--articles-text">{s name="AjaxSomething1"}Something ssecond{/s}</span>
        <span class="prices--articles-amount">@@@@@@@@@@@@@@@@@</span>
    </div>
    {$smarty.block.parent}
{/block}
