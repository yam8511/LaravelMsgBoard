<?php $__env->startSection('content'); ?>
<div class="w3-container">
    <div class="w3-card-4">
        <form name="registerForm" action="register" method="post" onsubmit="return validate()" accept-charset="utf-8" class="w3-form  w3-margin ">
            <?php echo e(csrf_field()); ?>

            <div class="w3-input-group">
                <label class="w3-label" for="form_username">名稱</label>
                <input name="name" class="w3-input w3-hover-border-cyan" placeholder="您的名稱" required="required" value="<?php echo e(old('name')); ?>" id="form_username" type="text">
                <?php if(old('register') && $errors->has('name')): ?>
                    <p class="help-block hint"><strong><?php echo e($errors->first('name')); ?></strong></p>
                <?php endif; ?>
            </div>
            <div class="w3-input-group">
                <label class="w3-label" for="form_password">密碼</label>
                <input class="w3-input w3-hover-border-cyan" placeholder="您的密碼" required="required" name="password" value="" id="form_password" type="password">
                <?php if(old('register') && $errors->has('password')): ?>
                    <p class="help-block hint"><strong><?php echo e($errors->first('password')); ?></strong></p>
                <?php endif; ?>
            </div>

            <div class="w3-input-group">
                <label class="w3-label" for="form_comfirm">確認密碼</label>
                <input class="w3-input w3-hover-border-cyan" placeholder="確認密碼" required="required" name="password_confirmation" value="" id="form_confirm" type="password">
                <?php if(old('register') && $errors->has('password_confirmation')): ?>
                    <p class="help-block hint"><strong><?php echo e($errors->first('password_confirmation')); ?></strong></p>
                <?php endif; ?>
            </div>

            <div class="w3-input-group">
                <label class="w3-label" for="form_email">E-mail</label>
                <input class="w3-input w3-hover-border-cyan" placeholder="您的E-mail" required="required" name="email" value="<?php echo e(old('email')); ?>" id="form_email" type="email">
                <?php if(old('register') && $errors->has('email')): ?>
                    <p class="help-block hint"><strong><?php echo e($errors->first('email')); ?></strong></p>
                <?php endif; ?>
            </div>

            <input class="w3-btn w3-pink w3-ripple" name="register" value="註冊" id="form_send"
                   type="submit">
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['login'=>false, 'title'=>'註冊'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>