{{Form::open(array('url'=>'allowance','method'=>'post'))}}
{{ Form::hidden('employee_id',$employee->id, array()) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('allowance_option', __('Allowance Options'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('allowance_option',$allowance_options,null, array('class' => 'form-control select','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('title', __('Title'),['class'=>'form-label']) }}
            {{ Form::text('title',null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('type', __('Type'), ['class' => 'form-label']) }}
            {{ Form::select('type', $Allowancetypes, null, ['class' => 'form-control select amount_type', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Amount'),['class'=>'form-label amount_label']) }}
            {{ Form::number('amount',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}
