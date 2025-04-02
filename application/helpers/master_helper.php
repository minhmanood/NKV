<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('format_date')) {

    function format_date($time = 0) {
        if($time == 0){
            $time = time();
        }

        return date('d-m-Y', $time);
    }

}
if (!function_exists('format_date1')) {

    function format_date1($time = 0) {
        if($time == 0){
            $time = time();
        }

        return date('F j', $time);
    }

}

if (!function_exists('get_start_date')) {

    function get_start_date($str_date) {
        $date = parse_date($str_date) . " 00:00:00";

        return strtotime($date);
    }

}

if (!function_exists('get_end_date')) {

    function get_end_date($str_date) {
        $date = parse_date($str_date) . " 23:59:59";

        return strtotime($date);
    }

}

if (!function_exists('get_current_date')) {

    function get_current_date($str_date) {
        $date = parse_date($str_date) . " " . date('H:i:s');
        return strtotime($date);
    }

}

if (!function_exists('convert_date')) {

    function convert_date($str_date) {
        $dates = explode(" ", $str_date);
        if (isset($dates[0]) && isset($dates[1])) {
            $date = parse_date($dates[1], '/') . " " . $dates[0];
            return strtotime($date);
        }
        return 0;
    }

}

if (!function_exists('parse_date')) {

    function parse_date($str_date, $glue = '-') {
        $dates = explode($glue, $str_date);
        $str_date = $dates[2] . "-" . $dates[1] . "-" . $dates[0];

        return $str_date;
    }

}

if (!function_exists('get_first_last_date')) {

    function get_first_last_date($type = 'month', $time = 0) {
        if($time == 0){
            $time = time();
        }
        switch ($type) {
            case 'week':
                /*
                $first_day = strtotime('monday this week');
                $last_day = strtotime('sunday this week');
                */
                $day = date('w', $time);
                $first_day = strtotime('-' . ($day - 1) . ' days');
                $last_day = strtotime('+' . (7 - $day) . ' days');
                break;
            case 'month':
                $first_day = strtotime(date('Y-m-01', $time));
                $last_day = strtotime(date('Y-m-t', $time));
                break;
            case 'year':
                $first_day = strtotime(date('Y-01-01', $time));
                $last_day = strtotime(date('Y-12-t', $time));
                break;
            default:
                $first_day = 0;
                $last_day = 0;
                break;
        }
        return array(
            'first_day' => $first_day,
            'last_day' => $last_day
        );
    }

}

if (!function_exists('gets_config_value')) {
    function gets_config_value($config_names = null) {
        $ci = &get_instance();
        $rows = $ci->M_configs->gets($config_names);
        return $rows;
    }
}

if (!function_exists('get_config_value')) {
    function get_config_value($config_name = '') {
        $ci = &get_instance();
        $row = $ci->M_configs->get($config_name);
        return isset($row['config_value']) ? $row['config_value'] : '';
    }
}

if (!function_exists('get_commission_user')) {
    function get_commission_user($user_id = 0, $not_in_id = 0) {
        $ci = &get_instance();

        $total_withdrawal = $ci->M_users_commission->get_total(array(
            'user_id' => $user_id,
            'status' => 1,
            'in_action' => array('WITHDRAWAL'),
            'not_in_id' => $not_in_id,
        ));

        $total_commission = $ci->M_users_commission->get_total(array(
            'user_id' => $user_id,
            'status' => 1,
            'in_action' => array('SUB_BUY')
        ));

        $balance = $total_commission - abs($total_withdrawal) ;

        return array(
            'total_withdrawal' => abs($total_withdrawal),
            'total_commission' => abs($total_commission),
            'balance' => abs($balance),
        );
    }
}

if (!function_exists('get_balance_user')) {
    function get_balance_user($user_id = 0, $not_in_id = 0) {
        $data = get_commission_user($user_id, $not_in_id);
        return isset($data['balance']) ? $data['balance'] : 0;
    }
}

if (!function_exists('base64_encode_standardized')) {
    function base64_encode_standardized($str = ''){
        $base_64 = base64_encode($str);
        return rtrim($base_64, '=');
    }
}

if (!function_exists('base64_decode_standardized')) {
    function base64_decode_standardized($str = ''){
        $base_64 = $str . str_repeat('=', strlen($str) % 4);
        return base64_decode($base_64);
    }
}

