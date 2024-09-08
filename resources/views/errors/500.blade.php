@extends('errors.minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __($exceptionMessage ?: 'Server Error'))
@section('sub-message', __($exceptionSubMessage ?: 'Server Error'))
