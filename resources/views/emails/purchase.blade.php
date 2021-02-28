@component('mail::message')

<img src="https://store.minecrossing.xyz/storage/images/title.png" alt="MineCrossing Store" height="100%" width="100%">

# Order Complete

Thank you for your purchase.

**Order ID:** {{$order->id}}

**Order Email:** {{$order->billing_email}}

**Order Billing Name:** {{$order->billing_name}}

**Total Price:** £{{$order->billing_total}}

<hr>

**Items Ordered**

@foreach ($order->products as $product)
**Name:** {{ $product->name }} 

**Price:** £{{ $product->price }}

**Quantity:** {{ $product->pivot->quantity }}
@endforeach

You can get further details about your order by logging into our website.
@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Go to Website
@endcomponent

Note: Items may take up to 24 hours to appear in-game, please be patient. If you haven't received your items after 72 hours, contact us.


Thanks,<br>
The MineCrossing Team
@endcomponent
