
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="title">Title</label>
                    {{-- $post->title ?? null mean that if not title it give value null--}}
                    <input type="text" class="form-control" name="title" value="{{ old('title', $post->title ?? null)}}">

                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="text" class="form-control" name="content" value="{{ old('content', $post->content ?? null)}}">
                </div>
            </div>
        </div>
        
        @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
        @endif