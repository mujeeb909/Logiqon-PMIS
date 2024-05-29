{{Form::open(array('url'=>'warning','method'=>'post'))}}
<div class="modal-body">
    <div class="row">
        @if(\Auth::user()->type != 'Employee')
            <div class="form-group col-md-6 col-lg-6">
                {{ Form::label('warning_by', __('Warning By'),['class'=>'form-label'])}}
                {{ Form::select('warning_by', $employees,null, array('class' => 'form-control select','required'=>'required')) }}
            </div>
        @endif
        <div class="form-group col-md-6 col-lg-6">
            {{Form::label('warning_to',__('Warning To'),['class'=>'form-label'])}}
            {{Form::select('warning_to',$employees,null,array('class'=>'form-control select'))}}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{Form::label('subject',__('Subject'),['class'=>'form-label'])}}
            {{Form::text('subject',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{Form::label('warning_date',__('Warning Date'),['class'=>'form-label'])}}
            {{Form::date('warning_date',null,array('class'=>'form-control '))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('description',__('Description'),['class'=>'form-label'])}}
            {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))}}
        </div>

    </div>

</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

    {{Form::close()}}
