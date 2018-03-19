<section class="cars tabs-body flex" style="display: none;">
    <div class="add-artist-price " style=" width: 100%;">
        <h4>Добавьте машины</h4>

        <form action="#" id="add_cars" style="min-height: 100px;" name="add_cars" class="add_price_rule" method="POST" >
            <div class="flex">
                {{csrf_field()}}
                <div class="profile_options_item">
                    <h5>Имя автомобиля</h5><input type="text" style="width: 100%" name="name_car">
                </div>
                <div class="profile_options_item">
                    <h5>Марка автомобиля</h5>
                    <?php $cars_marks = \App\Workers_cars_mark::all(); ?>

                    <select style="padding: 12px" name="mark_car">
                        @foreach($cars_marks as $car_mark)
                            <option value="{{$car_mark->id}}">{{$car_mark->title}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="profile_options_item">
                    <h5>Цвет автомобиля</h5>
                    <?php $cars_colors = \App\Workers_cars_color::all(); ?>
                    <select  style="padding: 12px" name="color_car">
                        @foreach($cars_colors as $car_color)
                            <option value="{{$car_color->id}}">{{$car_color->title}}</option>
                        @endforeach
                    </select>

                </div>


                <div class="profile_options_item">
                    <h5>Тип автомобиля</h5>
                    <?php $cars_colors = \App\Workers_cars_type::all(); ?>
                    <select  style="padding: 12px" name="type_car">
                        @foreach($cars_colors as $car_color)
                            <option value="{{$car_color->id}}">{{$car_color->title}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="tizer-buttons flex"  style="height: 68px;margin-top: 48px;padding: 10px 0;box-sizing: border-box;">
                    <input type="submit" class="submit" value="Добавить">
                </div>
            </div>

        </form>
        <div class="">
            <? $all_cars = \App\workers_car::where("worker_id", $id)->get(); $i=1; ?>
            <h4>Ваши автомобили</h4>
            <table class="price_rules cars_table" style="display:block; width:100%;">
                <thead>
                <td>№</td>
                <td>Имя автомобиля</td>
                <td>Марка автомобиля</td>
                <td>Тип автомобиля</td>
                <td>Цвет автомобиля</td>
                <td></td>

                </thead>
                @foreach($all_cars as $car)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$car->name}}</td>
                        <td>{{\App\Workers_cars_mark::find($car->mark_id)->title}}</td>
                        <td>{{\App\Workers_cars_type::find($car->type_id)->title}}</td>
                        <td>{{\App\Workers_cars_color::find($car->color_id)->title}}</td>
                        <td><a href="">x</a></td>
                        <? $i++; ?>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</section>