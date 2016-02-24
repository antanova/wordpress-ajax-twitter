# Ajax Twitter #

A plugin to work in cooperation with a theme, such that the theme is able to pull in 
recent tweets via a simple ajax call. The theme js can then mark it up as required. 
The plugin is made for my own convenience, so is unlikely to get much more attention
unless I need to bug fix it for my own projects. 

## Why? ##

Page caching for a few hours means that the newest tweets don't show up until the 
cache is refreshed. I want to be able to use caching on the home page but still show
recent tweets. My solution is this. 

## Requirements ##

This plugin is written for developers. If you're an end user, it won't work by just 
installing it in Wordpress. 

* PHP > 5.3 (uses namespaces)
* npm and gulp (for building it)

## How to use ##

Build the plugin

````
npm install
npm run build
````

Simply send a request over to the wordpress endpoint with an action of `anta_tweets`. 
This is not designed as a flexible or user-friendly solution for use in wp-admin, but 
simply for use in a theme. For example:

````php
<div id="tweets" data-anta="<?php echo esc_attr(add_query_arg( array('action' => 'anta_tweets'), admin_url('admin-ajax.php') )); ?>"></div>
````

Then using the accompanying jQuery plugin, do this:

````js
$(function () {
    $('#tweets').twifity();
});
````

Add your api key, secrert and the twitter username in config/credentials.php, e.g.

````php

// config/credentials.php
return array(
    'api_key'     => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
    'api_secret'  => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'screen_name' => 'someone',
);
````