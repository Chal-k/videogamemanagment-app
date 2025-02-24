@extends('layouts.layout');

@section('content')
<div class="container">
    <table class="table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Release date</th>
          <th>Genre</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($games as $game)
        <tr>
            <td>{{ $game->title }}</td>
            <td>{{ $game->description }}</td>
            <td>{{ $game->release_date }}</td>
            <td>{{ $game->genre }}</td>
          </tr>
        @endforeach
      
    </tbody>
    </table>
  </div>

  