if (!function_exists('parse_param')) {
    function parse_param($param = '') {
        $data = array();
        $data['user_id'] = 0;
        $data['product_id'] = 0;
        $data['type'] = '';
        if (trim($param) != '') {
            $arr_param = explode('-', base64_decode_standardized($param));
            $user_id = isset($arr_param[0]) ? $arr_param[0] : 0;
            $product_id = isset($arr_param[1]) ? $arr_param[1] : 0;
            $type = isset($arr_param[2]) ? $arr_param[2] : '';

            $data['user_id'] = $user_id;
            $data['product_id'] = $product_id;
            $data['type'] = $type;
        }

        return $data;
    }
}

if (!function_exists('string_to_array')) {

    function string_to_array($str = '', $delimiter = ',') {
        $data = explode($delimiter, $str);

        return $data;
    }

}

if (!function_exists('array_to_string')) {

    function array_to_string($data = array(), $delimiter = ', ') {
        $str = '';
        if (is_array($data) && !empty($data)) {
            $str = implode($delimiter, $data);
        }

        return $str;
    }

}

if (!function_exists('check_username_format')) {
    function check_username_format($username = '') {
        $bool = FALSE;
        $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
        if(preg_match($partten ,$username, $matchs)){
            $bool = TRUE;
        }
        return $bool;
    }
}

if (!function_exists('current_full_url')) {
    function current_full_url() {
        $CI = &get_instance();
        $url = $CI->config->site_url($CI->uri->uri_string());
        return $_SERVER['QUERY_STRING'] ? $url . '?' . $_SERVER['QUERY_STRING'] : $url;
    }
}

if (!function_exists('get_first_element')) {
    function get_first_element($data = '') {
        $str = $data;
        if (is_array($data) && !empty($data)) {
            $str = reset($data);
        }
        return $str;
    }
}

if (!function_exists('get_full_address')) {
    function get_full_address($row = array()) {
        $arr_address = array();
        if (isset($row['place_of_receipt']) && trim($row['place_of_receipt']) != '') {
            $arr_address[] = $row['place_of_receipt'];
        }
        if (isset($row['commune_name']) && trim($row['commune_name']) != '') {
            $arr_address[] = $row['commune_name'];
        }
        if (isset($row['district_name']) && trim($row['district_name']) != '') {
            $arr_address[] = $row['district_name'];
        }
        if (isset($row['province_name']) && trim($row['province_name']) != '') {
            $arr_address[] = $row['province_name'];
        }

        $str = '';
        if (is_array($arr_address) && !empty($arr_address)) {
            $str = implode(', ', $arr_address);
        }

        return $str;
    }
}

/*
 * Importion: This is change page url admin
 */
if (!function_exists('get_admin_url')) {

    function get_admin_url($module_slug = '') {
        $html = '';
        $ci = & get_instance();
        $base_url = $ci->config->item('base_url');
        $html .= $base_url . 'admin';
        if (trim($module_slug) != '') {
            $html .= '/' . $module_slug;
        }

        return $html;
    }

}

if (!function_exists('add_css')) {

    function add_css($names = array()) {
        $html = '';
        $data = array();
        if (is_array($names) && !empty($names)) {
            foreach ($names as $value) {
                $data[] = '<link href="' . get_asset('css_path') . $value . '.css" type="text/css" rel="stylesheet" />';
            }
        }

        if (is_array($data) && !empty($data)) {
            $html = implode("\n\t\t", $data);
        }

        return $html;
    }

}

if (!function_exists('add_js')) {

    function add_js($names = array()) {
        $html = '';
        $data = array();
        if (is_array($names) && !empty($names)) {
            foreach ($names as $value) {
                $data[] = '<script type="text/javascript" src="' . get_asset('js_path') . $value . '.js"></script>';
            }
        }

        if (is_array($data) && !empty($data)) {
            $html = implode("\n\t\t", $data);
        }

        return $html;
    }

}

if (!function_exists('create_folder')) {

    function create_folder($path_folder = 'uploads/', $create_index_file = true) {
        if (!is_dir($path_folder)) {
            mkdir('./' . $path_folder, 0777, TRUE);
            if ($create_index_file) {
                $index_file = 'index.html';
                copy_file('uploads/' . $index_file, $path_folder . '/' . $index_file);
            }
        }
    }

}

