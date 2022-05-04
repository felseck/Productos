@extends('errors.illustrated-layout')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))

@section('image')
@if(env('ENABLE_AMAZON_S3') == true) 
<img src="https://{{ env('AWS_BUCKET') }}.s3.{{ env('AWS_DEFAULT_REGION') }}.amazonaws.com/general/404.jpg" width="500" /><br>
@else
<img src='/img/404.jpg' width="500" /><br>
@endif
@endsection
