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
     * @param  string $user   [[Description]]
     * @param  integer $count [[Description]]
     * @return array|wp_Error [[Description]]
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
    
    public function setBearerToken($bearer_token)
    {
        $this->bearer_token = $bearer_token;
        $this->headers['Authorization'] = "Bearer $this->bearer_token";
    }
}