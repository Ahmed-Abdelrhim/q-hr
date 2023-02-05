<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Forgot Password')); ?>

<?php $__env->stopSection(); ?>
<?php
    // $logo=asset(Storage::url('uploads/logo/'));
$logo=\App\Models\Utility::get_file('uploads/logo/');

?>

<?php $__env->startPush('custom-scripts'); ?>
<?php if(env('RECAPTCHA_MODULE') == 'yes'): ?>
        <?php echo NoCaptcha::renderJs(); ?>

<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('language-bar'); ?>

    <li class="nav-item">
        <select name="language" id="language" class="lang-dropdown btn btn-primary my-1 me-2" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <?php $__currentLoopData = App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e(route('password.request',$language)); ?>"><?php echo e(Str::upper($language)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="row align-items-center text-start">
        <div class="col-xl-6">
            <div class="card-body">
                <div class="">
                    <h2 class="mb-3 f-w-600"><?php echo e(__('Forgot Password')); ?></h2>
                    
                    <?php if(session('status')): ?>
                        <div class="alert alert-primary">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                </div>
                <form method="POST" action="<?php echo e(route('password.email')); ?>" id="form_data">
                    <?php echo csrf_field(); ?>
                    <div class="">
                        <div class="form-group mb-3">
                            <label for="email" class="form-label"><?php echo e(__('Email')); ?></label>
                            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>"  placeholder="Enter Yore Email" autocomplete="email" autofocus>
                                                        
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="error invalid-email text-danger" role="alert">
                                    <small><?php echo e($error); ?></small>
                                </span>                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>                      
                        <?php if(env('RECAPTCHA_MODULE') == 'yes'): ?>
                            <div class="form-group col-lg-12 col-md-12 mt-3">
                                <?php echo NoCaptcha::display(); ?>

                                <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error small text-danger" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        <?php endif; ?>
                            
                        <div class="d-grid">
                            <button class="btn btn-primary btn-submit btn-block mt-2"><?php echo e(__('Send Password Reset Link')); ?>  </button>
                        </div>
                        <p class="my-4 text-center"><?php echo e(__('Back to ')); ?>

                            <a href="<?php echo e(route('login',$lang)); ?>" class="my-4 text-primary"><?php echo e(__('Login')); ?></a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-6 img-card-side">
            <div class="auth-img-content">
                <img src="<?php echo e(asset('assets/images/auth/img-auth-3.svg')); ?>" alt="" class="img-fluid">
                <h3 class="text-white mb-4 mt-5">“Attention is the new currency”</h3>
                <p class="text-white">The more effortless the writing looks, the more effort the writer
                    actually put into the process.</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\q-sale xampp\htdocs\hr\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>