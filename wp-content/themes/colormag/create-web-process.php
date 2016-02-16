<?php
/**
 * Template Name: Xử lý dữ liệu Tạo Website
 *
 * Copyright hamovn 2016
 * @author Nguyen Dinh Hieu
 */
?>
<?php
if (isset($_POST) && $_POST != null) {
    global $wpdb;
    $_data = array();
    $_postData = $_POST;
    //Generate id
    $_id =  md5(convert_vi_to_en($_postData['send_by'].'-to-'.$_postData['type'].'-'.$_postData['receiver']).'-'.time());
    /**
     * Upload images
     */
    $_arrImages = array();
    if ($_FILES != null) {
        $valid_formats = array("jpg", "png", "gif");
        $max_file_size = 1024*1024*2; //2Mb
        $upload_dir = wp_upload_dir();
        $upload_path = $upload_dir['basedir'];// Uploads directory
        $path = $upload_path.'/'.$_id;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $count = 0;

        // Loop $_FILES to exeicute all files
        foreach ($_FILES['files']['name'] as $f => $name) {
            if ($_FILES['files']['error'][$f] == 4) {
                continue; // Skip file if any error found
            }
            if ($_FILES['files']['error'][$f] == 0) {
                if ($_FILES['files']['size'][$f] > $max_file_size) {
                    $message[] = "$name is too large!.";
                    continue; // Skip large files
                }
                elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
                    $message[] = "$name is not a valid format";
                    continue; // Skip invalid file formats
                }
                else{ // No error found! Move uploaded files
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path. '/' .$name))
                        $_arrImages[] = $_id. '/' .$name;
                        $count++; // Number of successfully uploaded file
                }
            }
        }
    }
    $_background = '';
    if (count($_arrImages) > 0) {
        $_background = serialize($_arrImages);
    }
    /**
     * Store to db
     */

    $table_name = $wpdb->prefix . 'create_website';
    $result = $wpdb->insert(
        $table_name,
        array(
            'id' => $_id,
            'title' => $_postData['title'],
            'message' => $_postData['message'],
            'background' => $_background,
            'music_link' => $_postData['music_link'],
            'video_link' => $_postData['video_link'],
            'type' => strtolower(convert_vi_to_en($_postData['type'])),
            'send_by' => $_postData['send_by'],
            'receiver' => $_postData['receiver']
        ),
        array(
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s'
        )
    );

    if ($result === false || $result === 0) {
        $_data['res'] = 'error';
        $_data['message'] = 'Không tạo được Website, vui lòng thử lại hoặc liên hệ với Admin';
    } else {
        $_data['res'] = 'success';
        $_data['message'] = 'Tạo Website thành công!';
        $_data['url'] = get_home_url().'/gift-website/?id='.$_id;
    }
    echo json_encode($_data);
    return;
} else {
    header('Location: ' . get_home_url().'/tao-website-tang-nguoi-than/');
}



function convert_vi_to_en($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = preg_replace("/ /", '', $str);
    return $str;
}
