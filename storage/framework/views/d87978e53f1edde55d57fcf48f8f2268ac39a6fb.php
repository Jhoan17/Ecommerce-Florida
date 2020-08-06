<?php if($errors->any()): ?>
	<div id="toast-container" class="toast-top-right">	
		<?php $__currentLoopData = $errors -> all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="toast toast-error toast-time-hide" aria-live="assertive" style="">
				<div class="toast-message">
					<?php echo e($error); ?>

				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>		
<?php endif; ?>

<?php /**PATH C:\laragon\www\dulcesorpresa\resources\views/includes/form-error.blade.php ENDPATH**/ ?>