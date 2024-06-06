{{ Form::model($project, ['route' => ['projects.updateStatus', $project->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
                <select name="status" id="status" class="form-control main-element select2">
                    @foreach (\App\Models\Project::$project_status as $k => $v)
                        <option value="{{ $k }}" {{ $project->status == $k ? 'selected' : '' }}>
                            {{ __($v) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}
