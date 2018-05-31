<div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')
		
		<textarea id="{{$id}}" name="{{$name}}" style="width:700px;height:200px;visibility:hidden;">{!! old($column, $value) !!}</textarea>
        

    </div>
</div>