<div id="webchat">
<a>Chat</a>
<iframe src="https://kiwiirc.com/client/irc.kiwiirc.com/?nick=kiwis|?&theme=basic#eevent3" style="border:0; width:400px; height:350px;"></iframe>
</div>

<script>
$(document).ready(function(){
    $('#webchat a').on('click',function(){
        $('#webchat iframe').slideToggle('fast');
    });
});
</script>