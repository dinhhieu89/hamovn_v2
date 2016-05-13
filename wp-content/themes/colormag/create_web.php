<?php require_once('createweb/lib/functions.php') ?>
<?php
/**
 * Template Name: Tạo Website
 *
 * Copyright hamovn 2016
 * @author Nguyen Dinh Hieu
 */
?>
<?php include_once('createweb/lib/head.php') ?>
    <div id="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div id="wrap-success" style="display: none;">
                    <p>
                        Website của bạn đã được tạo thành công,<br/>
                        Vui lòng bấm <a id="url-review" href="">Vào đây</a> để xem (Copy url bên dưới để gửi cho người thân của bạn).<br/>
                        <a id="url-copy" href=""></a>
                        <br/><br/>
                        <a href="<?php echo get_home_url() ?>">Quay về trang chủ</a>
                    </p>
                </div>
                <form id="create-web-form" action="/create-website-process/" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                    <div class="col-md6">
                        <div class="title-wrap">
                            <h1 class="title"><?php echo "Tạo website tặng người ấy." ?></h1>
                        </div>
                    </div>
                    <div class="col-md6">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="send_by">Tên của bạn:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control required" id="send_by" name="send_by" placeholder="Tên của bạn">
                                <span id="send_by_validate" style="display: none; color: #ff0000">Vui lòng nhập Họ tên của bạn</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="receiver">Tên người ấy:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control required" id="receiver" name="receiver" placeholder="Tên người ấy">
                                <span id="receiver_validate" style="display: none; color: #ff0000">Vui lòng nhập Họ tên người thân</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="type" value="Người yêu" />
