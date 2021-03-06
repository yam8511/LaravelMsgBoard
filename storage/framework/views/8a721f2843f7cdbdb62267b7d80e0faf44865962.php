<?php
/**
 * Created by PhpStorm.
 * User: yam8511_li
 * Date: 2016/8/17
 * Time: 下午 03:28
 */
?>

<div class="w3-container w3-margin-bottom">
    <ul class="w3-ul w3-card-4">
        <!-- 回覆列表 -->
        <?php foreach( $msg->replies as $index => $rpl ): ?>
        <li class="w3-container <?php echo e($bg[$index%2]); ?>">
            <div class="w3-container">
                <span class="w3-large"><a style="text-decoration: none;" href="/view/<?php echo e($rpl->user_id); ?>"><?php echo e($rpl->username($rpl->user_id)); ?></a></span>　　
                <span class="w3-small w3-text-grey"><?php echo e($rpl->updated_at); ?></span><br>
                <span><?= nl2br($rpl->message) ?></span>
            </div>
            <!-- 修改&刪除按鈕 -->
            <div class="w3-container w3-padding">
                <?php if( $login && ( $rpl->user_id == Auth::user()->id ) ): ?>
                    <a class="w3-btn w3-round w3-purple" title="修改" onclick="show('modal_edit_rpl_<?php echo e($rpl->id); ?>')"><i class="fa
        	        fa-pencil"></i></a>
                    <!-- 顯示編輯視窗 -->
                    <?php echo $__env->make('modal_edit', ['type' => 'rpl', 'msg' => $rpl], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
                <?php if( $login && ( $rpl->user_id == Auth::user()->id || $msg->user($msg->user_id)->id == Auth::user()->id || Auth::user()->admin) ): ?>
                    <a class="w3-btn w3-round w3-red" title="刪除" onclick="show('modal_delete_rpl_<?php echo e($rpl->id); ?>')"><i class="fa fa-trash"></i></a>
                    <!-- 顯示刪除提醒視窗 -->
                    <?php echo $__env->make('modal_delete', ['type' => 'rpl', 'msg' => $rpl], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- 回覆輸入 -->
<form action="/reply" method="post" accept-charset="UTF-8">
    <?php echo e(csrf_field()); ?>

    <div class="w3-row-padding">
        <div class="w3-col m10">
            <?php if($login): ?>
                <textarea name="message" rows="1" style="width: 100%; resize: none;" class="auto-height w3-hover-border-cyan" placeholder="輸入內容" required></textarea>
            <?php else: ?>
                <textarea name="message"  rows="1" style="resize:none; width: 100%;" class="auto-height w3-hover-border-cyan" placeholder="請先登入，才能回覆" readonly></textarea>
            <?php endif; ?>
            <input type="hidden" name="msg_id" value="<?php echo e($msg->id); ?>">
        </div>
        <div class="w3-col m2">
            <button style="width: 100%;" class="w3-btn w3-round-large w3-teal">回覆</button>
        </div>
    </div>
</form>
