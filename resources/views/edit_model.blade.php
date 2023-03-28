<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Todo Here</h5>
                <button type="button" id="hide_modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="form-group mb-2">
                    <label for="Name" class="mb-2">Title:</label>
                    <input type="text" name="title" class="form-control" value="{{ $item->title }}">
                </div>
                <div class="form-group mb-2">
                    <label for="Name" class="mb-2">Description:</label>
                    <textarea name="desc" class="form-control" rows="10" required>{{ $item->desc }}</textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="Name" class="mb-2">Status:</label>
                    <select name="status" class="form-control">
                        <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="progress" {{ $item->status == 'progress' ? 'selected' : '' }}>Progress</option>
                        <option value="done" {{ $item->status == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>
                {{-- <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="is_priority" value="1"
                    id="is_priority">
                <label class="form-check-label" for="is_priority">
                    Is on Priority <span class="text-warning">(By checking this it will be on
                        priority)</span>
                </label>
            </div> --}}
                <input type="hidden" name="todo_id" value="{{ $item->id }}">
                <input type="submit" class="form-control btn btn-success mb-2 mt-4">
            </div>

        </div>
    </div>
</div>
