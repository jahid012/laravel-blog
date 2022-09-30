@extends('layouts.app')

@section('page_title', __('Pages List'))

@section('page')

    <style>
        .card .card-header button {
            margin-right: 2px;
        }

    </style>

    <div class="card">
        <div class="card-header d-flex ">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button class="btn btn-primary" type="submit">Button</button>
                <button class="btn btn-primary" type="submit">Button</button>
                <button class="btn btn-primary" type="submit">Button</button>
                <button class="btn btn-primary" type="submit">Button</button>
                <button class="btn btn-primary" type="submit">Button</button>
                <button class="btn btn-primary" type="submit">Button</button>
            </div>

            <div class="ms-auto">

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="media search"
                        aria-label="media search" aria-describedby="media-search">
                    <button class="btn btn-outline-secondary" type="submit" id="media-search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>




        </div>
        <div class="card-body">

        </div>
    </div>
@endsection
