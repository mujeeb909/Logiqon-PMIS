{{Form::model($termination,array('route' => array('termination.update', $termination->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group  col-lg-6 col-md-6">
            {{ Form::label('employee_id', __('Employee'),['class'=>'form-label'])}}
            {{ Form::select('employee_id', $employees,null, array('class' => 'form-control select','required'=>'required')) }}
        </div>
        <div class="form-group  col-lg-6 col-md-6">
            {{ Form::label('termination_type', __('Termination Type'),['class'=>'form-label']) }}
            {{ Form::select('termination_type', $terminationtypes,null, array('class' => 'form-control select','required'=>'required')) }}
        </div>
        <div class="form-group  col-lg-6 col-md-6">
            {{Form::label('notice_date',__('Notice Date'),['class'=>'form-label'])}}
            {{Form::date('notice_date',null,array('class'=>'form-control '))}}
        </div>
        <div class="form-group  col-lg-6 col-md-6">
            {{Form::label('termination_date',__('Termination Date'),['class'=>'form-label'])}}
            {{Form::date('termination_date',null,array('class'=>'form-control '))}}
        </div>
        <div class="form-group  col-lg-12">
            {{Form::label('description',__('Description'),['class'=>'form-label'])}}
            {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))}}
        </div>
    
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>

    {{Form::close()}}
