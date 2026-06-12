<div class="book-cards-grid">
	@forelse($models as $model)
		@include('admin.books.partials.book-card', ['model' => $model])
	@empty
	<div class="book-cards-empty">
		<i class="fa fa-book"></i>
		<p style="font-size:16px;font-weight:600;margin-bottom:6px;">No books found</p>
		<p style="font-size:13px;">Add your first book product to start selling.</p>
	</div>
	@endforelse
	@if($models->hasPages())
	<div class="book-cards-pagination">
		<div class="text-muted small mb-2">Displaying {{ $models->firstItem() }} to {{ $models->lastItem() }} of {{ $models->total() }} records</div>
		{!! $models->appends(request()->query())->links('pagination::bootstrap-4') !!}
	</div>
	@endif
</div>
