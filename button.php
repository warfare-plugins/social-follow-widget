<?php
//* Dummy data. These can just as well be class properties.
$style = 'square '; // or 'rect-small' or 'rect-large';
$network = 'facebook';
$icon = '<i class="swp-facebook"></i>';
$count = 300;
$cta = "Follow";

$button = <<<EOT
<div class="swfm-follow-button $style $network" data-newtork="$network">
  <div class="swfm-network-icon">$icon</div>

  <div class="swfm-content">
    <div class="swfm-count">$count</div>
    <div class="swfm-cta">$cta</div>
  </div>
</div>
EOT;

echo $button;
