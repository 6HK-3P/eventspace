<section class="info tabs-body" style="display: none;">
    <form action="/lk/add_worker/{{\Illuminate\Support\Facades\Auth::user()->worker->category_id}}/{{\Illuminate\Support\Facades\Auth::user()->worker->id}}" enctype="multipart/form-data" class="options flex" method="POST">
        {{csrf_field()}}
        <aside class="filter col30">
            <h4>Настройки профиля</h4>
            <div class="filter_wrap media">
                <div id="profile_options">
                    <div class="profile_options_item">

                        <h5>Основной город</h5>
                        <select name="basic_city">
                            @foreach($allcities as $cities)
                                <option value={{$cities->id}} @if($allWorkerInfo->city_id == $cities->id) selected @endif>{{$cities->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    @if(\Illuminate\Support\Facades\Auth::user()->worker->category_id == 5) @include('admin.addworker.filtres.conferance') @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->worker->category_id == 4) @include('admin.addworker.filtres.repertoire') @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->worker->category_id== 4 || $cat->id == 5) @include('admin.addworker.filtres.language') @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->worker->category_id == 3) @include('admin.addworker.filtres.hall_vmestimost') @endif
                    <div class="profile_options_item">
                        <h5>Менеджер</h5>
                        <select name="filter_admin_artist">
                            @foreach($managers as $manager)
                                <option value="{{$manager->id}}" @if($allWorkerInfo->manager_id == $manager->id) selected @endif>{{$manager->name}}</option>
                            @endforeach
                        </select>
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
                    <input type="text" name="add_title" class="add_title"  @if($id !=0) value="{{$allWorkerInfo->user->name}}"@endif>
                </div>
                <div class="flex">
                    <label>Описание</label>
                    <textarea name="add_description" id="add_description"  class="add_description" cols="80" rows="7">@if($id !=0){{$allWorkerInfo->about}}@endif</textarea>
                </div>
            </div>

            <div class="autoriz lk">
                <h4>Сменить пароль</h4>
                <div class="flex wrap">
                    <div><p>Старый пароль</p><input type="password" maxlength="12" id="password" class="password" name="password_old"></div>
                    <div><p>Новый пароль</p><input type="password" maxlength="12" id="password_new" class="password" name="password_new"></div>
                    <div><p>Повторите новый пароль</p><input type="password" maxlength="12" class="password_copy" id="password_copy" name="password_copy"></div>
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
                <div id="comment_artist">
                    <h4>Пожелания менеджеру</h4>
                    <h6>(Хотите сообщить что то менеджеру?)</h6>
                    <textarea name="filter_comments_artist" id="" cols="30" rows="5">@if($id !=0){{$allWorkerInfo->manager_comment}}@endif</textarea>
                </div>
            </div>

            <div class="tizer-buttons flex">
                <input class="submit" type="reset" id="cancel" value = "Отменить изменения">
                <input type="submit" class="submit" value="Сохранить изменения">
            </div>
        </div>
    </form>
</section>