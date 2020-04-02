<?php $__env->startSection('css'); ?>
<style type="text/css">
	.product{
		opacity: 0.7;
	}
	.product:hover{
		opacity: 1;
	}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main'); ?>

<div class="super_container_inner">
    <div class="super_overlay"></div>
    <div class="products">
        <div class="container">
            <div class="row products_row">

            	<?php 
            	//	print_r($products);
            	?>

            	<?php echo $__env->make('product.brick-standard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
        </div>
    </div>
    <div class="button load_more ml-auto mr-auto"><a href="#" class="link_again">больше</a></div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- <script src="<?php echo e(asset('public/js/main.js')); ?>"></script> -->
<script type="text/javascript">
	$(document).ready(function(){
    $('.load_more').click(function(){
      BaseRecord.top9=0;
      BaseRecord.more();
      return false;
    });
    // header_search_button
      $('.header_search_button').click(function(){
      BaseRecord.search=$('.search_input').val();
      BaseRecord.more();
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('product.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel-product/resources/views/product/index.blade.php ENDPATH**/ ?>