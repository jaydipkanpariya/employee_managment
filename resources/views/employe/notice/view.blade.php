<div class="modal-header border-bottom-0">
    <h5 class="modal-title" id="exampleModalLabel">View Notice</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


    <div class="modal-body">
        <div class="form-group">
            <label class="floating-label" for="date">Date</label>
            <input type="date" name="date" class="form-control" id="date"
                value="{{ $pro->date }}" readonly>
        </div>
        <div class="form-group">
            <label class="floating-label" for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $pro->title }}"
                placeholder="Enter Your Title" readonly>
        </div>
        <div class="form-group">
            <label class="floating-label" for="description">Description</label>
            <textarea name="description" rows="6" class="form-control" id="description" placeholder="Enter Your Description" readonly>{{ $pro->description }}</textarea>
        </div>

    </div>



