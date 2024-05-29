{{ Form::open(array('url' => 'account-assets')) }}
<div class="modal-body">
    <div class="row">
        <div class="col-12 form-group">
            {{ Form::label('employee_id', __('Employee'),['class'=>'form-label']) }}
            {{ Form::select('employee_id[]', $employee,null, array('class' => 'form-control select2','id'=>'choices-multiple1','multiple')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('name', __('Name'),['class'=>'form-label']) }}
            {{ Form::text('name', '', array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Amount'),['class'=>'form-label']) }}
            {{ Form::number('amount', '', array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('purchase_date', __('Purchase Date'),['class'=>'form-label']) }}
            {{ Form::date('purchase_date','', array('class' => 'form-control ')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('supported_date', __('Supported Date'),['class'=>'form-label']) }}
            {{ Form::date('supported_date','', array('class' => 'form-control ')) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'),['class'=>'form-label']) }}
            {{ Form::textarea('description', '', array('class' => 'form-control','rows'=>3)) }}
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}

