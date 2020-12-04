[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/christoffer-bolin/weathermodule/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/christoffer-bolin/weathermodule/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/christoffer-bolin/weathermodule/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/christoffer-bolin/weathermodule/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/christoffer-bolin/weathermodule/badges/build.png?b=master)](https://scrutinizer-ci.com/g/christoffer-bolin/weathermodule/build-status/master)
[![Build Status](https://travis-ci.com/christoffer-bolin/weathermodule.svg?branch=master)](https://travis-ci.com/christoffer-bolin/weathermodule)
[![CircleCI](https://circleci.com/gh/circleci/circleci-docs.svg?style=svg)](https://circleci.com/gh/christoffer-bolin/weathermodule)

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

Create the files `weatherapi.php` and `apikey.php` in the config/ folder,

paste in the following in weatherapi.php and change xxx to your apikeys.

`<?php

return [

    "weatherKeyHolder" => [

        "weatherKey" => "xxx",

        "mapboxKey" => "xxx"

    ]

];`

For your GetGeolocation API, do the same but use the following code, and paste into `apikey.php`,

`<?php

return [
    "keyHolder" => [
        "apiKey" => "x"
    ]
];
`


### Structure

The weather service will be available at `/weather`
and the ip service will be available at `/validate`



<!-- Version to use: 1.0.2 -->
