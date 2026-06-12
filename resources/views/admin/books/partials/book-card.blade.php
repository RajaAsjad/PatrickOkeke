<article class="book-item-card" id="book-row-{{ $model->id }}">
	<div class="book-item-card__cover">
		@if($model->cover)
			<img src="{{ $model->coverUrl() }}" alt="{{ $model->title }}" loading="lazy">
		@else
			<div class="book-item-card__cover-placeholder"><i class="fa fa-book"></i></div>
		@endif
		@canany(['book-edit', 'book-delete'])
		<div class="book-item-card__fab">
			@can('book-edit')
			<a href="{{ route('book.edit', $model->id) }}" class="book-item-card__fab-btn" title="Edit" aria-label="Edit book"><i class="fa fa-pencil"></i></a>
			@endcan
			@can('book-delete')
			<button type="button" class="book-item-card__fab-btn book-item-card__fab-btn--danger book-delete" data-row-id="{{ $model->id }}" data-del-url="{{ route('book.destroy', $model->id) }}" title="Delete" aria-label="Delete book"><i class="fa fa-trash"></i></button>
			@endcan
		</div>
		@endcanany
	</div>
	<div class="book-item-card__body">
		<p class="book-item-card__meta">{{ $model->category }}@if($model->year) · {{ $model->year }}@endif</p>
		<h3 class="book-item-card__title">{{ $model->title }}</h3>
		<p class="book-item-card__price">{{ $model->formattedPrice() }}</p>
		<div class="book-item-card__badges">
			@if($model->featured)
				<span class="bk-badge bk-badge--featured">Featured</span>
			@endif
			@if($model->status)
				<span class="bk-badge bk-badge--published">Published</span>
			@else
				<span class="bk-badge bk-badge--draft">Draft</span>
			@endif
			@if($model->file_path)
				<span class="bk-badge bk-badge--file">{{ strtoupper($model->file_type) }}</span>
			@else
				<span class="bk-badge bk-badge--missing">No file</span>
			@endif
		</div>
	</div>
</article>