if (!function_exists('copy_file')) {

    function copy_file($from_file, $to_file, $delete = false) {
        $file = FCPATH . $from_file;
        $newfile = FCPATH . $to_file;
        copy($file, $newfile);
        if ($delete) {
            @unlink($file);
        }
    }

}

if (!function_exists('active_link')) {

    function activate_menu($controller = '') {
        $CI = get_instance();
        $class = $CI->router->fetch_class(); //tra ve lop chua fuction hien tai
        return ($class == $controller) ? 'active' : '';
    }

}

if (!function_exists('is_home')) {

    function is_home() {
        $ci = & get_instance();
        if ($ci->uri->uri_string() == '') {
            return true;
        }

        return false;
    }

}

if (!function_exists('get_asset')) {

    function get_asset($folder = '') {
        $html = '';
        $ci = & get_instance();
        $base_url = $ci->config->item('base_url');
        $html .= $base_url;
        if (trim($folder) != '') {
            $html .= $ci->config->item($folder);
        }

        return $html;
    }

}

if (!function_exists('get_view_page')) {

    function get_view_page($view_page = '') {
        $data = array(
            'page_grid' => 'Lưới',
            'page_list' => 'Danh sách',
        );
        $html = '';
        if (isset($data[$view_page])) {
            $html .= $data[$view_page];
        }

        return $html;
    }

}

if (!function_exists('validate_file_exists')) {

    function validate_file_exists($file = '') {
        $bool = true;

        if (is_dir($file) || !file_exists(FCPATH . $file)) {
            $bool = false;
        }

        return $bool;
    }

}

if (!function_exists('get_image')) {

    function get_image($path_image = '', $path_default_image = 'uploads/no_image.png') {
        $html = $path_image;

        if (is_dir($path_image) || !file_exists(FCPATH . $path_image)) {
            $html = $path_default_image;
        }

        return base_url($html);
    }

}

if (!function_exists('get_media')) {

    function get_media($module_name = '', $image = '', $default_image = 'no_image.png', $str_format = '') {
        $folder = '';
        $ci = & get_instance();
        $modules_path = $ci->config->item('modules_path');
        if (trim($module_name) != '' && isset($modules_path[$module_name])) {
            $folder = $modules_path[$module_name];
        }
        $src = $image;
        $path_image = $folder . $image;
        if (is_dir($path_image) || !file_exists(FCPATH . $path_image)) {
            $src = $default_image;
        }
        if(trim($str_format) != ''){
            $src = $str_format . '-' . $src;
        }

        $temp_folder = rtrim($folder, '/');
        $temp_arr = explode('/', $temp_folder);
        $temp_arr_count = count($temp_arr);
        if($temp_arr_count > 2){
            unset($temp_arr[0]);
            $module_name = implode('/', $temp_arr);
        }

        return base_url('media' . '/' . $module_name . '/' . $src);
    }

}

if (!function_exists('filter_content')) {

    function filter_content($content = '') {
        $pattern = '(ckeditor\/kcfinder\/upload\/images)';
        return preg_replace($pattern, 'image' , $content);
    }

}

if (!function_exists('get_option_per_page')) {

    function get_option_per_page($option_selected = '') {
        $ci = &get_instance();
        $html = '';
        $data = range($ci->config->item('item', 'admin_list'), $ci->config->item('total', 'admin_list'), $ci->config->item('item', 'admin_list'));
        foreach ($data as $value) {
            $selected = '';
            if ($option_selected == $value) {
                $selected = ' selected="selected"';
            }
            $html .= "<option value='$value' $selected>" . $value . "</option>";
        }

        return $html;
    }

}

if (!function_exists('get_option_select')) {

    function get_option_select($data, $option_selected = '') {
        $html = '';
        foreach ($data as $key => $value) {
            $selected = '';
            if ($option_selected == $key) {
                $selected = ' selected="selected"';
            }
            $html .= "<option value='$key' $selected>" . $value . "</option>";
        }

        return $html;
    }

}

if (!function_exists('display_value_array')) {

    function display_value_array($data, $key = '') {
        $html = '';
        if (isset($data[$key])) {
            $html = $data[$key];
        }

        return $html;
    }

}

