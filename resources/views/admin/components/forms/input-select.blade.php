<div>
    <label for="{{$id}}">{{$label}}</label>
    <select class="custom-select form-control" id="{{$id}}"
            name="{{$id}}">
        @foreach($model as $modelItem)
            <option value="{{$modelItem->id}}">{{$modelItem->{$columnName} }}</option>
        @endforeach
    </select>
</div>
