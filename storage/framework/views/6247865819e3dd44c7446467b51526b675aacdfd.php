<?php
/**
 * Created by PhpStorm.
 * User: yam8511_li
 * Date: 2016/8/17
 * Time: 上午 10:16
 */
?>

<div id="modal_register" class="w3-modal" style="z-index: 900;
<?php if(old('register') && ($errors->has('name') || $errors->has('email') || $errors->has('password') || $errors->has('password_confirmation') ) ): ?>
        display: block;
<?php endif; ?>
">
    <div class="w3-modal-content w3-animate-zoom w3-card-8">
        <header class="w3-container w3-pink">
            <span onclick="document.getElementById('modal_register').style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
            <h2><i class="fa fa-user"></i>註冊</h2>
        </header>
        <div class="w3-container">
            <form name="registerForm" action="register" method="post" onsubmit="return validate()" accept-charset="utf-8" class="w3-form  w3-margin ">
                <?php echo e(csrf_field()); ?>


                <label class="w3-label" for="form_username">名稱</label>
                <input name="name" class="w3-input w3-hover-border-cyan" placeholder="您的名稱" required="required" value="<?php echo e(old('name')); ?>" id="form_username" type="text">
                <?php if(old('register') && $errors->has('name')): ?>
                    <p class="help-block hint"><strong><?php echo e($errors->first('name')); ?></strong></p>
                <?php endif; ?>

                <label class="w3-label" for="form_password">密碼</label>
                <input class="w3-input w3-hover-border-cyan" placeholder="您的密碼" required="required" name="password" value="" id="form_password" type="password">
                <?php if(old('register') && $errors->has('password')): ?>
                    <p class="help-block hint"><strong><?php echo e($errors->first('password')); ?></strong></p>
                <?php endif; ?>

                <label class="w3-label" for="form_comfirm">確認密碼</label>
                <input class="w3-input w3-hover-border-cyan" placeholder="確認密碼" required="required" name="password_confirmation" value="" id="form_confirm" type="password">
                <?php if(old('register') && $errors->has('password_confirmation')): ?>
                    <p class="help-block hint"><strong><?php echo e($errors->first('password_confirmation')); ?></strong></p>
                <?php endif; ?>

                <label class="w3-label" for="form_email">E-mail</label>
                <input class="w3-input w3-hover-border-cyan" placeholder="您的E-mail" required="required" name="email" value="<?php echo e(old('email')); ?>" id="form_email" type="email">
                <?php if(old('register') && $errors->has('email')): ?>
                    <p class="help-block hint"><strong><?php echo e($errors->first('email')); ?></strong></p>
                <?php endif; ?>

                <input class="w3-btn w3-pink w3-ripple" name="register" value="註冊" id="form_send"
                       type="submit">
            </form>
        </div>
    </div>
</div>

<script src="js/validate.js"></script>