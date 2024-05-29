{{Form::open(array('url'=>'holiday','method'=>'post'))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('occasion',__('Occasion'),['class'=>'form-label'])}}
            {{Form::text('occasion',null,array('class'=>'form-control'))}}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            {{Form::label('date',__('Start Date'),['class'=>'form-label'])}}
            {{Form::date('date',null,array('class'=>'form-control '))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('end_date',__('End Date'),['class'=>'form-label'])}}
            {{Form::date('end_date',null,array('class'=>'form-control'))}}
        </div>
    </div>
    @if (isset($settings['google_calendar_enable']) && $settings['google_calendar_enable'] == 'on')
        <div class="form-group col-md-6">
            {{Form::label('synchronize_type',__('Synchronize in Google Calendar ?'),array('class'=>'form-label')) }}
            <div class=" form-switch">
                <input type="checkbox" class="form-check-input mt-2" name="synchronize_type" id="switch-shadow" value="google_calender">
                <label class="form-check-label" for="switch-shadow"></label>
            </div>
        </div>
    @endif
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{Form::close()}}

