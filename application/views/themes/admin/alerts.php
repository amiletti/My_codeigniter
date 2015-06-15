<?php

if($alerts = $this->alerts->get())
{
  foreach($alerts as $k => $v)
  {
    echo '<p class="alerts '.$k.'">';
    foreach($v as $k2 => $v2) { echo $v2.'<br/>'; }
    echo '</p>';
  }
}