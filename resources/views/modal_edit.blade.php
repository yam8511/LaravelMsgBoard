<?php
/**
 * Created by PhpStorm.
 * User: yam8511_li
 * Date: 2016/8/17
 * Time: 下午 02:10
 */
?>
<?php $modal_id = 'modal_edit_'.$type.'_'.$id; ?>
<div id="{{ $modal_id }}" class="w3-modal" style="z-index: 900;">
    <div class="w3-modal-content w3-animate-zoom w3-card-8">
        <header class="w3-container w3-purple">
            <span onclick="cancel('{{ $modal_id }}')" class="w3-closebtn"><i class="fa fa-close"></i></span>
            <h2><i class="fa fa-commenting-o"></i>Editing...</h2>
        </header>
        <div class="w3-container">
            @if($type == 'msg')
            <h3 class="w3-text-black">{{ $msg->title }}</h3>
            @else
            <h3 class="w3-text-black">RE: {{ $msg->title }}</h3>
            @endif

            <div class="w3-container">
                <form action="/edit_{{ $type }}" method="post">
                    {{ csrf_field() }}

                    <label class="w3-label">暱稱</label>
                    <input class="w3-input w3-hover-border-cyan" type="text" name="name" value="{{ $msg->username($msg->id) }}"  placeholder="您的暱稱" readonly>

                    <label class="w3-label">訊息</label>
                    <textarea name="message" rows="6" class="w3-input w3-border w3-hover-border-cyan" style="resize: vertical" placeholder="輸入內容" required>{{ $msg->message }}</textarea>

                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{ $msg->id }}">
                    <br>
                    <?php
                    $origin = str_replace("\r","",$msg->message);
                    $origin = str_replace("\n","<br>",$origin);
                    $origin = str_replace("'","\\'",$origin);
                    $origin = str_replace('"','\\"',$origin);
                    ?>
                    <button class="w3-btn w3-round-large w3-red"><i class='fa
                           fa-check'></i></button>
                    <a class="w3-btn w3-round-large w3-teal" onclick="cancel('{{ $modal_id }}', '{{ $origin }}')"><i class="fa fa-close"></i></a>
                </form>
            </div>
        </div>
    </div>
</div>
