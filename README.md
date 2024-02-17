trip-sorter
===========
TRIP SORTER is an API that aims to sort a stack of boarding cards for various transportations that will take you
from point A to point B via several stops on the way.

After sorting the boarding cards, the API provides a description of how to complete your journey.

## Output example:

1. Take train 78A from Madrid to Barcelona. Sit in seat 45B.
2. Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
3. From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A.
Baggage drop at ticket counter 344.
4. From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B.
Baggage will we automatically transferred from your last leg.
5. You have arrived at your final destination.

## The solution design:

The application Domain Drive structure separates well the Domain layer (the Model) and the application layer (Boarding
Card Storing and sorting capabilities)

This separation allows to extends both the Domain and the Application independently from one another. The Domain
can than be enrished by adding new Boarding Card types (transportation) and the Application can also be extended
by adding new capabilities.

Here's a Domain Driven design used to implement the sorting solution,

![trip-sorter 1](https://cloud.githubusercontent.com/assets/1450211/23835814/21da7904-076e-11e7-81c9-02e826dd32cd.jpg)

## How to install the application

The application needs [composer to be installed globally](https://getcomposer.org/doc/00-intro.md#globally). Then you've to run the following command,

```sh
make build
```

## How to run your application

The input format is JSON ([check the available ./example.json file](https://github.com/ahsio/trip-sorter/blob/master/example.json)),

```json
[
  {
    "type": "flight",
    "designation": "SK22",
    "from": "Stockholm",
    "destination": "New York JFK",
    "gate": "22",
    "seat": "7B",
    "baggageDrop": null
  },
  {
    "type": "train",
    "designation": "78A",
    "from": "Madrid",
    "destination": "Barcelona",
    "seat": "45B"
  },
]
```
Many Boarding cards can be appended here. (The example.json file we use to test the application contains 5 boarding cards)

The application can then be tested using the provided `application.php` bootstrap file,

```sh
php ./src/application.php
```

```php
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
```
Which returns the journey instruction using both array & a human readable formats.
```sh
Sorted boarding cards - array format
Array
(
    [0] => Array
        (
            [type] => train
            [designation] => 78A
            [from] => Madrid
            [destination] => Barcelona
            [seat] => 45B
        )

    [1] => Array
        (
            [type] => bus
            [designation] => airport
            [from] => Barcelona
            [destination] => Gerona Airport
        )

    [2] => Array
        (
            [type] => flight
            [designation] => SK455
            [from] => Gerona Airport
            [destination] => Stockholm
            [gate] => 45B
            [seat] => 3A
            [baggageDrop] => 344
        )

    [3] => Array
        (
            [type] => flight
            [designation] => SK22
            [from] => Stockholm
            [destination] => New York JFK
            [gate] => 22
            [seat] => 7B
            [baggageDrop] =>
        )

)
Sorted boarding cards - Human readable format
Array
(
    [0] => Take train 78A from Madrid to Barcelona. Sit in seat 45B
    [1] => Take the airport bus from Barcelona to Gerona Airport. No seat assignment
    [2] => From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344.
    [3] => From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg.
)
```

## How to extend the application (Adding new types of transportations)

Adding new types of transportation is as easy as just implementing the `Domain\Model\BoardingCardInterface`.

If you want to benefits from the basic shared behaviors every transportation type has to cover, you can then
extend `Domain\Model\AbstractBoardingCard` as follow

```php
namespace Domain\Model;

class NewTransportationType extends AbstractBoardingCard
{
    const TYPE = 'new_type';

    /**
     * {@inheritdoc}
     */
    public function instruction()
    {
       // returns a string that turns the boarding card into a human readable instruction
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        // returns an array of values proper to the new transportation type
    }
}
```

The application design is open to extensions, the sorting algorithm can be replaced by adding a new TripSorter that
implement `Application\TripSorter\TripSorterInterface`.

The same extending capabilities was also provided for the `BoardingCardStoreInterface`.

## How to run phpspec tests

```sh
make test
```