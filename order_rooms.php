<?php

switch ($_GET['sort'])
{
    case 'name_down':
        $order = 'ORDER BY `name`';
        break;
    case 'name_up':
        $order = 'ORDER BY `name` DESC';
        break;
    case 'no_down':
        $order = 'ORDER BY `no`';
        break;
    case 'no_up':
        $order = 'ORDER BY `no` DESC';
        break;
    case 'phone_down':
        $order = 'ORDER BY `phone`';
        break;
    case 'phone_up':
        $order = 'ORDER BY `phone` DESC';
        break;
}
