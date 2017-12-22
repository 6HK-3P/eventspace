@extends('layouts.adhead')
@section('content')
<main class="container admin-main">
    <section>
        <h2>Шапка</h2>
        <form action="/admin/head" class="flex" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <div class="cols2">
                <div class="flex">
                    <label>Логотип<br><span>Размер 200 на 100</span></label>
                    <input type="file" name="head8" accept="image/*">
                </div>
                <div class="flex">
                    <label>Номер телефона</label>
                    <input type="text" name="head1">
                </div>
                <div class="flex">
                    <label>Ссылка на ВК</label>
                    <input type="text" name="head2">
                </div>
                <div class="flex">
                    <label>Ссылка на WhatsApp</label>
                    <input type="text" name="head3">
                </div>
                <div class="flex">
                    <label>Ссылка на Instagram</label>
                    <input type="text" name="head4">
                </div>
                <h2>Футер</h2>
                <div class="flex">
                    <label>Текст копирайта</label>
                    <textarea name="head5" cols="32" rows="5"></textarea>
                </div>
            </div>
            <div class="cols2 leftcol">
                <div>
                    <label>Служба поддержки</label><br><br>
                    <textarea name="head6" cols="32" rows="4"></textarea>
                </div>
                <div>
                    <label>Вопросы сотрудничества</label><br><br>
                    <textarea name="head7" cols="32" rows="4"></textarea>
                </div>
                <input type="submit" class="submit" value="Сохранить">
            </div>
        </form>
    </section>

    <section>
        <h2>Тизеры</h2>
        <form action="/admin/add" method="post" id="tizer_form" data-count-tizer="{{count($teasers)}}" enctype="multipart/form-data">
            {{ csrf_field()  }}
            <div id="tizer_container" class="flex wrap">
                @if( count($teasers))
                    @for($i=1; $i< count($teasers)+1; $i++ )
                        <? $j = $i-1; ?>
                    <div class='tizer' id='tizer{{$i}}'>
                        <h5>Tizer{{$i}}</h5>
                        <div class='flex'>
                            <label>Изображение<br><span>Размер 200 на 50</span></label>
                            <input type='file' name='tizer_photo{{$i}}' accept='image\\/*,image/jpeg'></div>
                        <div class='flex'><label>Позиция</label><div class='tizer-pos'><input type='number' name='tizer_pos{{$i}}' value="{{$teasers[$j]->position}}"></div>
                        </div>
                        <div class='flex'><label>Заголовок</label><input type='text' name='tizer_title{{$i}}' value="{{$teasers[$j]->title}}"></div>
                        <div class='flex'><label>Текст</label><textarea name='tizer_text{{$i}}' cols='32' rows='8'>{{$teasers[$j]->text}}</textarea></div>
                        <input type="hidden" name="tizer_id{{$i}}" value="{{$teasers[$j]->id}}"></div>

                    @endfor
                @endif
            </div>
            <div class="tizer-buttons">
                <button class="submit" id="new_tizer">Добавить еще тизер</button>
                <br><br>

                <input type="hidden" id="tizer_form_count" name="tizer_form_count" value="{{count($teasers)}}">
                <input type="submit" class="submit" value="Сохранить">
            </div>

        </form>
    </section>
</main>
<script src="/static/js/functions.js"></script>
<script src="/static/js/admin_main.js"></script>
<script src="/static/js/tabs.js"></script>

@endsection