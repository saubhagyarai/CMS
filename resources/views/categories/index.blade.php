@extends('layouts.app')


@section('content')

<div class="d-flex justify-content-end">
  <a href="{{ route('categories.create')}}" class="btn btn-success mb-2">Add Category</a>
</div>

<div class="card card-default">
  <div class="card-header">
    Categories
  </div>
  <div class="card-body">
    @if($categories->count() > 0)
    <table class="table">
      <thead>
        <th>Name</th>
        <th>Post Count</th>
        <th></th>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td>
            {{$category->name}}
          </td>
          <td>
            {{$category->posts->count()}}
          </td>
          <td>
            <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-sm">Edit</a>
            <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">Delete</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">

        <form action="" method="POST" id="deleteCategoryForm">
          @csrf

          @method('DELETE')

          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-center text-bold">Are you sure you want to delete <strong>{{$category->name}}</strong>
                Category?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
              <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    @else
    <h3 class="text-center">No Category Found</h3>
    @endif
  </div>
</div>

@endsection

@section('scripts')
<script>
  function handleDelete(id) {
    
    var form = document.getElementById('deleteCategoryForm');
    form.action = '/categories/'+id;
    $('#deleteModal').modal('show');
  }
</script>

@endsection