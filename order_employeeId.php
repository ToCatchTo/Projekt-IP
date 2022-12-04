<?php

switch ($_GET['sort'])
{
    case 'surname_down': $order = 'ORDER BY `surname`'; break;
    case 'surname_up': $order = 'ORDER BY `surname` DESC'; break;
    case 'workplace_down': $order = 'ORDER BY `workplace`'; break;
    case 'workplace_up': $order = 'ORDER BY `workplace` DESC'; break;
    case 'phone_down': $order = 'ORDER BY `phone`'; break;
    case 'phone_up': $order = 'ORDER BY `phone` DESC'; break;
    case 'job_down': $order = 'ORDER BY `job`'; break;
    case 'job_up': $order = 'ORDER BY `job` DESC'; break;
}
