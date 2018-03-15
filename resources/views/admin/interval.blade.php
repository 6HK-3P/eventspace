@extends('layouts.adhead')
@section('content')

    <main class="container admin-main">
        <section class="artists">
            <h3>Диапазоны для категории - {{\App\Workers_categorie::find($cat)->name}}</h3>
            <h4>Редактировать интервал</h4>
            <form action="/admin/add_interval/{{$cat}}" method="POST">
                {{ csrf_field() }}


            <table class="price_rules cars_table" style="display:block; width:100%;">
                <thead>
                <td>Тип</td>
                <td>Цена от</td>
                <td>Цена до</td>
                </thead>

                    <tr>
                        <td>Разумный выбор</td>
                        <td>0</td>
                        <td><input type="number" data-class="to0" name="to0" value="{{$intervals[0]->to}}"></td>
                    </tr>
                    <tr>
                        <td>Золотая середина</td>
                        <td class="to0">{{$intervals[0]->to}}</td>
                        <td><input type="number" data-class="to1" name="to1" value="{{$intervals[1]->to}}"></td>
                    </tr>
                    <tr>
                        <td>Лучшие из лучших</td>
                        <td class="to1">{{$intervals[1]->to}}</td>
                        <td>∞</td>
                    </tr>

            </table>
                <button type="submit">Сохранить</button>
            </form>
        </section>
    </main>
    <script>
        $(document).ready(function () {
            $("input[type=number]").on("change", function () {
                var className = "."+$(this).data("class");
                var val = $(this).val();
                $(className).html(val);
            })

        })
    </script>
@endsection