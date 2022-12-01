<div class="card-body">
    <div class="col">
        @if ($hotel->comments->isNotEmpty() )
                @foreach ($hotel->comments->take(3) as $comment)
                    <div class="row mb-2">
                        <div class="col-2 text-center">
                            <i class="fa-regular fa-comment"></i>
                        </div>
                        <div class="col-8 text-start">
                            <p class="comment mb-0">
                                {{ $comment->body }}
                                <hr class="mt-0">
                            </p>
                        </div>
                        @if ($comment->user->id == Auth::user()->id)
                        <div class="col-2">
                            <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn text-danger shadow-none btn-sm ps-0" id="trash"><i class="fa-sharp fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                        @endif
                    </div>
                @endforeach
                @if ($hotel->comments->count() > 3)
                    <a href="{{ route('hotel.show', $hotel->id) }}" class="text-decoration-none">View all comments ({{$hotel->comments->count()}})</a>
                @endif
        @else
            <div class="row">
                <h5 class="text-primary">No comment</h5>
            </div>
        @endif
    </div>
</div>
@if (Auth::user()->checkReserved($hotel->id))
    <div class="card-footer">
        <div class="row">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#review">
                Review
            </button>
            <div class="modal fade" id="review" tabindex="-1" aria-labelledby="review" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('comment.store', $hotel->id) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="input-group">
                                    <input type="text" name="body" id="body" class="form-control">
                                    <div class="small">
                                        @error('body')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn tbn-secondary" type="submit">
                                    <i class="fas fa-check "></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif



