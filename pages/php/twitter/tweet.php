<?php
    date_default_timezone_set('UTC');
    require_once("twitteroauth/twitteroauth.php"); // Path to twitteroauth library
    require_once('config.php'); // Path to config file

    // Check if keys are in place
    if (CONSUMER_KEY === '' || CONSUMER_SECRET === '') {
        echo 'You need a consumer key and secret keys. Get one from <a href="https://dev.twitter.com/apps">dev.twitter.com/apps</a>';
        exit;
    }

    // If count of tweets is not fall back to default setting
    $username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $number = filter_input(INPUT_GET, 'count', FILTER_SANITIZE_NUMBER_INT);
    $exclude_replies = filter_input(INPUT_GET, 'exclude_replies', FILTER_SANITIZE_SPECIAL_CHARS);
    $list_slug = filter_input(INPUT_GET, 'list_slug', FILTER_SANITIZE_SPECIAL_CHARS);
    $hashtag = filter_input(INPUT_GET, 'hashtag', FILTER_SANITIZE_SPECIAL_CHARS);

    if(!$username) {
        $username = USER_NAME;
    }

	if(CACHE_ENABLED) {
        // Generate cache key from query data
        $cache_key = md5(
            var_export(array($username, $number, $exclude_replies, $list_slug, $hashtag), true) . HASH_SALT
        );

        $cache_path = dirname(__FILE__) . '/cache/';

        // create cache folder
        if (!file_exists($cache_path)) {
            mkdir($cache_path, 0777, true);
        }

        // Remove old files from cache dir
        foreach (glob($cache_path . '*') as $file) {
            if (filemtime($file) < time() - CACHE_LIFETIME) {
                unlink($file);
            }
        }

        // If cache file exists - return it
        if(file_exists($cache_path . $cache_key)) {
            header('Content-Type: application/json');

            echo file_get_contents($cache_path . $cache_key);
            exit;
        }
    }

    /**
    * adds a link around any entities in a twitter feed
    * twitter entities include urls, user mentions, and hashtags
    * http://www.webtipblog.com/add-links-to-twitter-mentions-hashtags-and-urls-with-php-and-the-twitter-1-1-oauth-api/
    *
    * @author     Joe Sexton <joe@webtipblog.com>
    * @param      object $tweet a JSON tweet object v1.1 API
    * @return     string tweet
    */
    function addTweetEntityLinks ( $tweet ) {
        // actual tweet as a string
        $tweetText = $tweet->text;

        // create an array to hold urls
        $tweetEntites = array();

        // add each url to the array
        foreach( $tweet->entities->urls as $url ) {
            $tweetEntites[] = array (
                'type'    => 'url',
                'curText' => substr( $tweetText, $url->indices[0], ( $url->indices[1] - $url->indices[0] ) ),
                'newText' => "<a href='".$url->expanded_url."' target='_blank'>".$url->display_url."</a>"
            );
        }  // end foreach

        // add each user mention to the array
        foreach ( $tweet->entities->user_mentions as $mention ) {
            $string = substr( $tweetText, $mention->indices[0], ( $mention->indices[1] - $mention->indices[0] ) );
            $tweetEntites[] = array (
                'type'    => 'mention',
                'curText' => substr( $tweetText, $mention->indices[0], ( $mention->indices[1] - $mention->indices[0] ) ),
                'newText' => "<a href='http://twitter.com/".$mention->screen_name."' target='_blank'>".$string."</a>"
            );
        }  // end foreach

        // add each hashtag to the array
        foreach ( $tweet->entities->hashtags as $tag ) {
            $string = substr( $tweetText, $tag->indices[0], ( $tag->indices[1] - $tag->indices[0] ) );
            $tweetEntites[] = array (
                'type'    => 'hashtag',
                'curText' => substr( $tweetText, $tag->indices[0], ( $tag->indices[1] - $tag->indices[0] ) ),
                'newText' => "<a href='http://twitter.com/search?q=%23".$tag->text."&src=hash' target='_blank'>".$string."</a>"
            );
        }  // end foreach

        // replace the old text with the new text for each entity
        foreach ( $tweetEntites as $entity ) {
            $tweetText = str_replace( $entity['curText'], $entity['newText'], $tweetText );
        } // end foreach

        return $tweetText;
    }

    /**
     * Gets connection with user Twitter account
     * @param  String $cons_key     Consumer Key
     * @param  String $cons_secret  Consumer Secret Key
     * @param  String $oauth_token  Access Token
     * @param  String $oauth_secret Access Secrete Token
     * @return Object               Twitter Session
     */
    function getConnectionWithToken($cons_key, $cons_secret, $oauth_token, $oauth_secret)
    {
        $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_secret);

        return $connection;
    }

    // Connect
    $connection = getConnectionWithToken(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_SECRET);

    // Get Tweets
    if (!empty($list_slug)) {
      $params = array(
          'owner_screen_name' => $username,
          'slug' => $list_slug,
          'per_page' => $number
      );

      $url = '/lists/statuses';
    } else if($hashtag) {
      $params = array(
          'count' => $number,
          'q' => '#'.$hashtag
      );

      $url = '/search/tweets';
    } else {
      $params = array(
          'count' => $number,
          'exclude_replies' => $exclude_replies,
          'screen_name' => $username
      );

      $url = '/statuses/user_timeline';
    }

    $tweets = $connection->get($url, $params);

    // format date and prepare links in text
    foreach($tweets as $i => $tweet) {
        $tweets[$i]->text_entitled = addTweetEntityLinks($tweets[$i]);

        $date = date_parse($tweet->created_at);

        if($date['year'] == date('Y')) {
            $date = date('j F', strtotime($tweet->created_at));
        } else {
            $date = date('j F Y', strtotime($tweet->created_at));
        }
        $tweets[$i]->date_formatted = $date;
    }

    // Return JSON Object
    header('Content-Type: application/json');

    $tweets = json_encode($tweets);
    if(CACHE_ENABLED) file_put_contents($cache_path . $cache_key, $tweets);
    echo $tweets;