if (!function_exists('get_file_name_uploads_path')) {

    function get_file_name_uploads_path($path) {
        $ext = end(explode("/", $path));
        return $ext;
    }

}

if (!function_exists('get_module_path')) {

    function get_module_path($module_name = '') {
        $html = '';
        $ci = & get_instance();
        $modules_path = $ci->config->item('modules_path');
        if (trim($module_name) != '' && isset($modules_path[$module_name])) {
            $html = $modules_path[$module_name];
        }

        return $html;
    }

}

if (!function_exists('get_shops_thumbnais_default_size')) {

    function get_shops_thumbnais_default_size() {
        $html = '';
        $ci = & get_instance();
        $shops_thumbnais_sizes = $ci->config->item('shops_thumbnais_sizes');

        if (is_array($shops_thumbnais_sizes)) {
            $keys = array_keys($shops_thumbnais_sizes);
            if (isset($keys[0])) {
                $html = $keys[0];
            }
        }

        return $html;
    }

}

if (!function_exists('get_shops_thumbnais_sizes')) {

    function get_shops_thumbnais_sizes($key = '185x181') {
        $array = NULL;
        $ci = & get_instance();
        $shops_thumbnais_sizes = $ci->config->item('shops_thumbnais_sizes');
        if (trim($key) != '' && isset($shops_thumbnais_sizes[$key])) {
            $array = $shops_thumbnais_sizes[$key];
        }

        return $array;
    }

}

if (!function_exists('get_posts_thumbnais_sizes')) {

    function get_posts_thumbnais_sizes($key = '185x181') {
        $array = NULL;
        $ci = & get_instance();
        $posts_thumbnais_sizes = $ci->config->item('posts_thumbnais_sizes');
        if (trim($key) != '' && isset($posts_thumbnais_sizes[$key])) {
            $array = $posts_thumbnais_sizes[$key];
        }

        return $array;
    }

}

if (!function_exists('display_label')) {

    function display_label($content = '', $lable_type = 'success') {
        $html = '';
        $html .= "<span class='label label-$lable_type'>$content</span>";

        return $html;
    }

}

if (!function_exists('get_option_gender')) {

    function get_option_gender($option_selected = '') {
        $html = '';
        $ci = & get_instance();
        $ci->config->load('params');
        $genders = $ci->config->item('gender');
        foreach ($genders['data'] as $key => $value) {
            $selected = '';
            if ($option_selected == $key) {
                $selected = ' selected="selected"';
            }
            $html .= "<option value='$key' $selected>" . $value . "</option>";
        }

        return $html;
    }

}

if (!function_exists('get_gender')) {

    function get_gender($gender_key = '') {
        $html = '';
        $ci = & get_instance();
        $ci->config->load('params');
        $genders = $ci->config->item('gender');
        if (isset($genders['data'][$gender_key])) {
            $html .= $genders['data'][$gender_key];
        }

        return $html;
    }

}

if (!function_exists('number_format_en')) {
    /*
     * format number n000 to n,000.00
     */

    function number_format_en($number, $decimals = 2) {
        return number_format($number, $decimals, '.', ',');
    }

}

if (!function_exists('number_format_vi')) {
    /*
     * format number n000 to n.000,00
     */

    function number_format_vi($number, $decimals = 2) {
        return number_format($number, $decimals, ',', '.');
    }

}

if (!function_exists('number_format_normal')) {
    /*
     * format number n000 to n.000.00
     */

    function number_format_normal($number, $decimals = 2) {
        return number_format($number, $decimals, '.', '.');
    }

}

if (!function_exists('format_m_d_Y_strtotime')) {
    /*
     * convert date format m-d-Y or m/d/Y to Y-m-d
     */

    function format_m_d_Y_strtotime($str, $separator = '-') {
        $dates = explode($separator, $str);
        return $dates[2] . '-' . $dates[0] . '-' . $dates[1];
    }

}

if (!function_exists('format_d_m_Y_strtotime')) {
    /*
     * convert date format d-m-Y or d/m/Y to Y-m-d
     */

    function format_d_m_Y_strtotime($str, $separator = '-') {
        $dates = explode($separator, $str);
        return $dates[2] . '-' . $dates[1] . '-' . $dates[0];
    }

}

