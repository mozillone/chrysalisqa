<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/pages/order_thanku.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/vendors/slidersjs/ion.rangeSlider.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/assets/frontend/vendors/slidersjs/ion.rangeSlider.skinFlat.css')); ?>">
<style type="text/css">
	 .irs-line-mid, .irs-line-left, .irs-line-right, .irs-bar, .irs-bar-edge, .irs-slider {
            background: #60C4AB;
        }

        .irs-bar {
            background: #E1E1E1;
        }

        .range-slider {
            width: 35%;
            margin: 0 auto;
        }
        .range-slider a {
            background: #EE4266;
            color: white;
            padding: 12px 80px;
            display: inline-block;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 800;
            margin: 0 auto;
        }

        .irs-from, .irs-to, .irs-single {
            background: #60C3AB;
            display: none;
        }

        .irs-min, .irs-max {
            display: none;
        }

        .irs-from:after, .irs-to:after, .irs-single:after {
            border-top-color: #60C4AB;
        }

        .irs-slider {
            border-radius: 50%;
            background: white;
            box-shadow: 1px 1px 2px #ccc;
            border: 1px solid #d3d3d3;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .outer {
            border: solid 1px transparent;
            width: 402px;
            margin: 40px auto;
            position: relative;
            background-color: #e1e1e1;
            /*background: url("../assets/frontend/img/dollar.png") no-repeat 100% 100%;*/

        }

        #first-box {
            position: relative;
            left: auto;
            right: auto;
            width: 0;
            height: 210px;
            background-color: #60C3AB;
            float: left;
        }

        #second-box {
            width: 0;
            height: 210px;
            float: right;
            background-color: #60C3AB;
        }

        .doller-img {
            position: absolute;
            left: 6%;
            top: 12%;
            z-index: 1;
        }

        .range-slider .currency-bar {
            padding-left: 0;
            list-style-type: none;
            display: flex;
            font-weight: 800;
            font-size: 10px;
            margin-bottom: 0;
        }

        .range-slider .currency-bar li {
            padding: 0 3.15%;
        }

        .range-slider .currency-bar li:first-child {
            padding-left: 0;
        }

        .range-slider .currency-bar li:nth-child(even) {
            color: #60C4AB;
        }

        .contribution-label {
            padding-left: 0;
            list-style-type: none;
            font-size: 18px;
            font-weight: 800;
            font-family: Proxima-Nova-Extrabold;
            min-height: 50px;
            display: block;
        }

        .contribution-label li:last-child {
            float: right;
            text-align: end;
        }

        .contribution-label li:first-child {
            float: left;
        }

        .range-slider table {
            margin: 0 auto;
            font-size: 16px;
            margin-bottom: 50px;
        }

        .range-slider table td:nth-child(even) {
            font-weight: 800;
            padding-left: 5px;
        }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <div class="container">
		<div class="row">
		<?php if(Session::has('error')): ?>
        <div class="alert alert-danger alert-dismissable">
			<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
			<?php echo e(Session::get('error')); ?>

		</div>
        <?php elseif(Session::has('success')): ?>
		<div class="alert alert-success alert-dismissable">
			<a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
			<?php echo e(Session::get('success')); ?>

		</div>
		<?php endif; ?>
			<form action="<?php echo e(route('order-charity-fund')); ?>" method="POST" id="order-charity">
			<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			<input type="hidden" name="order_id" value="<?php echo e(implode(',',$order_id)); ?>">
			<input type="hidden" name="amount" value="1">
					
			<div class="thankyou-rm">
				<div class="col-md-6">
				<h2 class="prog-head">Thank You For Your Purchase!</h2>
					<p class="thankyou-text thankyou-textR">Order No:<?php echo e(implode(",",$order_id)); ?></p>
					<p class="thankyou-text">Hang tight! You will receive an order confirmation with details of your purchase shortly!</p>

					<p class="thankyou-text">In the meantime, <br/>
					<span class="thankyou-bold">Share Your Purchase!</span></p>
					<ul class="thankyou-socio">
					<li><img src="../assets/frontend/img/thnk-fb.png" alt="thnk-fb" /></li>
					<li><img src="../assets/frontend/img/thnk-tw.png" alt="thnk-tw" /></li>
					<li><img src="../assets/frontend/img/thnk-yt.png" alt="thnk-yt" /></li>
					</ul>

				</div>

				<div class="col-md-6">
					<h2 class="prog-head">Did You know?</h2>
					<p class="thankyou-text">A portion of our profits goes to a charity of your choice. Please take a moment to select a cause you feel most passionate about. Should this field be left blank, we will choose a charity on your behalf.</p>

					<div>



					<ul class="ct3-list">
					<?php $__currentLoopData = $charities_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charities): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<li>
						<?php if(file_exists(public_path('/charities_images/'.$charities->image))): ?>
							<img src="/charities_images/<?php echo e($charities->image); ?>" alt="cst3" /><span class="crt-name"><?php echo e($charities->name); ?></span><input type="radio" name="charity" id="charity" value="<?php echo e($charities->id); ?>"/></li>
						<?php else: ?>
							<img src="/charities_images/default-placeholder.jpg" alt="cst3" /><?php echo e($charities->name); ?><input type="radio" name="charity" id="charity" value="<?php echo e($charities->id); ?>"/></li>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</ul>
					<p class="cst2-rms-chck"><input type="checkbox"  id="suggest_charity" checked="checked"> I would like to suggest another charity organization</p>


					<div class="thankyou-rms">
					<p class="thankyou-rms-head thankyou-text"><span>Please Specify:</span>
					<input type="text" placeholder="Organization Name" name="suggest_charity" / ></p>
					</div>

					</div>
				</div>


				<div class="col-md-12">
					<div class="thankyou-doeven">
					<h2 class="thankyou-do">Do even MORE!</h2>
					<p class="thankyou-textC">Join us in our mission to see a dollar raised for every box shipped. <span class="thankyou-bold">Donate 0.50 cents below and we will match your donation!</span></p>
					<div class="thankyou-do-img">
					<div class="outer">
				        <img class="doller-img" src="/assets/frontend/img/Dollar_white.png" alt="">
				        <div id="first-box">
				        </div>
				        <div id="second-box">
				        </div>
				        <div style="clear:both">

				        </div>

				    </div>		
					<div class="range-slider">
				        <ul class="currency-bar">
				            <li>0</li>
				            <li>$0.25</li>
				            <li>$0.5</li>
				            <li>$0.75</li>
				            <li>$1</li>
				            <li>$0.75</li>
				            <li>$0.5</li>
				            <li>$0.25</li>
				            <li>0</li>
				        </ul>
				        <input type="text" class="js-range-slider" value=""/>
				        <ul class="contribution-label">
				            <li>Your <br> Contribution</li>
				            <li>Our <br> Contribution</li>
				        </ul>
				        <div>
				            <table>
				                <tr>
				                    <td>Your Donation:</td>
				                    <td class="my-donation"> $0.00</td>
				                </tr>
				                <tr>
				                    <td>Our Donation:</td>
				                    <td class="chrysalis-donation">$0.00</td>
				                </tr>
				                <tr>
				                    <td>Total Donation:</td>
				                    <td class="total-donation">$0.00</td>
				                </tr>
				            </table>
				        </div>
				        <div style="text-align: center; margin-bottom: 50px">
				          <input type="submit" value="Submit" class="thankyou-btn"/>
				        </div>

				    </div>
				    </div>
					</div>
				</div>
				</form>

			</div>
	</div>	
</div>
       
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<script src="<?php echo e(asset('/js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/vendors/slidersjs/rangeSlider.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/frontend/js/pages/order_thanku.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('/frontend/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>