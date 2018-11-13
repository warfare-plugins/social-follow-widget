<?php
//* Dummy data. These can just as well be class properties.
$style = 'square '; // or 'rect-small' or 'rect-large';
$network = 'facebook';
$icon = '<i class="swp-facebook"></i>';
$count = 300;
$cta = "Follow";

$button = <<<EOT
<div class="swfw-follow-button $style $network" data-newtork="$network">
  <div class="swfw-network-icon">$icon</div>

  <div class="swfw-content">
    <div class="swfw-count">$count</div>
    <div class="swfw-cta">$cta</div>
  </div>
</div>
EOT;

echo $button;