if (!function_exists('get_tag')) {

    function get_tag($tag, $xml) {
        preg_match_all('/<' . $tag . '>(.*)<\/' . $tag . '>$/imU', $xml, $match);
        return $match[1];
    }

}

if (!function_exists('get_rand_string')) {

    function get_rand_string($length = 11) {
        $str = '';
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }

}

if (!function_exists('is_bot')) {

    function is_bot() {
        /* This function will check whether the visitor is a search engine robot */

        $botlist = array("Teoma", "alexa", "froogle", "Gigabot", "inktomi",
            "looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory",
            "Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot",
            "crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp",
            "msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz",
            "Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot",
            "Mediapartners-Google", "Sogou web spider", "WebAlta Crawler", "TweetmemeBot",
            "Butterfly", "Twitturls", "Me.dium", "Twiceler");

        foreach ($botlist as $bot) {
            if (strpos($_SERVER['HTTP_USER_AGENT'], $bot) !== false)
                return true; // Is a bot
        }

        return false; // Not a bot
    }

}

if (!function_exists('str_remove_unicode_space')) {

    function str_remove_unicode_space($str = '', $removeSpace = false) {
        $result = "";

//Loại bỏ dấu tiếng việt
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }

//Xóa khoảng trắng
        if ($removeSpace == true) {
            $arr = explode(" ", $str);
            foreach ($arr as $k => $v) {
                $result .= $v;
            }
        } else {
            $result = $str;
        }

        return $result;
    }

}


if (!function_exists('str_standardize')) {

    function str_standardize($str = '') {
        $str = trim($str); // xóa tất cả các khoảng trắng còn thừa ở đầu và cuối chuỗi
        $str = preg_replace('/\s(?=\s)/', '', $str); // Thay thế nhiều khoảng trắng liên tiếp nhau trong chuỗi = 1 khoảng trắng duy nhất
        $str = preg_replace('/[\n\r\t]/', ' ', $str); // Thay thế những kí tự đặc biệt: xuống dòng, tab = khoảng trắng

        return $str;
    }

}

if (!function_exists('replace_special_url')) {

    function replace_special_url($str = '') {
        $pattern = '/[^\w\d\s]/';
//$str = str_remove_unicode_space($str);
        $str = preg_replace($pattern, "-", $str);
        $str = str_replace(" ", "-", $str);
        $str = preg_replace('/\-(?=\-)/', '', $str);

        return $str;
    }

}

if (!function_exists('show_alert_success')) {

    function show_alert_success($str = '') {
        $html = '';
        if (trim($str) != '') {
            $html .= '
              <div class="alert alert-dismissable alert-success">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <strong>' . $str . '</strong>
              </div>';
        }
        return $html;
    }

}

if (!function_exists('show_alert_danger')) {

    function show_alert_danger($str = '') {
        $html = '';
        if (trim($str) != '') {
            $html .= '
              <div class="alert alert-dismissable alert-danger">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <strong>' . $str . '</strong>
              </div>';
        }
        return $html;
    }

}

if (!function_exists('show_alert_warning')) {

    function show_alert_warning($str = '') {
        $html = '';
        if (trim($str) != '') {
            $html .= '
              <div class="alert alert-dismissable alert-warning">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <h4>' . $str . '</h4>
              </div>';
        }
        return $html;
    }

}

if (!function_exists('display_date')) {

    function display_date($timestamp = 0, $full = FALSE) {
        $html = '';
        if($full){
            $html .= date('H:i:s d/m/Y', $timestamp);
        }else{
            $html .= date('H:i d/m/Y', $timestamp);
        }

        return $html;
    }

}

if (!function_exists('get_day_of_week_vi')) {

    function get_day_of_week_vi($strtotime = 0) {
        $day = date('w', $strtotime);
        switch ($day) {
            case 0:
                $thu = "Chủ nhật";
                break;
            case 1:
                $thu = "Thứ hai";
                break;
            case 2:
                $thu = "Thứ ba";
                break;
            case 3:
                $thu = "Thứ tư";
                break;
            case 4:
                $thu = "Thứ năm";
                break;
            case 5:
                $thu = "Thứ sáu";
                break;
            case 6:
                $thu = "Thứ bảy";
                break;
            default: $thu = "";
                break;
        }
        return $thu;
    }

}

