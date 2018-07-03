<?php $all_categories = \App\Entry::all();?>
@foreach($all_categories as $category)
        @if(in_array($cat->id, json_decode($category->category_id)) && $cat->id != 6)

            <div class="profile_options_item @if($category->radio == 1) ska @endif">
                @if($category->radio == 1)
                    <span class="ree">
                        Выберите хотя бы один тип
                    </span>
                @endif
                <h5>{{$category->name}}</h5>
                <ul>
                    @foreach($category->type as $attribute)
                        <li>
                            <input
                                    type="checkbox"
                                    id = "attributes{{$attribute->id}}"
                                    name="attributes[]"
                                    @if(isset($allWorkerInfo->attributes) && in_array($attribute->id, json_decode($allWorkerInfo->attributes))) checked @endif
                                    value={{$attribute->id}} class="lang">
                            <label
                                    for="attributes{{$attribute->id}}"
                                    @if(isset($allWorkerInfo->attributes) && in_array($attribute->id, json_decode($allWorkerInfo->attributes))) class="check" @endif >
                                {{$attribute->name}}
                            </label>
                            @if($category->radio == 1)
                                <div>
                                    <input
                                            type="radio"
                                            name="basic_attributes_{{$category->id}}"
                                            value="{{$attribute->id}}"
                                            @if(isset($allWorkerInfo->attributes) && in_array($attribute->id, json_decode($allWorkerInfo->basic_attributes))) checked  @endif
                                            id="basic_attributes{{$attribute->id}}" >
                                    <label
                                            for="basic_attributes{{$attribute->id}}"
                                            class="filter_radio">
                                    </label>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

        @endif
@endforeach