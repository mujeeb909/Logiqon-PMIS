{{ Form::open(array('url' => 'goal')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('name', __('Name'),['class'=>'form-label']) }}
            {{ Form::text('name', '', array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Amount'),['class'=>'form-label']) }}
            {{ Form::number('amount', '', array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('type', __('Type'),['class'=>'form-label']) }}
            {{ Form::select('type',$types,null, array('class' => 'form-control select','required'=>'required')) }}
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('from', __('From'),['class'=>'form-label']) }}
            {{Form::date('from',null,array('class'=>'form-control','required'=>'required'))}}

        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('to', __('To'),['class'=>'form-label']) }}
            {{Form::date('to',null,array('class'=>'form-control','required'=>'required'))}}

        </div>
        <div class="form-group col-md-12">
            <input class="form-check-input" type="checkbox" name="is_display" id="is_display" checked>
            <label class="custom-control-label form-label" for="is_display">{{__('Display On Dashboard')}}</label>

        </div>

    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{ Form::close() }}

