@extends('layouts.panel')

@section('title', 'Users')


@section('content')

    <x-panel.breadcrumb title="Users" page="Users">
        <x-panel.breadcrumb-action title="Add User" icon="add-circle-outline"
            attr='data-bs-toggle="modal" data-bs-target="#addModal"'>
        </x-panel.breadcrumb-action>
    </x-panel.breadcrumb>

@stop


@section('scripts')

@stop
