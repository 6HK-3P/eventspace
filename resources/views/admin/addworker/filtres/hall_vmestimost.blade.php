@if($id>0)
    <?php $addInfo = json_decode($allWorkerInfo->workers_additional_info);?>

    <div class="profile_options_item ">
        <h5>Вместимость (чел.)</h5>
        <div class="flex">
            <label style="width: 49%">
                ОТ <input type="number" name="capacity_start" class="capacity_start" value="{{$addInfo->capacity->start}}" style="max-width: 40%" min=20 step="10">
            </label>
            <label style="width: 49%">
                ДО <input type="number" name="capacity_end" value="{{$addInfo->capacity->end}}" class="capacity_end" style="max-width: 40%" min=30 step="10">
            </label>
        </div>
    </div>

@else

    <div class="profile_options_item ">
       <h5>Вместимость (чел.)</h5>
          <div class="flex">
              <label style="width: 49%">
                  ОТ <input type="number" name="capacity_start" class="capacity_start" style="max-width: 40%" min=20 step="10">
              </label>
              <label style="width: 49%">
                   ДО <input type="number" name="capacity_end"  class="capacity_end" style="max-width: 40%" min=30 step="10">
              </label>
          </div>
   </div>

@endif
