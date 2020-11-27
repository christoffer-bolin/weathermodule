## Weather module for Anax (used in the ramverk1 repo)

A module to use in the course ramverk1, using PHP framework Anax.

### Installation

`composer require chbl/weather`

`make install

make install test`

To run the tests use `make test`, but please remember to add you APIkeys first.

Instructions further down!

### Copy configuration

rsync -av vendor/chbl/weather/config/ config/

rsync -av vendor/chbl/weather/src/ src/

rsync -av vendor/chbl/weather/test/ test/

rsync -av vendor/chbl/weather/view/ view/

### Add your personal API keys

Create the file `weatherapi.php` in the config/ folder,

paste in the following and change xxx to your apikeys.

`<?php

return [

    "weatherKeyHolder" => [

        "weatherKey" => "xxx",

        "mapboxKey" => "xxx"

    ]

];`

### Structure

The weather service will be available at `/weather`
and the ip service will be available at `/validate`



<!-- Version to use: 1.0.2 -->
