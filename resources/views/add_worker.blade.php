@extends('layouts.adhead')
@section('content')


<main class="container admin-main">
    <section class="add-artist">
        <div class="flex start tabs-cont">
            <div id="info" class="tabs active"><span>Информация</span></div>
            <div id="price" class="tabs"><span>Ценообразование</span></div>
            <div id="portfolio" class="tabs"><span>Портфолио</span></div>
        </div>
        <section class="info tabs-body" style="display: block;">
            <form action="/admin/workers/add/{{$cat->id}}/{{$id}}" enctype="multipart/form-data" class="options flex" method="POST">
                {{csrf_field()}}
                <aside class="filter col30">
                    <h4>Настройки профиля</h4>
                    <div class="filter_wrap media">
                        <div id="profile_options">
                            <div class="profile_options_item">

                                <h5>Основной город</h5>
                                @if($id>0)
                                    <select name="basic_city">

                                        @foreach($allcities as $cities)
                                            <option value={{$cities->id}} @if($allWorkerInfo->city_id == $cities->id) selected @endif>{{$cities->title}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="basic_city">
                                        @foreach($allcities as $cities)
                                            <option value={{$cities->id}}>{{$cities->title}}</option>
                                        @endforeach
                                    </select>

                                @endif

                            </div>
                            @include('admin.addworker.filtres.repertoire')
                            @include('admin.addworker.filtres.language')

                            <div class="profile_options_item">
                                <h5>Менеджер</h5>
                                @if($id>0)
                                    <select name="filter_admin_artist">
                                        @foreach($managers as $manager)
                                            <option value="{{$manager->id}}" @if($allWorkerInfo->manager_id == $manager->id) selected @endif>{{$manager->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="filter_admin_artist">
                                        @foreach($managers as $manager)
                                            <option value="{{$manager->id}}">{{$manager->name}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="profile_options_item">
                                <h5>Короткая ссылка</h5>
                                <span>eventspace.ru/</span><input type="text" name="filter_shortlink_artist" id="filter_shortlink_artist" maxlength="15">
                            </div>
                        </div>
                    </div>
                </aside>

                <div class="add-artist-info col70 ">
                    <div class="information">
                        <h4>Информация</h4>
                        <div class="flex">
                            <label>Название</label>
                            <input type="text" name="add_title" class="add_title" @if($id !=0) value="{{$allWorkerInfo->user->name}}"@endif>
                        </div>
                        <div class="flex">
                            <label>Описание</label>

                            <textarea name="add_description" id="add_description"  class="add_description" cols="80" rows="7">@if($id !=0){{$allWorkerInfo->about}}@endif</textarea>

                        </div>
                    </div>

                    <div class="autoriz">
                        <h4>Параметры авторизации</h4>
                        <div class="flex wrap">
                            <div><p>Логин (Номер телефона)</p><input type="text" name="login"  class = "contact-tel"  placeholder="+7 988-888-22-22" @if($id !=0) value="{{$allWorkerInfo->user->phone}}"@endif></div>
                            <div><p>Пароль</p><input type="password" maxlength="12" id="password" class="password" name="password"></div>
                            <div><p>Повторите пароль</p><input type="password" maxlength="12" class="password_copy" id="password_copy" name="password_copy"></div>
                        </div>

                    </div>

                    <div id="contacts_peoples" class="flex wrap">

                            @if($id !=0)

                            <?php  $g=1; $contacts = json_decode($allWorkerInfo->worker_contacts); ?>
                                @foreach($contacts as $contact)
                                    <div class="contact_people" >
                                        <h4>Номер телефона для заказа</h4>

                                        <div><span>Имя</span><input type="text" name="contact-name{{$g}}" maxlength="20"  value="{{$contact->name}}" class="contact-name" ></div>
                                        <div><span>Телефон</span><input type="text" name="contact-tel{{$g}}" class = "contact-tel telephone" value = "{{$contact->phone}}" placeholder="+7 988-888-22-22"></div>
                                    </div>
                                    <? $g++?>

                                @endforeach
                                @if($g<3)
                                    <div class="contact_people"> <a href="#" class="add_new_contact" data-count=1>Добавить дополнительный контакт</a></div>
                                @endif
                            @else
                            <div class="contact_people" >
                                <h4>Номер телефона для заказа</h4>
                                <div><span>Имя</span><input type="text" name="contact-name1" maxlength="20"  value="" class="contact-name"></div>
                                <div><span>Телефон</span><input type="text" name="contact-tel1" class = "contact-tel telephone" value = '' placeholder="+7 988-888-22-22"></div>
                            <div class="contact_people"> <a href="#" class="add_new_contact" data-count=1>Добавить дополнительный контакт</a></div>
                            </div>
                            @endif


                        </div>
                        <div id="comment_artist">
                            <h4>Пожелания менеджеру</h4>
                            <h6>(Хотите сообщить что то менеджеру?)</h6>
                            <textarea name="filter_comments_artist" id="" cols="30" rows="5">@if($id !=0){{$allWorkerInfo->manager_comment}}@endif</textarea>
                        </div>


                    <div class="tizer-buttons flex">
                        <input class="submit" type="reset" id="cancel" value = "Отменить изменения">
                        <input type="submit" class="submit" value="Сохранить изменения">
                    </div>

                </div>
            </form>
        </section>
        <section class="price tabs-body flex" style="display: none;">
            <aside class="filter col30">
                <form action="#" id="rule" name="add_price_rule" class="add_price_rule cat{{$cat->id}}" method="POST">
                    {{ csrf_field() }}
                    <h4>Добавление цен</h4>
                    <div class="filter_wrap media price_option">
                        <p class="instruction1">Инструкция</p>
                        <p class="instruction2">Скрыть</p>
                        <p class="desc_interval">Например, Вы хотите указать, что с 1 по 10 января стоимость вашего выступления за вечер в городах Махачкала, Каспийск - 30 000р. <br>Вам следует: <br>
                            1. Выбрать <b>города</b>: Махачкала, Каспийск.<br>
                            2. Выбрать <b>временной интервал по дням</b> с 1 января по 10 января.<br>
                            3. Выбрать <b>услугу</b> "Выступление на весь день" и указать <b>цену</b> и <b>залог</b></p>
                        <h5>Добавить цены</h5>
                        <span class="desc_h5">на услуги в разных <b>городах</b> с учетом <b>сезонности</b></span>
                        <div id="add_city" >
							<span class="ree">
								Выберите хотя бы один тип
							</span>
                            <h6>Выберите города с одинаковой ценой</h6>
                            <? $k = 1; ?>
                            @foreach($allcities as $cities)

                            <div><input type="checkbox" id="city{{$k}}" name="city[]" class="city" value="{{$cities->id}}">
                                <label for="city{{$k}}">{{$cities->title}}</label></div>
                                <? $k++; ?>
                            @endforeach
                            <span class="checkAll" data-id = "add_city">Отметить все</span>
                            <span class="unCheckAll" data-id = "add_city">Cнять все</span>
                        </div>
                        <div id="add_interval">
                            <h6>Выберите временной интервал</h6>
                            <div class="flex">
                                <span class="titles active" id="months">По месяцам</span>
                                <span class="titles" id="calendarWrap">По дням</span>
                            </div>
                            <div class="months  titlebody">
								<span class="ree">
									Выберите хотя бы один тип
								</span>
                                <div class="flex wrap">
                                    <div><input type="checkbox" id="month1" value="1" class="month" name="month[]">
                                        <label for="month1">Январь</label></div>
                                    <div><input type="checkbox" id="month7" name="month[]" class="month" value="7">
                                        <label for="month7">Июль</label></div>
                                    <div><input type="checkbox" id="month2" name="month[]" class="month" value="2">
                                        <label for="month2">Февраль</label></div>
                                    <div><input type="checkbox" id="month8" name="month[]" class="month" value="8">
                                        <label for="month8">Август</label></div>
                                    <div><input type="checkbox" id="month3" name="month[]" class="month" value="3">
                                        <label for="month3">Март</label></div>
                                    <div><input type="checkbox" id="month9" name="month[]" class="month" value="9">
                                        <label for="month9">Сентябрь</label></div>
                                    <div><input type="checkbox" id="month4" name="month[]" class="month" value="4">
                                        <label for="month4">Апрель</label></div>
                                    <div><input type="checkbox" id="month10" name="month[]" class="month" value="10">
                                        <label for="month10">Октябрь</label></div>
                                    <div><input type="checkbox" id="month5" name="month[]" class="month" value="5">
                                        <label for="month5">Май</label></div>
                                    <div><input type="checkbox" id="month11" name="month[]" class="month" value="11">
                                        <label for="month11">Ноябрь</label></div>
                                    <div><input type="checkbox" id="month6" name="month[]" class="month" value="6">
                                        <label for="month6">Июнь</label></div>
                                    <div><input type="checkbox" id="month12" name="month[]" class="month" value="12">
                                        <label for="month12">Декабрь</label></div>

                                </div>
                                <span class="checkAll" data-id = "add_interval">Отметить все</span>
                                <span class="unCheckAll" data-id = "add_interval">Cнять все</span>
                            </div>
                            <div class="calendarWrap titlebody">
								<span class="desc_days">
								Выбрать диапазон дней
								</span>
                                <div class="flex start"><label>С </label><input type="date" class="day_start" name="start_date"></div>
                                <div class="flex start"><label>По</label> <input type="date" class="day_end" name="end_date"></div>
                            </div>
                        </div>
                        <div id="add_type">
                            <h6>Выберете услуги и укажите цены</h6>
                            <div class="services_wrap">
							<span class="ree">
									Выберите хотя бы один тип
							</span>
                                <div>
                                    <input type="checkbox" id="type_3" class="types" name="type_3" value="3">
                                    <label for="type_3">Выступление весь  день </label>
                                </div>
                                <div class="prices service_type_3">
                                    <div class="flex">
                                        <div><label for="">Цена</label><input type="text" name="price_type_3"></div>
                                        <div><label for="">Залог</label><input type="text" name="zalog_type_3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="services_wrap">
                                <div>
                                    <input type="checkbox" id="type_2" class="types" name="type_2" value="2">
                                    <label for="type_2">Выступление 2 часа</label>
                                </div>
                                <div class="prices service_type_2">
                                    <div class="flex">
                                        <div><label for="">Цена</label><input type="text" name="price_type_2"></div>
                                        <div><label for="">Залог</label><input type="text" name="zalog_type_2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="services_wrap last-child">
                                <div>
                                    <input type="checkbox" id="type_1" class="types" name="type_1" value="1">
                                    <label for="type_1">Выступление 1 час</label>
                                </div>
                                <div class="prices service_type_1">
                                    <div class="flex">
                                        <div><label for="">Цена</label><input type="text" name="price_type_1"></div>
                                        <div><label for="">Залог</label><input type="text" name="zalog_type_1"></div>
                                    </div>
                                </div>
                            </div>
                            <span class="checkAll" data-id = "add_type">Отметить все</span>
                            <span class="unCheckAll" data-id = "add_type">Cнять все</span>
                        </div>
                        <input type="submit" value="Добавить" class="w100">
                    </div>
                </form>
            </aside>
            <div class="add-artist-price col70">
                <h4>Ценовые правила</h4>
                <form action="#" id="updatePrice" class="cat{{$cat->id}} loader" name="price_rules_edit" method="POST">
                    <div class="price_rules_edit_wrap">
                        {{csrf_field()}}
                        <table class="price_rules">
                            <thead>
                            <td>№</td>
                            <td>Вид</td>
                            <td>Города</td>
                            <td>Даты</td>
                            <td>Цена</td>
                            <td>Залог</td>
                            <td></td>
                            </thead>
                            <tbody class="price_rules_body">


                            </tbody>
                        </table>



                    </div>

                    <div class="tizer-buttons flex">
                        <input type="reset" id="cancel" value="Отменить изменение цен">
                        <input type="submit" class="submit" value="Сохранить цены">
                    </div>
                </form>
            </div>
        </section>

        <section class="portfolio tabs-body flex" style="display: none;">

            <aside class="filter col30">
                <h4>Добавление</h4>
                <div class="filter_wrap">
                    <div id="add_video">
                        <h5>Видео</h5>
                        <form action="/admin/workers/addvideo/{{$cat->id}}/{{$id}}" enctype="multipart/form-data" class="media" method="POST">
                            {{ csrf_field() }}
                            <input type="text" required name="video_src" placeholder="Вставьте ссылку (youtube, vimeo)">
                            <input type="submit" name="new_media" value="Добавить">
                        </form>
                    </div>

                    <div id="add_photo">
                        <h5>Фото</h5>
                        <div class="flex start">
                            <form action="/admin/workers/addlogo/{{$cat->id}}/{{$id}}" enctype="multipart/form-data" class="media" method="POST">
                                {{ csrf_field() }}
                                <input type="file" name="add_foto[]" required class="w100" multiple accept="image/*,image/jpeg">
                                <input type="submit" name="new_media" class="w100" value="Загрузить">
                            </form>
                        </div>
                    </div>

                    <div id="add_audio">
                        <form action="/admin/workers/addaudio/{{$cat->id}}/{{$id}}" enctype="multipart/form-data" class="audio" method="POST">
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
                                    <div class="item img" data-itemId={{$i}}>
                                        <div class="gallery-img" style="background-image: url({{$LogoInfos->src}})"></div>
                                        <input type="submit" class="remove_video"  name="remove_video" value="">
                                    </div>
                                @else
                                    <div class="item video" data-itemId=3>
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
                        <? $allAudios = json_decode($allWorkerInfo->audio) ?>
                            @foreach($allAudios as $Audios)
                                <div class="item audio flex" data-itemId=1>
                                    <span class="music_title">{{$Audios->name}}</span>
                                    <input type="submit" class="remove_audio"  name="remove_audio" value="">
                                </div>
                            @endforeach
                    </div>
                </form>

                <div class="tizer-buttons">
                    <input type="submit" class="submit" id="save_changes" value="Сохранить порядок">
                </div>
            </div>
        </section>
        <script src="/public/js/add_artist.js"></script>
    </section>
</main>
@endsection