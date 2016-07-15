<?php
/*
Plugin name: Ajax Twitter
Author: Jason Crosse
Author URI: http://antanova.com
Description: Use async js requests to fetch tweets, so we can use page caching for our home page.
Version: 0.1.0
*/
/*
    Ajax Twitter plugin - get tweets via json
    Copyright (C) 2016  Jason Crosse

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace Antanova\Wordpress;

require_once 'autoloader.php';
Autoloader::init(__DIR__);

$config = include __DIR__.'/config/credentials.php';

new TwitterPlugin($config);
