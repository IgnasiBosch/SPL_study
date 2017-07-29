<?php

$r = new SplDoublyLinkedList();
$r->add(0, '0XX');
$r->add(1, '1XX');
$r->add(2, '2XX');
$r->add(3, '3XX');
var_dump($r->serialize());