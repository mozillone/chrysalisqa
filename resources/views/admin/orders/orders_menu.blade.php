<ul class="nav nav-tabs">
                    <li {{ (Request::is('order/summary/*') ? 'class=active' : '') }}><a href="/order/summary/{{$order_id}}">Summary</a></li>
                    <li {{ (Request::is('order/shipping/*') ? 'class=active' : '') }}><a href="/order/shipping/{{$order_id}}">Shipping Status</a></li>
                    <li {{ (Request::is('order/transactions/*') ? 'class=active' : '') }}><a href="/order/transactions/{{$order_id}}">Payment Info</a></li>
                    <li {{ (Request::is('order/desputes/*') ? 'class=active' : '') }}><a  href="/order/desputes/{{$order_id}}">Dispute</a></li>
</ul>

