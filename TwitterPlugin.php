<?php

namespace Antanova\Wordpress;

class TwitterPlugin
{
    protected $factory;
    protected $config;
    
    function __construct($config)
    {
        $this->config = $config;
        add_action('wp_ajax_anta_tweets',         array($this, 'ajax_request'));
        add_action('wp_ajax_nopriv_anta_tweets',  array($this, 'ajax_request'));
        
        // temp, remove for production
        //wp_enqueue_script('twitter-text', site_url('wp-content/plugins/antanova-ajax-twitter/node_modules/twitter-text/twitter-text.js'), array('jquery'), null, true);
        wp_enqueue_script('twitter', plugins_url('/js/ajax-twitter.js', __FILE__), array('jquery'), null, true);
    }
    
    public function ajax_request()
    {
        $this->factory = new TwitterTokenFactory($this->config['api_key'], $this->config['api_secret']);
        $tweets = new Tweets($this->factory, new TwitterClient());
        $tweets->getTweets($this->config['screen_name'], 3);
    }
}