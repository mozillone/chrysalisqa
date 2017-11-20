<ul class="nav nav-tabs">
                    <li <?php echo e((Request::is('order/summary/*') ? 'class=active' : '')); ?>><a href="/order/summary/<?php echo e($order_id); ?>">Summary</a></li>
                    <li <?php echo e((Request::is('order/shipping/*') ? 'class=active' : '')); ?>><a href="/order/shipping/<?php echo e($order_id); ?>">Shipping Status</a></li>
                    <li <?php echo e((Request::is('order/transactions/*') ? 'class=active' : '')); ?>><a href="/order/transactions/<?php echo e($order_id); ?>">Payment Info</a></li>
                    <li <?php echo e((Request::is('order/desputes/*') ? 'class=active' : '')); ?>><a  href="/order/desputes/<?php echo e($order_id); ?>">Dispute</a></li>
</ul>

