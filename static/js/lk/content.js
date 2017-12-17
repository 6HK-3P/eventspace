$(document).ready(function () {
    var api = new Api();
    renderContent(api.getWorkerContent());

    function renderContent(workerContent) {
        var $videoBlock = $('#video_options');
        var $audioBlock = $('#audio_options');
        $videoBlock.empty();
        $audioBlock.empty();
        workerContent.forEach(function (e) {
            var content = getContentHtml(e);
            if (e.type === 'audio') $audioBlock.append(content);
            else $videoBlock.append(content);

            $('.item.img, .remove_video, .remove_audio').unbind('click');
            $('.item.img').click(function () {
                $.ajax("/api/updateWorkerLogo", {
                    type: "POST",
                    data: "id=" + $(this).attr('data-id'),
                    complete: function (response) {
                        response = JSON.parse(response.responseText);

                        if (response['error'] !== null && response['error'] !== undefined) {
                            alert(response.error);
                            return;
                        }
                    }
                });
            });

            $('.remove_video, .remove_audio').click(function (e) {
                e.preventDefault();
                var parent = $(this).closest('.item');
                var id = parent.attr('data-id');

                $.ajax("/api/deleteContent", {
                    type: "POST",
                    data: 'id=' + id,
                    complete: function (response) {
                        var response = JSON.parse(response.responseText);
                        if (response['error'] !== null && response['error'] !== undefined) {
                            alert(response.error);
                            return;
                        }
                        parent.remove();
                    }
                });
                return false;
            });
        });
    }

    $('#add_video').find('form').submit(function (e) {
        e.preventDefault();
        var data = $(this).find('input').val();
        uploadContent("/api/uploadVideo", "video=" + data);
    });

    $('#add_photo').find('form').submit(function (e) {
        e.preventDefault();
        var data = new FormData(this);
        uploadContent("/api/uploadImage", data);
    });

    $('#add_audio').find('form').submit(function (e) {
        e.preventDefault();
        var data = new FormData(this);
        uploadContent("/api/uploadAudio", data);
    });

    function uploadContent (apiMethod, data) {
        $.ajax(apiMethod, {
            type: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            complete: function (response) {
                var response = JSON.parse(response.responseText);
                if (response['error'] !== null && response['error'] !== undefined) {
                    alert(response.error);
                    return;
                }
                renderContent(api.getWorkerContent());
            }
        });
    }

    function getContentHtml(e) {
        if (e.type === 'image') {
            return '<div class="item img" data-id="' + e.id + '">' +
                '<div class="gallery-img" style="background-image: url(' + e.src + ')"></div>' +
                '<input type="submit" class="remove_video" name="remove_video" value=""></div>';
        } else if (e.type === 'audio') {
            var title = e.alt.split('/');
            title = title[title.length - 1].split('.')[0];
            return '<div class="item audio flex" data-id="' + e.id + '">' +
                '<span class="music_title">' + title + '</span>' +
                '<input type="submit" class="remove_audio" name="remove_audio" value=""></div>';
        } else if (e.type === 'video') {
            var videoId = e.src;
            return '<div class="item video" data-id="' + e.id + '">' +
                '<div class="obert"><img src="http://img.youtube.com/vi/' + videoId + '/hqdefault.jpg" width="380" height="210">' +
                '<input type="submit" class="remove_video" name="remove_video" value=""></div>' +
                '<iframe width="380" height="210" src="https://www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe></div>';
        }
    }

    $("#save_changes").on("click", function (e) {
        e.preventDefault();

        var media = {};
        var audio = {};

        $("#video_options").find(".item").each(function (index) {
            media[index] = {};
            media[index].id = $(this).attr("data-id");
            media[index].type = $(this).attr("class").replace("item ", "");
        });

        $("#audio_options").find(".item").each(function (index) {
            audio[index] = {};
            audio[index].id = $(this).attr("data-id");
            audio[index].type = "audio";
        });

        $.ajax({
            url: "/api/updateContentOrder",
            type: "POST",
            data: 'data=' + JSON.stringify({media: media, audio: audio}),
            complete: function (response) {
                console.log(response.responseText);
            }
        });
    });
});