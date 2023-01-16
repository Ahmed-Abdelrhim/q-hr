{{-- @extends('layouts.admin')
@section('page-title')
    {{ __('Manage Language') }}
@endsection
@section('action-button')
    <a href="#" data-url="{{ route('create.language') }}"
        class="action-btn btn-primary me-1 btn btn-sm d-inline-flex align-items-center" data-ajax-popup="true"
        data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Create') }}"
        data-title="{{ __('Create New Language') }}">
        <i class=" ti ti-plus"></i>
    </a>
    @if ($currantLang != (!empty(env('default_language')) ? env('default_language') : 'en'))
        <a href="#!" class="btn btn-xs btn-icon icon-left btn-danger width-auto" data-bs-toggle="tooltip"
            data-bs-placement="bottom" title="{{ __('Delete') }}"
            data-confirm="{{ __('Are You Sure?') . ' | ' . __('This action can not be undone. Do you want to continue?') }}"
            data-confirm-yes="document.getElementById('delete-form-{{ $currantLang }}').submit();">
            <i class="ti ti-trash"></i>
        </a>
        {!! Form::open(['method' => 'DELETE', 'route' => ['lang.destroy', $currantLang], 'id' => 'delete-form-' . $currantLang]) !!}
        {!! Form::close() !!}
    @endif
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="language-wrap">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 language-list-wrap">
                        <div class="language-list">
                            <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                @foreach ($languages as $lang)
                                    <li class="nav-item">
                                        <a href="{{ route('manage.language', [$lang]) }}"
                                            class="nav-link {{ $currantLang == $lang ? 'active' : '' }}">{{ Str::upper($lang) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 language-form-wrap">
                        <div class="language=form">
                            <div class="tab-content no-padding" id="myTab2Content">
                                <div class="tab-pane fade show active" id="lang1" role="tabpanel"
                                    aria-labelledby="home-tab4">
                                    <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                                role="tab" aria-controls="home"
                                                aria-selected="true">{{ __('Labels') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                                role="tab" aria-controls="profile"
                                                aria-selected="false">{{ __('Messages') }}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <form method="post"
                                                action="{{ route('store.language.data', [$currantLang]) }}">
                                                @csrf
                                                <div class="row">
                                                    @foreach ($arrLabel as $label => $value)
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-form-label"
                                                                    for="example3cols1Input">{{ $label }} </label>
                                                                <input type="text" class="form-control"
                                                                    name="label[{{ $label }}]"
                                                                    value="{{ $value }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="col-lg-12 text-right">
                                                        <input type="submit" value="{{ __('Save Change') }}"
                                                            class="btn-create badge-blue">
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <form method="post"
                                                action="{{ route('store.language.data', [$currantLang]) }}">
                                                @csrf
                                                <div class="row">
                                                    @foreach ($arrMessage as $fileName => $fileValue)
                                                        <div class="col-lg-12">
                                                            <h3>{{ ucfirst($fileName) }}</h3>
                                                        </div>
                                                        @foreach ($fileValue as $label => $value)
                                                            @if (is_array($value))
                                                                @foreach ($value as $label2 => $value2)
                                                                    @if (is_array($value2))
                                                                        @foreach ($value2 as $label3 => $value3)
                                                                            @if (is_array($value3))
                                                                                @foreach ($value3 as $label4 => $value4)
                                                                                    @if (is_array($value4))
                                                                                        @foreach ($value4 as $label5 => $value5)
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        class="col-form-label">{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}.{{ $label4 }}.{{ $label5 }}</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}][{{ $label4 }}][{{ $label5 }}]"
                                                                                                        value="{{ $value5 }}">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @else
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="col-form-label">{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}.{{ $label4 }}</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}][{{ $label4 }}]"
                                                                                                    value="{{ $value4 }}">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            class="col-form-label">{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}]"
                                                                                            value="{{ $value3 }}">
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="col-form-label">{{ $fileName }}.{{ $label }}.{{ $label2 }}</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}]"
                                                                                    value="{{ $value2 }}">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="col-form-label">{{ $fileName }}.{{ $label }}</label>
                                                                        <input type="text" class="form-control"
                                                                            name="message[{{ $fileName }}][{{ $label }}]"
                                                                            value="{{ $value }}">
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </div>
                                                <div class="col-lg-12 text-right">
                                                    <input type="submit" value="{{ __('Save Change') }}"
                                                        class="btn-create badge-blue">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.admin')
