<?php
if($authUser != null && $authUser['status'] == 1){
echo $this->News->getAdminNewsSingle($id);
echo $this->Comments->getAdminComments($newsid);

}else{
echo $this->News->getNewsSingle($id);
echo $this->Comments->getComments($newsid);

}

?>