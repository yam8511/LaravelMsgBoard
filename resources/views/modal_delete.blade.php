<?php
/**
 * Created by PhpStorm.
 * User: yam8511_li
 * Date: 2016/8/17
 * Time: 上午 11:58
 */
?>
<?php $modal_id = 'modal_delete_'.$type.'_'.$id; ?>
<div id="{{ $modal_id }}" class="w3-modal" style="z-index: 900;">
    <div class="w3-modal-content w3-animate-zoom w3-card-8">
        <header class="w3-container w3-pale-red">
            <span onclick="cancel('{{ $modal_id }}')" class="w3-closebtn"><i class="fa fa-close"></i></span>
            <h2><i class="fa fa-warning"></i>Warning</h2>
        </header>
        <div class="w3-container">
            <h3 class="w3-text-black">確認刪除 {{ $msg->title }} ?</h3>
            <div class="w3-right">
                <form action="/del_{{ $type }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="{{ $msg->id }}">
                    <button class="w3-btn w3-round-large w3-red"><i class='fa
                           fa-check'></i></button>
                    <a class="w3-btn w3-round-large w3-teal" onclick="cancel('{{ $modal_id }}')"><i class="fa
                    fa-close"></i></a>
                </form>
            </div>
        </div>
    </div>
</div>
