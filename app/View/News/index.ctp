<?php
if($authUser != null && $authUser['status'] == 1){
echo $this->News->getAdminNewsBig($amount);
}else{
echo $this->News->getNewsBig($amount);
}
?>