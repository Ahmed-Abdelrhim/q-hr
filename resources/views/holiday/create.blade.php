


{{ Form::open(['url' => 'holiday', 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
    <div class="form-group col-md-12">
            {{ Form::label('occasion', __('Occasion'), ['class' => 'col-form-label']) }}
            {{ Form::text('occasion', null, ['class' => 'form-control','placeholder'=>'Enter Occasion']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('start_date', __('Start Date'), ['class' => 'col-form-label']) }}
            {{ Form::date('start_date', null, ['class' => 'form-control ','autocomplete'=>'off']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('end_date', __('End Date'), ['class' => 'col-form-label']) }}
            {{ Form::date('end_date', null, ['class' => 'form-control ','autocomplete'=>'off']) }}
        </div>
       
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn btn-primary">
</div>

{{ Form::close() }}
