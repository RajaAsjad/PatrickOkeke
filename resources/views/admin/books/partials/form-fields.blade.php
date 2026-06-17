@php
	$isEdit = !empty($model);
	$featuredOn = old('featured', $isEdit ? $model->featured : false);
	$featuredOn = $featuredOn == 1 || $featuredOn === '1' || $featuredOn === true;
	$statusOn = old('status', $isEdit ? $model->status : true);
	$statusOn = $statusOn == 1 || $statusOn === '1' || $statusOn === true;
@endphp

<div class="row">
	<div class="col-md-8">
		<div class="book-form-section">
			<div class="book-form-section__title">Book details</div>
			<div class="form-group">
				<label for="title">Title <span class="required">*</span></label>
				<input type="text" id="title" name="title" class="form-control" value="{{ old('title', $isEdit ? $model->title : '') }}" placeholder="e.g. Blurred Lines" required>
			</div>
			<div class="form-group">
				<label for="subtitle">Subtitle</label>
				<input type="text" id="subtitle" name="subtitle" class="form-control" value="{{ old('subtitle', $isEdit ? $model->subtitle : '') }}" placeholder="Short tagline for the book">
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="category">Category</label>
						<input type="text" id="category" name="category" class="form-control" value="{{ old('category', $isEdit ? $model->category : '') }}" placeholder="Business, Essays, Technology…">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label for="year">Year</label>
						<input type="text" id="year" name="year" class="form-control" value="{{ old('year', $isEdit ? $model->year : date('Y')) }}" maxlength="4" placeholder="2025">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label for="price">Price (USD) <span class="required">*</span></label>
						<input type="number" step="0.01" min="0" id="price" name="price" class="form-control" value="{{ old('price', $isEdit ? $model->price : '9.99') }}" required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea id="description" name="description" class="form-control" rows="4" placeholder="Full description shown on the book card">{{ old('description', $isEdit ? $model->description : '') }}</textarea>
			</div>
			<div class="form-group">
				<label for="excerpt">Excerpt</label>
				<textarea id="excerpt" name="excerpt" class="form-control" rows="3" placeholder="Preview text for the book detail page">{{ old('excerpt', $isEdit ? $model->excerpt : '') }}</textarea>
				<p class="help-block">Leave blank to use the description on the excerpt page.</p>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="book-settings-panel">
			<div class="book-form-section__title" style="margin-bottom:16px;">Media &amp; settings</div>

			@if($isEdit && $model->cover)
			<div class="book-cover-preview">
				<img src="{{ $model->coverUrl() }}" alt="Current cover">
			</div>
			@endif

			<div class="form-group">
				<label>{{ $isEdit && $model->cover ? 'Replace cover' : 'Cover image' }}</label>
				<div class="book-upload-zone">
					<input type="file" name="cover" accept="image/*">
					<div class="book-upload-zone__icon"><i class="fa fa-image"></i></div>
					<div class="book-upload-zone__text">Click to upload cover</div>
					<div class="book-upload-zone__hint">PNG, JPG. Recommended 400×600px</div>
				</div>
			</div>

			<div class="form-group">
				<label>Book file (PDF or EPUB)</label>
				@if($isEdit && $model->file_path)
					<p class="help-block help-block--success"><i class="fa fa-check-circle"></i> {{ strtoupper($model->file_type) }} file uploaded. Customers can download after purchase.</p>
				@endif
				<div class="book-upload-zone">
					<input type="file" name="file" accept=".pdf,.epub">
					<div class="book-upload-zone__icon"><i class="fa fa-file-text-o"></i></div>
					<div class="book-upload-zone__text">{{ $isEdit && $model->file_path ? 'Replace file' : 'Upload PDF or EPUB' }}</div>
					<div class="book-upload-zone__hint">Max 50 MB. Delivered after Stripe payment.</div>
				</div>
			</div>

			<div class="form-group" style="margin-bottom:8px;">
				<label for="sort_order">Sort order</label>
				<input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $isEdit ? $model->sort_order : 0) }}" min="0">
				<p class="help-block">Lower numbers appear first on the shelf.</p>
			</div>

			<div class="book-toggle-row">
				<div>
					<div class="book-toggle-row__label">Featured</div>
					<div class="book-toggle-row__hint">Show on homepage</div>
				</div>
				<label class="book-toggle-switch">
					<input type="checkbox" id="featured_toggle" {{ $featuredOn ? 'checked' : '' }}>
					<span class="book-toggle-slider"></span>
				</label>
				<input type="hidden" name="featured" id="featured" value="{{ $featuredOn ? '1' : '0' }}">
			</div>

			<div class="book-toggle-row">
				<div>
					<div class="book-toggle-row__label">Published</div>
					<div class="book-toggle-row__hint">Visible on website</div>
				</div>
				<label class="book-toggle-switch">
					<input type="checkbox" id="status_toggle" {{ $statusOn ? 'checked' : '' }}>
					<span class="book-toggle-slider"></span>
				</label>
				<input type="hidden" name="status" id="status" value="{{ $statusOn ? '1' : '0' }}">
			</div>
		</div>
	</div>
</div>
