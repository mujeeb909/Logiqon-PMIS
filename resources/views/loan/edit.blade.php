{{Form::model($loan,array('route' => array('loan.update', $loan->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('title', __('Title')) }}
                    {{ Form::text('title',null, array('class' => 'form-control ','required'=>'required')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('loan_option', __('Loan Options')) }}<span class="text-danger">*</span>
                    {{ Form::select('loan_option',$loan_options,null, array('class' => 'form-control select','required'=>'required')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('type', __('Type'), ['class' => 'form-label']) }}
                    {{ Form::select('type', $loans, null, ['class' => 'form-control select amount_type', 'required' => 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('amount', __('Loan Amount'),['class'=>'form-label amount_label']) }}
                    {{ Form::number('amount',null, array('class' => 'form-control ','required'=>'required')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('start_date', __('Start Date')) }}
                    {{ Form::date('start_date',null, array('class' => 'form-control ','required'=>'required')) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('end_date', __('End Date')) }}
                    {{ Form::date('end_date',null, array('class' => 'form-control ','required'=>'required')) }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('reason', __('Reason')) }}
                    {{ Form::textarea('reason',null, array('class' => 'form-control ','required'=>'required')) }}
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>
{{Form::close()}}
