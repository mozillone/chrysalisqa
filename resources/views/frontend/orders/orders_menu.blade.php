<ul class="nav nav-tabs">
                    <li {{ (Request::is('order/*') ? 'class=active' : '') }}><a href="/order/{{$order_id}}">Summary</a></li>
                    <li {{ (Request::is('my-order/shipping/*') ? 'class=active' : '') }}><a href="/my-order/shipping/{{$order_id}}">Shipping Status</a></li>
                    <li {{ (Request::is('my-order/transactions/*') ? 'class=active' : '') }}><a href="/my-order/transactions/{{$order_id}}">Payment Info</a></li>
</ul>