<?php

class SendSms {

    public static function send($msg, $mobileno) {
        $url = "http://easyhops.co.in/sendsms?";
        $post_data = "uname=bobansms1";
        $post_data = $post_data . "&pwd=bobansms123";
        $post_data = $post_data . "&senderid=TOCSYS";
        $post_data = $post_data . "&to=$mobileno";
        $post_data = $post_data . "&msg=$msg";
        $post_data = $post_data . "&route=T";
       //  echo $url.$post_data;
        self::submit_post($url, $post_data);
    }

    public static function sendMulti($msg, $mobilenos) {
       $url = "http://easyhops.co.in/sendsms?";
        $post_data = "uname=bobansms1";
        $post_data = $post_data . "&pwd=bobansms123";
        $post_data = $post_data . "&senderid=GVSSSB";
        foreach ($mobilenos as $m) {
            $post_data = $post_data . "&to=$m";
        }
        $post_data = $post_data . "&msg=$msg";
        $post_data = $post_data . "&route=T";
        //  echo $url.$post_data;
        self::submit_post($url, $post_data);
    }

    public static function submit_post($url, $post_data) {
        $timeout = 0;
        $url = str_replace("&amp;", "&", urldecode(trim($url)));
        $cookie = tempnam("/tmp", "CURLCOOKIE");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    # required for https urls
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        $content = curl_exec($ch);
        $response = curl_getinfo($ch);
        curl_close($ch);

        if ($response['http_code'] == 301 || $response['http_code'] == 302) {
            ini_set("user_agent", "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");

            if ($aheaders = get_aheaders($response['url'])) {
                foreach ($aheaders as $value) {
                    if (substr(strtolower($value), 0, 9) == "location:")
                        return get_url(trim(substr($value, 9, strlen($value))));
                }
            }
        }

        if (( preg_match("/>[[:space:]]+window\.location\.replace\('(.*)'\)/i", $content, $value) || preg_match("/>[[:space:]]+window\.location\=\"(.*)\"/i", $content, $value) ) &&
                $javascript_loop < 5
        ) {
            return get_url($value[1], $javascript_loop + 1);
        } else {
            return array($content, $response);
        }
    } 
}