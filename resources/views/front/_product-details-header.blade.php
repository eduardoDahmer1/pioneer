<div class="col-lg-12 remove-padding">
    <div class="product-header_content d-flex flex-column justify-content-start pb-0 px-4 px-sm-0 px-lg-3">
        <h3 class="product-name d-block">{{ $productt->name }}</h3>

        @if($productt->sku != null)
            <p class="p-sku d-block">
                {{ __("Product SKU") }}: <span class="idno">{{ $productt->sku }}</span>
            </p>
        @endif
    </div>
</div>