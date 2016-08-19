<?php $__env->startSection('content'); ?>
    <div class="w3-container w3-margin">
        <a class="w3-btn w3-btn-floating  w3-teal" title="留話" href="add"><i class="fa fa-plus"></i></a>
        <?php if($login): ?>
        <a class="w3-btn w3-btn-floating  w3-blue" title="登出" href="logout"><i class="fa fa-sign-out"></i></a>
        <?php else: ?>
        <a class="w3-btn w3-btn-floating  w3-pink" title="加入我們" onclick="document.getElementById('modal_register').style.display='block'"><i class="fa fa-user-plus "></i></a>
        <a class="w3-btn w3-btn-floating  w3-blue" title="登入" onclick="document.getElementById('modal_login').style.display='block'"><i class="fa fa-sign-in"></i></a>
        <?php endif; ?>
    </div>

    <!-- 成功訊息 -->
    <?php if($success): ?>
    <div class="w3-round w3-pale-green">
        <span onclick="this.parentElement.style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
        <h3><i class="fa fa-check-square-o"></i><?php echo e($success); ?></h3>
    </div>
    <?php endif; ?>

    <!-- 錯誤訊息 -->
    <?php if($failed): ?>
    <div class="w3-round w3-pale-red">
        <span onclick="this.parentElement.style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
        <h3><i class="fa fa-frown-o"></i><?php echo e($failed); ?></h3>
    </div>
    <?php endif; ?>

    <?php foreach($msgs as $index => $msg): ?>
    <div class=" w3-container w3-margin-bottom  w3-leftbar  <?php echo e($style[$index]); ?>">
        <div class="w3-container">
            <!-- 留言標題 -->
            <h2><b><?php echo e($msg->title); ?></b></h2>
            <!-- 留言人 -->
            <a style="text-decoration: none;" class="w3-text-blue " <?php echo e($msg->user_id != 0 ? "href=view/$msg->user_id" : ''); ?>><?= $msg->username($msg->user_id) ?></a>
            <!-- 留言日期 -->
            <br><span class="w3-text-grey w3-small">留言日期: <?php echo e($msg->created_at); ?></span>
            <br><span class="w3-text-grey w3-small">更新日期: <?php echo e($msg->updated_at); ?></span>
            <!-- 留言訊息 -->
            <p><?= nl2br($msg->message) ?></p>
            <?php if($msg->uploads): ?>
            <div class="w3-container w3-margin">
                <?php foreach($msg->uploads as $pic): ?>
                    <img class="w3-round" src="<?php echo e($pic->saved_to.'/'.$pic->saved_as); ?>" alt="<?php echo e($pic->name); ?>">
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <!-- 修改&刪除按鈕 -->
            <?php if($login && ( $msg->user_id == Auth::user()->id )): ?>
                <a class="w3-btn-floating  w3-purple" title="修改" onclick="show('modal_edit_msg_<?php echo e($msg->id); ?>')"><i
                            class="fa fa-pencil"></i></a>
                <?php echo $__env->make('modal_edit', ['type' => 'msg', 'msg' => $msg], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <?php if($login && ( $msg->user_id == Auth::user()->id || Auth::user()->admin ) ): ?>
                <a class="w3-btn-floating  w3-red" title="刪除" onclick="show('modal_delete_msg_<?php echo e($msg->id); ?>')"><i class="fa
                fa-trash"></i></a>
                <?php echo $__env->make('modal_delete', ['type' => 'msg', 'msg' => $msg ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        </div>
        <!-- 回覆留言 -->
        <div class="w3-border-top w3-border-teal w3-padding">
            <?php echo $__env->make('reply', ['login'=>$login, 'msg'=>$msg, 'bg' => $bg], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <?php endforeach; ?>

    <?php echo $__env->make('modal_register', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('modal_login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>