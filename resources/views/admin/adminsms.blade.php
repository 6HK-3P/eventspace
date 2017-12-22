@extends('layouts.adhead')
@section('content')
<main class="container admin-main">
    <section>
        <h2>Настройка смс</h2>
        <form action="#" enctype="multipart/form-data">
            <div>
                <h4>1. После нажатия пользователем на кнопку <b>"Забронировать"</b></h4>
                <div class="flex">
                    <div id="p1">
                        <label for="">Пользователь</label>

                        <textarea cols="30" rows="10">

						</textarea>
                        <div style="max-width: 300px;"></div>
                    </div>
                    <div id="p2">
                        <label for="">Исполнитель</label>
                        <textarea cols="30" rows="10">


						</textarea>
                        <div style="max-width: 300px;"></div>
                    </div>
                    <div id="p3">
                        <label for="">Менеджер</label>
                        <textarea cols="30" rows="10">

						</textarea>
                        <div style="max-width: 300px;"></div>
                    </div>
                </div>

            </div>
            <hr>
            <div>
                <h4>2. После нажатия администратором на кнопку <b>"Разрешить оплату"</b></h4>
                <div id="p4">
                    <label>Пользователь</label> <br>
                    <textarea cols="30" rows="10">   </textarea>
                    <br>
                    <div style="max-width: 300px;"></div>
                </div>
            </div>
            <hr>
            <div>
                <h4>3. После внесения предоплаты пользователем</h4>
                <div class="flex">
                    <div id="p5">
                        <label for="">Пользователь</label>
                        <textarea cols="30" rows="10"></textarea>
                        <div style="max-width: 300px;"></div>
                    </div>
                    <div id="p6">
                        <label for="">Исполнитель</label>
                        <textarea cols="30" rows="10"> </textarea>
                        <div style="max-width: 300px;"></div>
                    </div>
                    <div id="p7">
                        <label for="">Менеджер</label>
                        <textarea cols="30" rows="10">  </textarea>
                        <div style="max-width: 300px;"></div>
                    </div>
                </div>

            </div>

            <input type="submit" class="submit" value="Сохранить">
        </form>
    </section>
</main>
<script src="/static/js/admin/sms.js"></script>
    @endsection