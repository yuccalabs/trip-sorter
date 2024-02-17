<?php

require './vendor/autoload.php';

use Application\BoardingCard\BoardingCardStore;
use Application\TripSorter\TripSorter;
use Application\BoardingCard\BoardingCardFactory;

$boardingCardStore = new BoardingCardStore();

foreach (json_decode(file_get_contents('./example.json')) as $json) {
    $boardingCardStore->add(
        BoardingCardFactory::build($json)
    );
}

$tripSorter = new TripSorter($boardingCardStore);
$tripSorter->sort();

echo "Sorted boarding cards - array format\n";
print_r($tripSorter->toArray());

echo "Sorted boarding cards - Human readable format\n";
print_r($tripSorter->instructions());
