{{Form::open(array('url'=>'job-application','method'=>'post', 'enctype' => "multipart/form-data"))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('job',__('Job'),['class'=>'form-label'])}}
            {{Form::select('job',$jobs,null,array('class'=>'form-control select2','id'=>'jobs'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('name',__('Name'),['class'=>'form-label'])}}
            {{Form::text('name',null,array('class'=>'form-control name'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('email',__('Email'),['class'=>'form-label'])}}
            {{Form::text('email',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('phone',__('Phone'),['class'=>'form-label'])}}
            {{Form::text('phone',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6 dob d-none">
            {!! Form::label('dob', __('Date of Birth'),['class'=>'form-label']) !!}
            {!! Form::date('dob', old('dob'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-6 gender d-none">
            {!! Form::label('gender', __('Gender'),['class'=>'form-label']) !!}
            <div class="d-flex radio-check">
                <div class="form-check form-check-inline form-group">
                    <input type="radio" id="g_male" value="Male" name="gender" class="form-check-input">
                    <label class="form-check-label" for="g_male">{{__('Male')}}</label>
                </div>
                <div class="form-check form-check-inline form-group">
                    <input type="radio" id="g_female" value="Female" name="gender" class="form-check-input">
                    <label class="form-check-label" for="g_female">{{__('Female')}}</label>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6 country d-none">
            {{Form::label('country',__('Country'),['class'=>'form-label'])}}
            {{Form::text('country',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6 country d-none">
            {{Form::label('state',__('State'),['class'=>'form-label'])}}
            {{Form::text('state',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6 country d-none">
            {{Form::label('city',__('City'),['class'=>'form-label'])}}
            {{Form::text('city',null,array('class'=>'form-control'))}}
        </div>

        <div class="form-group col-md-6 profile d-none">
            {{Form::label('profile',__('Profile'),['class'=>'form-label'])}}
            <div class="choose-file form-group">
                <label for="profile" class="form-label">
                    <div>{{__('Choose file here')}}</div>
                    <input type="file" class="form-control" name="profile" id="profile" data-filename="profile_create">
                </label>
                <p class="profile_create"></p>
            </div>
        </div>
        <div class="form-group col-md-6 resume d-none">
            {{Form::label('resume',__('CV / Resume'),['class'=>'form-label'])}}
            <div class="choose-file form-group">
                <label for="resume" class="form-label">
                    <div>{{__('Choose file here')}}</div>
                    <input type="file" class="form-control" name="resume" id="resume" data-filename="resume_create">
                </label>
                <p class="resume_create"></p>
            </div>
        </div>
        <div class="form-group col-md-12 letter d-none">
            {{Form::label('cover_letter',__('Cover Letter'),['class'=>'form-label'])}}
            {{Form::textarea('cover_letter',null,array('class'=>'form-control'))}}
        </div>

        @foreach($questions as $question)
            <div class="form-group col-md-12  question question_{{$question->id}} d-none">
                {{Form::label($question->question,$question->question,['class'=>'form-label'])}}
                <input type="text" class="form-control" name="question[{{$question->question}}]" {{($question->is_required=='yes')? '':''}}>
            </div
        @endforeach

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>
{{Form::close()}}


