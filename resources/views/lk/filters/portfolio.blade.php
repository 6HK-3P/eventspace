<section class="portfolio tabs-body flex" style="display: none;">

    <aside class="filter col30">
        <h4>Добавление</h4>
        <div class="filter_wrap">
            <div class="ava">
                <h5>Аватарка</h5>
                @if(empty($allWorkerInfo->ava))
                    <img src="/public/img/profile.svg" alt="" width="100%">
                @else
                    <img src="{{$allWorkerInfo->ava}}"  alt="" width="100%">
                @endif
            </div>
            <div id="add_video">
                <h5>Видео</h5>
                <form action="/admin/workers/addvideo/{{\Illuminate\Support\Facades\Auth::user()->worker->category_id}}/{{\Illuminate\Support\Facades\Auth::user()->worker->id}}/1" enctype="multipart/form-data" class="media" method="POST">
                    {{ csrf_field() }}
                    <input type="text" required name="video_src" placeholder="Вставьте ссылку (youtube, vimeo)">
                    <input type="submit" name="new_media" value="Добавить">
                </form>
            </div>

            <div id="add_photo">
                <h5>Фото</h5>
                <div class="flex start">
                    <form action="/admin/workers/addlogo/{{\Illuminate\Support\Facades\Auth::user()->worker->category_id}}/{{\Illuminate\Support\Facades\Auth::user()->worker->id}}/1" enctype="multipart/form-data" class="media" method="POST">
                        {{ csrf_field() }}
                        <input type="file" name="add_foto[]" required class="w100" multiple accept="image/*,image/jpeg">
                        <input type="submit" name="new_media" class="w100" value="Загрузить">
                    </form>
                </div>
            </div>

            <div id="add_audio">
                <form action="/admin/workers/addaudio/{{\Illuminate\Support\Facades\Auth::user()->worker->category_id}}/{{\Illuminate\Support\Facades\Auth::user()->worker->id}}/1" enctype="multipart/form-data" class="audio" method="POST">
                    {{ csrf_field() }}
                    <h5>Аудио </h5>
                    <input type="file" required name="add_audio[]" class="w100" multiple accept="mp3">
                    <label class="w100"><span>только mp3</span></label>
                    <input type="submit" name="new_audio" class="w100" value="Загрузить">
                </form>
            </div>
        </div>
    </aside>

    <div class="add-artist-portfolio col70">
        <h4>Редактирование</h4>
        <form action="#" enctype="multipart/form-data" name="media" class="media">

            <h5>Настройки галереи</h5>
            <div id = "video_options" class="flex wrap video_options">
                @if(!empty($allWorkerInfo->logo))
                    <?  $LogoInfo = json_decode($allWorkerInfo->logo); $i = 1;?>

                    @foreach($LogoInfo as $LogoInfos)

                        @if($LogoInfos->type=="photo")

                            <div class="item img"  data-type="{{$LogoInfos->type}}" data-src="{{$LogoInfos->src}}">
                                <div class="gallery-img" style="background-image: url({{$LogoInfos->src}})"></div>
                                @if($LogoInfos->src == $allWorkerInfo->ava)
                                    <div class="avaImg">Аватарка</div>
                                @else
                                    <div class="imgAva">Сделать аватаркой</div>
                                @endif
                                <input type="submit" class="remove_video"  name="remove_video" value="">
                            </div>



                        @else
                            <div class="item video"  data-type="{{$LogoInfos->type}}" data-src="{{$LogoInfos->src}}" data-poster="{{$LogoInfos->poster}}">
                                <div class="video_wrap"></div>
                                <div class="obert">
                                    <img src="{{$LogoInfos->poster}}" width="380" height="210">
                                    <input type="submit" class="remove_video"  name="remove_video" value="">
                                </div>
                                <iframe width="380" height="210" src="{{$LogoInfos->src}}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        @endif
                        <? $i++; ?>
                    @endforeach
                @endif
            </div>
        </form>

        <form action="#" enctype="multipart/form-data" name="audio" class="media">
            <h5>Настройки аудио</h5>
            <div id = "audio_options" class="flex wrap audio_options">
                @if($allWorkerInfo->audio)
                    <? $allAudios = json_decode($allWorkerInfo->audio) ?>
                    @foreach($allAudios as $Audios)
                        <div class="item audio flex" data-name="{{$Audios->name}}" data-link="{{$Audios->link}}">
                            <span class="music_title">{{$Audios->name}}</span>
                            <input type="submit" class="remove_audio"  name="remove_audio" value="">
                        </div>
                    @endforeach
                @endif
            </div>
        </form>

        <div class="tizer-buttons">
            <input type="submit" class="submit" id="save_changes" value="Сохранить порядок">
        </div>
    </div>
</section>