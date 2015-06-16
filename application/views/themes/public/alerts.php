<?php

if($alerts = $this->alerts->get())
{
  foreach($alerts as $k => $v)
  {
    switch($k) 
    {
      case 'error': $class = "bg-danger"; break;
      case 'info': $class = "bg-info"; break;
      default: $class = "bg-primary"; break;
    }

    echo '<p class="alerts text-center '.$class.'">';
    foreach($v as $k2 => $v2) { echo $v2.'<br/>'; }
    echo '</p>';
  }
}