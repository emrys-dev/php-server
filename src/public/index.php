<?php
// Silence is golden.

$db = pg_connect("host=postgresql port=5432 dbname=superhype user=superhype password=Jeremias3374");
var_dump($db);
die();