<!--                            <label class="control-label col-sm-4" for="type">Mối quan hệ:</label>-->
<!--                            <div class="col-sm-8">-->
<!--                                <select id="type" name="type" class="form-control required">-->
<!--                                    <option value="">Chọn mối quan hệ</option>-->
<!--                                    <option value="Bố">Bố</option>-->
<!--                                    <option value="Mẹ">Mẹ</option>-->
<!--                                    <option value="Vợ">Vợ</option>-->
<!--                                    <option value="Chồng">Chồng</option>-->
<!--                                    <option value="Con">Con</option>-->
<!--                                    <option value="Người yêu">Người yêu</option>-->
<!--                                    <option value="Bạn thân">Bạn thân</option>-->
<!--                                </select>-->
<!--                                <span id="type_validate" style="display: none; color: #ff0000">Vui lòng chọn mối quan hệ</span>-->
<!--                            </div>-->
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="title">Tiêu đề:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control required" id="title" name="title" placeholder="Tiêu đề">
                                <span id="title_validate" style="display: none; color: #ff0000">Vui lòng nhập Tiêu đề</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="message">Lời nhắn:</label>
                            <div class="col-sm-8">
                                <textarea class="form-control required" rows="10" id="message" name="message"></textarea>
                                <span id="message_validate" style="display: none; color: #ff0000">Vui lòng nhập Lời nhắn</span>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="control-label col-sm-4" for="music_link">Nhúng nhạc:</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="music_link" id="music_link" rows="3"></textarea>
                                <a href="javascript:void(0)" onclick="getEmbedAudio()">Cách lấy nội dung nhạc để nhúng</a>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="control-label col-sm-4" for="video_link">Nhúng video:</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="video_link" id="video_link" rows="3"></textarea>
                                <a href="javascript:void(0)" onclick="getEmbedVideo()">Cách lấy nội dung video để nhúng</a>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="file">Hình ảnh:</label>
                            <div class="col-sm-8">
                                <label class="file">
                                    <input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
                                    <span class="file-custom" data-after="Chọn Ảnh..." style="width: 350px;"></span>
                                </label>
                                <br/>
                                <span style="font-size: 12px;">
                                    Kích thước mỗi ảnh tối đa là 2Mb, ảnh lớn hơn sẽ tự động được loại bỏ.
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary btn-create" onclick="return validateForm()">Tạo trang web</button>
                            </div>
                        </div>
                    </div>
                </form>
                <script>
                    CKEDITOR.replace('message');
                    CKEDITOR.replace('music_link');
                    CKEDITOR.replace('video_link');
                    $j = jQuery.noConflict();

                    function validateForm() {
                        CKEDITOR.instances.message.updateElement();
                        var result = true;

                        $j('#create-web-form .required').each(function(){
                            var thisEl = $j(this);
                            var id = thisEl.attr('id');
                            if (thisEl.val() == '') {
                                $j('#'+id+'_validate').show();
                                thisEl.parent().removeClass('has-success');
                                thisEl.parent().addClass('has-danger');
                                result = false;
                            } else {
                                $j('#'+id+'_validate').hide();
                                thisEl.parent().addClass('has-success');
                                thisEl.parent().removeClass('has-danger');
                                result = true;
                            }
                        });
                        if (result) {
                            submitForm($j('#create-web-form'));
                        }
                        return result;
                    }

                    function submitForm(form) {
                        form.ajaxForm({
                            dataType:'json',

                            complete: function(response) {
                                if (response.responseJSON.res == 'error') {
                                    alert (response.responseJSON.message);
                                } else {
                                    $j('#url-copy').attr('href', response.responseJSON.url);
                                    $j('#url-copy').html(response.responseJSON.url);
                                    $j('#url-review').attr('href', response.responseJSON.url);
                                    $j('#wrap-success').show();
                                    form.hide();
                                }
                            }
                        });

//                        var url = form.attr('action');
//                        var data = form.serialize();
//                        $j.ajax({
//                            url: url,
//                            type: 'POST',
//                            data: data,
//                            dataType: 'json',
//                            success: function(response) {
//                                if (response.res == 'error') {
//                                    alert (response.message);
//                                } else {
//                                    $j('#url-copy').html(response.url);
//                                    $j('#url-review').attr('href', response.url);
//                                    $j('#wrap-success').show();
//                                    form.hide();
//                                }
//                            }
//                        });
                        return false;
                    }

                    $j(document).on('change', '#file', function() {
                        var input = $j(this),
                            numFiles = input.get(0).files ? input.get(0).files.length : 1,
                            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                        input.trigger('fileselect', [numFiles, label]);
                    });

                    $j(document).ready( function() {
                        $j('#file').on('fileselect', function(event, numFiles, label) {
                            if (numFiles > 1) {
                                $j('.file-custom').attr('data-after', 'Đã chọn '+numFiles+' ảnh.');
                            } else {
                                $j('.file-custom').attr('data-after', label);
                            }

                        });
                    });

                    function getEmbedAudio() {
                        $j('#guide-audio').show();
                    }

                    function getEmbedVideo() {
                        $j('#guide-video').show();
                    }

//                    $j(document).ready(function() {
//                        $j('#guide-audio').click(function() {
//                            $j(this).hide();
//                        })
//                    });
                </script>
            </div>
        </div>
        <div style="clear: both"></div>
        <div id="guide-audio" style="display: none;">
            <span>Vào trang <a href="http://mp3.zing.vn/" target="_blank">http://mp3.zing.vn/</a> chọn nghe 1 bài hát hoặc 1 album rồi làm theo hướng dẫn.</span><br/>
            <a href="javascript:void(0)" onclick="$j('#guide-audio').hide();" style="font-weight: bold; color: #FFF;">Đóng hướng dẫn</a><br/>
            <img src="<?php echo get_stylesheet_directory_uri() . '/createweb/images/nhung_nhac.png' ?>" />
        </div>
        <div id="guide-video" style="display: none;">
            <span>Vào trang <a href="http://youtube.com/" target="_blank">http://youtube.com/</a> chọn xem 1 video hoặc 1 playlist rồi làm theo hướng dẫn.</span><br/>
            <a href="javascript:void(0)" onclick="$j('#guide-video').hide();" style="font-weight: bold; color: #FFF;">Đóng hướng dẫn</a><br/>
            <img src="<?php echo get_stylesheet_directory_uri() . '/createweb/images/nhung_video.png' ?>" />
        </div>
    </div>
<?php include_once('createweb/lib/footer.php') ?>