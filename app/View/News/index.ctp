<?php
if($authUser != null && $authUser['status'] == 1){
echo $this->News->getAdminNewsBig(2);
}else{
echo $this->News->getNewsBig(2);
}
?>