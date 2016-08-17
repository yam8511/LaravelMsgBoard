/**
 * Created by yam8511_li on 2016/8/17.
 */

function show(modal_id){
    document.getElementById(modal_id).style.display='block';
}
function cancel(modal_id, orgin){
    var modal =  document.getElementById(modal_id);
    modal.style.display='none';
    if(orgin != null) {
        var res = orgin.replace("<br>", "\r\n");
        modal.getElementsByTagName('textarea')[0].value = res;
    }
}