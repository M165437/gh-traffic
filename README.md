# GitHub Traffic - beyond 14 days

[![GitHub release](https://img.shields.io/github/release/M165437/gh-traffic.svg)](https://github.com/M165437/gh-traffic/releases/latest) [![Unstable](https://img.shields.io/badge/unstable-master-orange.svg)](https://github.com/M165437/gh-traffic/tree/master) [![License](https://img.shields.io/badge/license-MIT-green.svg?style=flat&colorB=458979)](https://github.com/M165437/gh-traffic/blob/master/LICENSE.md) [![Twitter](https://img.shields.io/badge/twitter-@M165437-blue.svg?style=flat&colorB=00aced)](http://twitter.com/M165437)

GitHub shows anyone with push access to a repository its traffic from the past two weeks. You want to monitor the traffic beyond that time? Automatically fetch and persist your traffic on a regular basis and plot the data onto a chart.

Either install this free, self-hosted application to keep track of a single repository or head over to [gh-traffic.com](https://gh-traffic.com) and sign up for an extended service, hosted for you.

## Installation

This app is based on Laravel 5.5 and has the same [requirements](https://laravel.com/docs/5.5#server-requirements).

First, clone the application:

``` bash
git clone https://github.com/M165437/gh-traffic.git
```

Next, install its dependencies:

``` bash
composer install
npm install
```

Finally, compile its assets:

``` bash
npm run production
```

## Configuration

Copy the `.env.example` to `.env` and configure its variables. At the very least, you need to update your database credentials, your [GitHub API key](https://help.github.com/articles/creating-a-personal-access-token-for-the-command-line/) and the repository you want to monitor.

```bash
GITHUB_API_TOKEN=valid-personal-access-token
REPOSITORY_OWNER=m165437
REPOSITORY_NAME=gh-traffic
```

Use Artisan to set your application key to a random string:

```bash
php artisan key:generate
```

For the automatic fetching and persistance of traffic data, you need to add the following Cron entry to your server:

```bash
* * * * * php /path-to-this-app/artisan schedule:run >> /dev/null 2>&1
```

## Chart

Visit this app's root domain `/` to see the chart.

![GitHubTraffic](https://i.imgur.com/aclq4mv.png)

## Testing

Run the tests with:

```bash
vendor/bin/phpunit
```

## Contributing

Thank you for considering contributing to this project! Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

This app is licensed under the MIT License (MIT). Please see the [LICENCE](LICENSE.md) file for more information.