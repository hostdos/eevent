<h1>Liste aller Eevent Teilnehmer</h1>
</br>
<h3>Angemeldete User</h3>
<ul>
<?php
if(!empty($usersa)){
foreach ($usersa as $u) {
echo '<li class="angemeldetlist">';
echo $u;
echo '</li>';
}}else{
echo '<li class="angemeldetlist">';
echo 'Es hat sich noch kein User für die Eevent angemeldet';
echo '</li>';
}?>
</ul>
</br>
<h3>Bezahlte User</h3>
<ul>
<?php
if(!empty($usersp)){
foreach ($usersp as $u) {
echo '<li class="angemeldetlist">';
echo $u;
echo '</li>';
}}else{
echo '<li class="angemeldetlist">';
echo 'Es hat noch kein User für die Eevent Bezahlt';
echo '</li>';
}?>
</ul>
