# Laravel - TVDB Wrapper

A dedicated Laravel package for the (TVDB.com)[http://tvdb.com] API.

## Installation

To install, use the following to pull the package in via Composer.

```
composer require dawson/tvdb
```

Now register the Service provider in `config/app.php`

```php
'providers' => [
	...
	Dawson\TVDB\TVDBServiceProvider::class,
],
```

And also add the alias to the same file.

```php
'aliases' => [
	...
	'TVDB' => Dawson\TVDB\TVDBFacade::class,
],
```

## Configuration

You now need to publish the `tvdb.php` config.

```
php artisan vendor:publish --provider="Dawson\TVDB\TVDBServiceProvider"
```

Now add the following environment variables to your `.env` file. You can obtain your **user key** and **api key** from your account on TVDB.com

```
TVDB_USERNAME=
TVDB_USERKEY=
TVDB_APIKEY=
```

# Searching

To search for TV Series, do the following:

Here's an example:

```php
$results = TVDB::search('Walking Dead');

return $results;
```

Where `$results` is a JSON response from the TVDB API. Here's an example response.

```json
{
  "data": [
    {
      "aliases": [],
      "banner": "graphical/153021-g44.jpg",
      "firstAired": "2010-10-31",
      "id": 153021,
      "network": "AMC",
      "overview": "The world we knew is gone. An epidemic of apocalyptic proportions has swept the globe causing the dead to rise and feed on the living. In a matter of months society has crumbled. In a world ruled by the dead, we are forced to finally start living. Based on a comic book series of the same name by Robert Kirkman, this AMC project focuses on the world after a zombie apocalypse. The series follows a police officer, Rick Grimes, who wakes up from a coma to find the world ravaged with zombies. Looking for his family, he and a group of survivors attempt to battle against the zombies in order to stay alive.\r\n",
      "seriesName": "The Walking Dead",
      "status": "Continuing"
    },
    {
      "aliases": [],
      "banner": "graphical/290853-g5.jpg",
      "firstAired": "2015-08-23",
      "id": 290853,
      "network": "AMC",
      "overview": "A horrifying zombiocalypse spin-off series from The Walking Dead, set in the same universe but starting at a far earlier time in Los Angeles. The show follows normal people learning to deal with the rapidly growing collapse of civilization, at the very beginning of a zombie outbreak.\r\n\r\nIn Los Angeles, a city where people come to escape, shield secrets, and bury their pasts, we follow this mysterious outbreak as it threatens to disrupt what little stability high school guidance counselor Madison Clark and English teacher Travis Manawa have managed to assemble. \r\n\r\nThe pressure of blending two families while dealing with resentful, escapist, and strung out children takes a back seat when society begins to break down. A forced evolution, and survival of the fittest takes hold, as our dysfunctional family finds they must either reinvent themselves or embrace their darker histories.",
      "seriesName": "Fear the Walking Dead",
      "status": "Continuing"
    }
  ]
}
```

# Questions

Should you have any questions, please feel free to submit an issue.