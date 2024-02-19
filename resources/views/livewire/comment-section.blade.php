
<div class="container mt-5" >
    <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" wire:model="name" placeholder="Name" >
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" wire:model="comment" placeholder="Comment" >
            @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <button class="btn btn-primary" wire:click="{{ $button }}">{{ $button }}</button>
        </div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Comment</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($comments as $comment)
                <tr>
                    <td class="align-middle text-center">{{ $comment->name }}</td>
                    <td class="align-middle text-center">{{ $comment->comment }}</td>
                    <td class="align-middle text-center">
                        <button class="btn btn-sm btn-primary mr-1" wire:click="editComment({{ $comment->id }})">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="deleteComment({{ $comment->id }})">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No comments found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div x-data="{
        observe() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        @this.loadMore()
                    }
                });
            });
            observer.observe(this.$el);
        }
    }" x-init="observe"></div>

  
</div>
