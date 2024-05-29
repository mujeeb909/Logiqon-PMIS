
{{ Form::model($client, array('route' => array('clients.update', $client->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group">
            {{ Form::label('name', __('Name'),['class'=>'form-label']) }}
            {{ Form::text('name', null, array('class' => 'form-control','placeholder'=>__('Enter Client Name'),'required'=>'required')) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', __('E-Mail Address'),['class'=>'form-label']) }}
            {{ Form::email('email', null, array('class' => 'form-control','placeholder'=>__('Enter Client Email'),'required'=>'required')) }}
        </div>

        @if(!$customFields->isEmpty())
            @include('custom_fields.formBuilder')
        @endif

    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>

{{Form::close()}}


