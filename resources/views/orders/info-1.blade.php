@if ($order->orderable instanceof App\Models\PrepaidBalance)
    @if ($order->orderable->status === App\Models\PrepaidBalance::STATUS_SUCCESS)
        <span class="text-success">Success</span>
    @else
        <span class="text-danger">Failed</span>
    @endif
@elseif ($order->orderable instanceof App\Models\ProductCommerce)
    <span>{{ $order->orderable->shipping_code }}</span>
@endif