if (!function_exists('php_truncate')) {

    function php_truncate($text, $length) {
        $length = abs((int) $length);
        if (mb_strlen($text, 'UTF-8') > $length) {
            $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
        }
        return($text);
    }

}

if (!function_exists('formatRiceVND')) {

    function formatRiceVND($price = 0) {
        $symbol = ' VND';
        $symbol_thousand = '.';
        $decimal_place = 0;
        $number = number_format($price, $decimal_place, '', $symbol_thousand);
        return $number . $symbol;
    }

}

if (!function_exists('formatRice')) {

    function formatRice($price = 0) {
        $symbol_thousand = '.';
        $decimal_place = 0;
        $number = number_format($price, $decimal_place, '', $symbol_thousand);
        return $number;
    }

}

if (!function_exists('alias')) {

    function alias($str = '', $removeSpace = false) {
        $result = "";

//Loại bỏ dấu tiếng việt
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }

//Xóa khoảng trắng
        if ($removeSpace == true) {
            $arr = explode(" ", $str);
            foreach ($arr as $k => $v)
                $result .= $v;
        } else {
            $result = $str;
        }

        $pattern = '/[^\w\d\s]/';
        $str = $result;
        $str = preg_replace($pattern, "-", $str);
        $result = str_replace(" ", "-", $str);

//$str = str_only_character($str);
//return $str;


        $character = '-';
        $str = $result;
        $result = '';

        $arr_Temps = explode($character, $str);
        foreach ($arr_Temps as $key => $value) {
            if ($value == '') {
                unset($arr_Temps[$key]);
            }
        }

        $end = count($arr_Temps) - 1;
        $i = 0;

        foreach ($arr_Temps as $key => $value) {
            if ($value != '') {
                $result .= $value;
                if ($i != $end) {
                    $result .= $character;
                }
            }
            $i++;
        }

        return $result;
    }

}

if (!function_exists('get_product_discounts')) {

    function get_product_discounts($product_price = 0, $product_sales_price = 0) {
        return ($product_sales_price > 0 ? $product_sales_price : $product_price);
    }

}

if (!function_exists('get_promotion_price')) {

	function get_promotion_price($product_price = 0, $product_promotion_price = 0) {
		if($product_promotion_price > 0 && $product_promotion_price < $product_price){
			$price = $product_promotion_price;
		}else{
			$price = $product_price;
		}
		return $price;
	}

}

if (!function_exists('get_promotion_price_F0')) {

    function get_promotion_price_F0($product_price = 0, $F0 = 0) {
        return $product_price - $F0;
    }

}

if (!function_exists('convert_to_lowercase')) {
	function convert_to_lowercase($word = '') {
		return mb_strtolower($word, 'UTF-8');
	}
}

if (!function_exists('convert_to_uppercase')) {
	function convert_to_uppercase($word = '') {
		return mb_strtoupper($word, 'UTF-8');
	}
}

if (!function_exists('display_option_select')) {

    function display_option_select($data, $option_value = 'id', $option_name = 'name', $option_selected = 0) {
        $html = '';

        if (is_array($data) && !empty($data)) {
            foreach ($data as $value) {
                $selected = '';
                if (is_array($option_selected) && in_array($value[$option_value], $option_selected)) {
                    $selected = ' selected="selected"';
                } elseif ($value[$option_value] == $option_selected) {
                    $selected = ' selected="selected"';
                }
                $html .= "\n";
                $html .= '<option' . $selected . ' value="' . $value[$option_value] . '"' . '>' . $value[$option_name] . '</option>';
            }
        }

        return $html;
    }

}

function parse_id_cart($str_id = '', $all = false) {
    $str = explode('_', $str_id);
    if ($all) {
        $data = array();
        $data['product_id'] = isset($str[0]) ? (int) $str[0] : 0;
        $data['unit_id'] = isset($str[1]) ? (int) $str[1] : 0;
    } else {
        $data = 0;
        if (isset($str[0])) {
            $data = (int) $str[0];
        }
    }

    return $data;
}

//Lê Văn Nhàn
/* End of file master_helper.php */
/* Location: ./application/helpers/master_helper.php */
