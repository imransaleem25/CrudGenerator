<?php
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>CRUD Stats</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Model</th>
                <th>Table</th>
                <th>CRUD Generated Count</th>
                <th>Records in DB</th>
            </tr>
            </thead>
            <tbody>
            @foreach($stats as $stat)
                <tr>
                    <td>{{ $stat->model_name }}</td>
                    <td>{{ $stat->table_name }}</td>
                    <td>{{ $stat->generated_count }}</td>
                    <td>{{ $stat->records_count }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
