<?php $all_categories = \App\Entry::all();?>
@foreach($all_categories as $category)
    @if(in_array($cat, json_decode($category->category_id)))
        <div class="drum__filter-form__item" id="primary_language_chooser">
            <span>{{$category->name}}</span>
            <div class="drum-form-content">

                @foreach($category->type as $attribute)
                    <label>
                        <input type="checkbox" name="attributes[]" @if(in_array($attribute->id, $attributes)) checked @endif value="{{$attribute->id}}">
                        {{$attribute->name}}
                    </label>
                @endforeach

            </div>
        </div>
    @endif
@endforeach