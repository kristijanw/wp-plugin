<?php

class WebProHelper {

    public function admin_menu_item_data($page_slug) {

        $results = [];

        switch($page_slug) {
            case WEBPRO_ADMIN_PREFIX . 'home':
                $results = [
                    'title' => __('WebPro Home'),
                    'desc' => ''
                ];
                break;
            case WEBPRO_ADMIN_PREFIX . 'options_erp':
                $results = [
                    'title' => __('WebPro ERP'),
                    'desc' => ''
                ];
                break;
        }

        return $results;
    }

    public function erp_options_data($group_index) {
        //API settings options
        $erp_api_options = [
            'erp-login' => [
                'erp_username' => get_option( 'erp_username', '' ),
                'erp_password' => get_option( 'erp_password', '' ),
            ],
        ];

        return $erp_api_options[$group_index];
    }

    public function cc_custom_encrypt($string, $key=15) {
        $result = '';
        for($i=0, $k= strlen($string); $i<$k; $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $result .= $char;
        }
        return base64_encode($result);
    }

    public function cc_custom_decrypt($string, $key=15) {
        $result = '';
        $string = base64_decode($string);
        for($i=0,$k=strlen($string); $i< $k ; $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }
        return $result;
    }


    // ONLY FOR DEBUGGING
    public function ll($params) {
        echo '<pre>';
            var_dump($params);
        echo '</pre>';
    }

    private $start_time = NULL;
    private $end_time = NULL;

    private function ll_get_microtime() {
      list($usec, $sec) = explode(" ", microtime());
      return ((float)$usec + (float)$sec);
    }

    public function ll_start() {
      $this->start_time = $this->ll_get_microtime();
    }

    public function ll_stop() {
      $this->end_time = $this->ll_get_microtime();
    }

    public function ll_result() {
        if (is_null($this->start_time))
        {
            exit('Timer: start method not called !');
            return false;
        }
        else if (is_null($this->end_time))
        {
            exit('Timer: stop method not called !');
            return false;
        }

        return [
            'time passed' => round(($this->end_time - $this->start_time), 4),
            'memory used (MB)' => $this->ll_convert_bytes_to_specified(memory_get_usage(), 'M')
        ];
    }

    private function ll_convert_bytes_to_specified($bytes, $to, $decimal_places = 1) {
        $formulas = [
            'K' => number_format($bytes / 1024, $decimal_places),
            'M' => number_format($bytes / 1048576, $decimal_places),
            'G' => number_format($bytes / 1073741824, $decimal_places)
        ];
        return isset($formulas[$to]) ? $formulas[$to] : 0;
    }

}