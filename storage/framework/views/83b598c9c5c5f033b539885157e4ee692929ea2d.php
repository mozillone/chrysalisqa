<ul class="nav nav-tabs">
                    <li <?php echo e((Request::is('order/*') ? 'class=active' : '')); ?>><a href="/order/<?php echo e($order_id); ?>">Summary</a></li>
                    <li <?php echo e((Request::is('my-order/shipping/*') ? 'class=active' : '')); ?>><a href="/my-order/shipping/<?php echo e($order_id); ?>">Shipping Status</a></li>
                    <li <?php echo e((Request::is('my-order/transactions/*') ? 'class=active' : '')); ?>><a href="/my-order/transactions/<?php echo e($order_id); ?>">Payment Info</a></li>
</ul>