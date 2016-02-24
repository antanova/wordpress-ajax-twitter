<?php

namespace Antanova\Wordpress;

class TwitterClient
{
    protected $bearer_token;
    
    protected $url_base = 'https://api.twitter.com/1.1/';
    
    protected $headers = array();
    
    /**
     * Get a user's tweets
     * 
     * @param  string $user   username for the timeline 
     * @param  integer $count number of tweets to retrieve
     * @return array|wp_Error 
     */
    public function getUserStatuses($user, $count)
    {
        //$re = \wp_remote_get( 'https://httpbin.com/status/' )
        
        $url = $this->url_base . 'statuses/user_timeline.json?' . http_build_query(array(
            'count' => $count,
            'screen_name' => $user,
        ));
        $request = \wp_remote_get($url, array('headers' => $this->headers));
        return $request;
    }
    
    /**
     * Insert the bearer token into the request headers
     * 
     * @param  string  $bearer_token
     */
    public function setBearerToken($bearer_token)
    {
        $this->bearer_token = $bearer_token;
        $this->headers['Authorization'] = "Bearer $this->bearer_token";
    }
}