@push('css-page')
@endpush
@push('script-page')
@endpush
@section('page-title')
    {{__('Language')}}
@endsection
@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">   {{__('Language')}}</h5>
    </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('Language')}}</li>
@endsection
@section('action-button')
<div class="row align-items-center m-1">
    <div class="col-auto pe-0">
    <a href="#" class="btn btn-sm btn-primary btn-icon" data-size="md" data-url="{{ route('create.language') }}"
    data-ajax-popup="true" data-title="{{ __('Create New Language') }}"
    data-bs-toggle="tooltip"
    data-bs-original-title="{{__('Create ')}}">
        <i class="ti ti-plus text-white"></i>
    </a>
    </div>
        @if($currantLang != \App\Models\Utility::settings()['default_language'])
        <div class="col-auto pe-0">
        {!! Form::open(['method' => 'DELETE', 'route' => ['lang.destroy', $currantLang], 'id' => 'delete-form-' . $currantLang]) !!}
        <a href="#" class="btn btn-sm btn-danger btn-icon bs-pass-para"
            data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
            aria-label="Delete"><i class="ti ti-trash text-white "></i></a>
        </form>
    </div>
    @endif
</div>

@endsection
@section('content')

        <div class="col-xl-3 col-md-3">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills flex-column " id="myTab4" role="tablist">
                        @foreach($languages as $lang)
                            <li class="nav-item">
                                <a href="{{route('manage.language',[$lang])}}" class="nav-link {{($currantLang == $lang)?'active':''}}">{{Str::upper($lang)}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-md-9">
            <div class="p-3 card">
                <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-user-tab-1" data-bs-toggle="pill"
                            data-bs-target="#pills-user-1" type="button">{{__('Labels')}}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-user-tab-2" data-bs-toggle="pill"
                            data-bs-target="#pills-user-2" type="button">{{__('Messages')}}</button>
                    </li>

                </ul>
            </div>
            <div class="card card-fluid">
                <div class="card-body" style="position: relative;">
                    <div class="tab-content no-padding" id="myTab2Content">
                        <div class="tab-pane fade show active" id="lang1" role="tabpanel" aria-labelledby="home-tab4">

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="pills-user-1" role="tabpanel" aria-labelledby="pills-user-tab-1">
                                    <form method="post" action="{{route('store.language.data',[$currantLang])}}">
                                        @csrf
                                        <div class="row">
                                            @foreach($arrLabel as $label => $value)
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="example3cols1Input">{{$label}} </label>
                                                        <input type="text" class="form-control" name="label[{{$label}}]" value="{{$value}}">
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="col-lg-12 text-right">
                                                <button class="btn btn-primary" type="submit">{{ __('Save Changes')}}</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-user-2" role="tabpanel" aria-labelledby="pills-user-tab-2">
                                    <form method="post" action="{{route('store.language.data',[$currantLang])}}">
                                        @csrf
                                        <div class="row">
                                            @foreach($arrMessage as $fileName => $fileValue)
                                            <div class="col-lg-12">
                                                <h5>{{ucfirst($fileName)}}</h5>
                                            </div>
                                            @foreach($fileValue as $label => $value)
                                                @if(is_array($value))
                                                    @foreach($value as $label2 => $value2)
                                                        @if(is_array($value2))
                                                            @foreach($value2 as $label3 => $value3)
                                                                @if(is_array($value3))
                                                                    @foreach($value3 as $label4 => $value4)
                                                                        @if(is_array($value4))
                                                                            @foreach($value4 as $label5 => $value5)
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}.{{$label5}}</label>
                                                                                        <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}][{{$label5}}]" value="{{$value5}}">
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @else
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label>{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}</label>
                                                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}]" value="{{$value4}}">
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label>{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}</label>
                                                                            <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}]" value="{{$value3}}">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>{{$fileName}}.{{$label}}.{{$label2}}</label>
                                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}]" value="{{$value2}}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>{{$fileName}}.{{$label}}</label>
                                                            <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}]" value="{{$value}}">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        </div>
                                        <div class="col-lg-12 text-right">

                                            <button class="btn btn-primary" type="submit">{{ __('Save Changes')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>

@endsection


