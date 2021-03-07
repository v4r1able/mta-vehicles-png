<?php
function curl_v4($site) {
$ch = curl_init($site);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_NOBODY, 0);
$v4r1able = curl_exec($ch);

return $v4r1able;
}

$araclar = curl_v4("https://wiki.multitheftauto.com/wiki/Vehicle_IDs");

preg_match_all('@<td>(.*?)</td>@', $araclar, $veri1);
preg_match_all('@<td align="center"><a href="(.*?)" class="image"><img alt="(.*?)" src="(.*?)"@', $araclar, $veri2);


$toplam = count($veri1[1]);

$f = 0;
$durum = array();

for($i=0; $i<$toplam; $i++) {
if(!is_file("araclar/".$veri1[1][$i+1].".png")) {
$aracpng = curl_v4("https://wiki.multitheftauto.com/".$veri2[3][$f]);
$ekle = file_put_contents("araclar/".$veri1[1][$i+1].".png", $aracpng);
if(!$ekle) {
array_push($durum, "ID:".$veri1[1][$i+1]." Eklenemedi");
}
}
$f++;
$i++;
}

if($durum) {
    print_r($durum);
}
?>
