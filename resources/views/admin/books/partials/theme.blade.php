<style>
	.book-admin {
		--bk-paper: #f5f3f0;
		--bk-ink: #1c1917;
		--bk-muted: #78716c;
		--bk-ember: #a85a32;
		--bk-ember-deep: #7c4a2d;
		--bk-ember-light: #c9845c;
		--bk-card: #fff;
		--bk-border: rgba(28, 25, 23, 0.1);
	}

	.book-admin .book-shell {
		background: var(--bk-card);
		border-radius: 14px;
		box-shadow: 0 8px 32px rgba(28, 25, 23, 0.08);
		border: 1px solid var(--bk-border);
		overflow: hidden;
	}

	.book-admin .book-page-header {
		background: linear-gradient(135deg, var(--bk-ember-deep) 0%, var(--bk-ember) 52%, var(--bk-ember-light) 100%);
		color: #fff;
		padding: 24px 30px;
		text-align: center;
		border-bottom: 2px solid rgba(124, 74, 45, 0.45);
		box-shadow: inset 0 -1px 0 rgba(255, 255, 255, 0.08);
	}

	.book-admin .book-page-header h1 {
		margin: 0;
		font-size: 22px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.06em;
		color: #fff !important;
		text-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
	}

	.book-admin .book-page-header p {
		margin: 8px 0 0;
		font-size: 13px;
		color: rgba(255, 255, 255, 0.92) !important;
		font-weight: 400;
		text-transform: none;
		letter-spacing: 0;
	}

	.book-stats {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
		gap: 18px;
		padding: 24px 28px 0;
		background: var(--bk-paper);
	}

	.book-stats .stat-box {
		background: var(--bk-card);
		padding: 20px 16px;
		border-radius: 12px;
		text-align: center;
		margin-bottom: 18px;
		border: 1px solid var(--bk-border);
		box-shadow: 0 2px 10px rgba(28, 25, 23, 0.04);
		transition: transform 0.2s ease, box-shadow 0.2s ease;
	}

	.book-stats .stat-box:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 18px rgba(28, 25, 23, 0.08);
	}

	.book-stats .stat-box .num {
		font-size: 26px;
		font-weight: 700;
		color: var(--bk-ember-deep);
		line-height: 1.1;
	}

	.book-stats .stat-box .lbl {
		font-size: 12px;
		color: var(--bk-muted);
		font-weight: 600;
		margin-top: 6px;
		text-transform: uppercase;
		letter-spacing: 0.04em;
	}

	.book-stats .stat-box--action {
		display: flex;
		align-items: center;
		justify-content: center;
		background: transparent;
		border: 2px dashed rgba(168, 90, 50, 0.28);
		box-shadow: none;
	}

	.book-stats .btn-add-book {
		background: linear-gradient(135deg, var(--bk-ember) 0%, var(--bk-ember-deep) 100%);
		color: #fff !important;
		border-radius: 10px;
		padding: 12px 22px;
		font-weight: 600;
		text-decoration: none !important;
		display: inline-flex;
		align-items: center;
		gap: 8px;
		box-shadow: 0 4px 16px rgba(168, 90, 50, 0.3);
		transition: all 0.25s ease;
	}

	.book-stats .btn-add-book:hover {
		transform: translateY(-2px);
		box-shadow: 0 8px 22px rgba(168, 90, 50, 0.38);
		color: #fff !important;
	}

	.book-search {
		background: var(--bk-paper);
		padding: 0 28px 20px;
	}

	.book-search__inner {
		display: flex;
		gap: 12px;
		align-items: center;
		flex-wrap: wrap;
		padding: 18px 20px;
		background: var(--bk-card);
		border-radius: 12px;
		border: 1px solid var(--bk-border);
	}

	.book-search .form-control {
		border: 2px solid #e7e5e4;
		border-radius: 10px; 
		font-size: 14px;
		transition: border-color 0.2s, box-shadow 0.2s;
		background: #fff;
	}

	.book-search .form-control:focus {
		border-color: rgba(168, 90, 50, 0.55);
		box-shadow: 0 0 0 3px rgba(168, 90, 50, 0.12);
		outline: none;
	}

	.book-search .btn-filter {
		background: linear-gradient(135deg, var(--bk-ember-deep) 0%, var(--bk-ember) 100%);
		color: #fff !important;
		border: none;
		padding: 10px 22px;
		border-radius: 10px;
		font-weight: 600;
		transition: all 0.2s ease;
	}

	.book-search .btn-filter:hover {
		box-shadow: 0 4px 14px rgba(168, 90, 50, 0.38);
		color: #fff !important;
	}

	.book-body {
		padding: 0 28px 28px;
		background: var(--bk-paper);
	}

	.book-cards-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(min(100%, 300px), 1fr));
		gap: 20px;
		align-items: stretch;
	}

	.book-item-card {
		background: var(--bk-card);
		border-radius: 14px;
		overflow: hidden;
		border: 1px solid var(--bk-border);
		box-shadow: 0 4px 20px rgba(28, 25, 23, 0.06);
		display: flex;
		flex-direction: column;
		transition: transform 0.2s ease, box-shadow 0.2s ease;
	}

	.book-item-card:hover {
		transform: translateY(-4px);
		box-shadow: 0 12px 32px rgba(28, 25, 23, 0.1);
	}

	.book-item-card__cover {
		position: relative;
		aspect-ratio: 3 / 4;
		background: linear-gradient(145deg, var(--bk-ember-deep) 0%, var(--bk-ember) 100%);
		overflow: hidden;
	}

	.book-item-card__cover img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.book-item-card__cover-placeholder {
		width: 100%;
		height: 100%;
		display: flex;
		align-items: center;
		justify-content: center;
		color: rgba(255, 255, 255, 0.5);
		font-size: 48px;
	}

	.book-item-card__fab {
		position: absolute;
		top: 12px;
		right: 12px;
		display: flex;
		flex-direction: column;
		gap: 6px;
		padding: 8px 6px;
		background: rgba(28, 25, 23, 0.78);
		backdrop-filter: blur(8px);
		border-radius: 999px;
		border: 1px solid rgba(255, 255, 255, 0.1);
	}

	.book-item-card__fab-btn {
		width: 36px;
		height: 36px;
		border-radius: 50%;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		border: none;
		background: rgba(255, 255, 255, 0.1);
		color: #fff !important;
		cursor: pointer;
		text-decoration: none !important;
		transition: background 0.2s, transform 0.15s;
		font-size: 14px;
	}

	.book-item-card__fab-btn:hover {
		background: rgba(255, 255, 255, 0.22);
		transform: scale(1.06);
		color: #fff !important;
	}

	.book-item-card__fab-btn--danger:hover {
		background: rgba(220, 38, 38, 0.85);
	}

	.book-item-card__body {
		flex: 1;
		display: flex;
		flex-direction: column;
		gap: 10px;
		padding: 18px 20px 20px;
	}

	.book-item-card__meta {
		font-size: 11px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.06em;
		color: var(--bk-muted);
	}

	.book-item-card__title {
		margin: 0;
		font-size: 1.05rem;
		font-weight: 700;
		color: var(--bk-ink);
		line-height: 1.35;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
	}

	.book-item-card__price {
		font-size: 1.15rem;
		font-weight: 700;
		color: var(--bk-ember);
	}

	.book-item-card__badges {
		display: flex;
		flex-wrap: wrap;
		gap: 8px;
		margin-top: auto;
		padding-top: 6px;
	}

	.bk-badge {
		display: inline-block;
		padding: 5px 12px;
		border-radius: 50px;
		font-size: 10px;
		font-weight: 700;
		letter-spacing: 0.05em;
		text-transform: uppercase;
		white-space: nowrap;
	}

	.bk-badge--featured {
		background: linear-gradient(to right, var(--bk-ember), var(--bk-ember-deep));
		color: #fff;
	}

	.bk-badge--published {
		background: #d1fae5;
		color: #14532d;
		border: 1px solid #6ee7b7;
	}

	.bk-badge--draft {
		background: #fef3c7;
		color: #92400e;
		border: 1px solid #fcd34d;
	}

	.bk-badge--file {
		background: #e0f2fe;
		color: #0c4a6e;
		border: 1px solid #7dd3fc;
	}

	.bk-badge--missing {
		background: #fee2e2;
		color: #991b1b;
		border: 1px solid #fca5a5;
	}

	.book-cards-empty {
		grid-column: 1 / -1;
		text-align: center;
		padding: 60px 24px;
		background: var(--bk-card);
		border-radius: 14px;
		border: 2px dashed var(--bk-border);
		color: var(--bk-muted);
	}

	.book-cards-empty i {
		font-size: 42px;
		margin-bottom: 16px;
		opacity: 0.4;
		display: block;
	}

	.book-cards-pagination {
		grid-column: 1 / -1;
		background: var(--bk-card);
		border-radius: 12px;
		border: 1px solid var(--bk-border);
		padding: 18px 16px;
		text-align: center;
	}

	/* Form styles */
	.book-form-shell {
		background: var(--bk-card);
		border-radius: 14px;
		box-shadow: 0 8px 32px rgba(28, 25, 23, 0.08);
		border: 1px solid var(--bk-border);
		overflow: hidden;
		margin: 16px 0 28px;
	}

	.book-form-body {
		padding: 0 32px 36px;
		background: var(--bk-paper);
	}

	.book-form-banner {
		background: linear-gradient(135deg, var(--bk-ember-deep) 0%, var(--bk-ember) 52%, var(--bk-ember-light) 100%);
		padding: 18px 24px;
		margin: 0 -32px 28px -32px;
		text-align: center;
		border-bottom: 2px solid rgba(124, 74, 45, 0.45);
	}

	.book-form-banner h3 {
		margin: 0;
		font-size: 17px;
		font-weight: 600;
		color: #fff !important;
		letter-spacing: 0.06em;
		text-transform: uppercase;
	}

	.book-form-banner p {
		margin: 6px 0 0;
		font-size: 13px;
		color: rgba(255, 255, 255, 0.92) !important;
		text-transform: none;
		letter-spacing: 0;
	}

	.book-form-section {
		margin-bottom: 28px;
	}

	.book-form-section__title {
		font-size: 12px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.08em;
		color: var(--bk-ember);
		margin-bottom: 18px;
		padding-bottom: 10px;
		border-bottom: 2px solid rgba(168, 90, 50, 0.18);
	}

	.book-form-shell .form-group {
		margin-bottom: 22px;
	}

	.book-form-shell label {
		font-weight: 600;
		color: #374151;
		margin-bottom: 8px;
		font-size: 13px;
		display: block;
	}

	.book-form-shell label .required {
		color: #dc2626;
	}

	.book-form-shell .form-control {
		border: 2px solid #e7e5e4;
		border-radius: 10px;
		padding: 11px 14px;
		font-size: 14px;
		transition: all 0.2s ease;
		background: #fff;
		width: 100%;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
	}

	.book-form-shell .form-control:focus {
		border-color: rgba(168, 90, 50, 0.55);
		box-shadow: 0 0 0 3px rgba(168, 90, 50, 0.12);
		outline: none;
	}

	.book-form-shell textarea.form-control {
		resize: vertical;
		min-height: 100px;
	}

	.book-form-shell .help-block {
		font-size: 12px;
		color: var(--bk-muted);
		margin-top: 6px;
	}

	.book-form-shell .help-block--success {
		color: #047857;
		font-weight: 500;
	}

	.book-upload-zone {
		position: relative;
		border: 2px dashed #d6d3d1;
		border-radius: 12px;
		padding: 28px 20px;
		text-align: center;
		background: #fff;
		transition: border-color 0.2s, background 0.2s;
		cursor: pointer;
	}

	.book-upload-zone:hover {
		border-color: rgba(168, 90, 50, 0.45);
		background: #fdf8f4;
	}

	.book-upload-zone input[type="file"] {
		position: absolute;
		inset: 0;
		opacity: 0;
		cursor: pointer;
		width: 100%;
		height: 100%;
	}

	.book-upload-zone__icon {
		font-size: 28px;
		color: var(--bk-ember);
		margin-bottom: 10px;
	}

	.book-upload-zone__text {
		font-size: 13px;
		font-weight: 600;
		color: var(--bk-ink);
	}

	.book-upload-zone__hint {
		font-size: 11px;
		color: var(--bk-muted);
		margin-top: 4px;
	}

	.book-cover-preview {
		margin-bottom: 14px;
		border-radius: 10px;
		overflow: hidden;
		box-shadow: 0 8px 24px rgba(28, 25, 23, 0.15);
		max-width: 140px;
	}

	.book-cover-preview img {
		width: 100%;
		display: block;
	}

	.book-settings-panel {
		background: #fff;
		border-radius: 12px;
		padding: 22px;
		border: 1px solid var(--bk-border);
		box-shadow: 0 2px 10px rgba(28, 25, 23, 0.04);
	}

	.book-toggle-row {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 12px;
		padding: 14px 0;
		border-bottom: 1px solid #f5f5f4;
	}

	.book-toggle-row:last-child {
		border-bottom: none;
		padding-bottom: 0;
	}

	.book-toggle-row__label {
		font-size: 13px;
		font-weight: 600;
		color: #374151;
	}

	.book-toggle-row__hint {
		font-size: 11px;
		color: var(--bk-muted);
		margin-top: 2px;
		font-weight: 400;
	}

	.book-toggle-switch {
		position: relative;
		display: inline-block;
		width: 50px;
		height: 28px;
		flex-shrink: 0;
	}

	.book-toggle-switch input {
		opacity: 0;
		width: 0;
		height: 0;
		position: absolute;
	}

	.book-toggle-slider {
		position: absolute;
		inset: 0;
		cursor: pointer;
		background: #d6d3d1;
		border-radius: 34px;
		transition: 0.25s;
	}

	.book-toggle-slider:before {
		content: "";
		position: absolute;
		height: 22px;
		width: 22px;
		left: 3px;
		bottom: 3px;
		background: #fff;
		border-radius: 50%;
		transition: 0.25s;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
	}

	.book-toggle-switch input:checked + .book-toggle-slider {
		background: linear-gradient(135deg, var(--bk-ember-deep) 0%, var(--bk-ember) 100%);
	}

	.book-toggle-switch input:checked + .book-toggle-slider:before {
		transform: translateX(22px);
	}

	.book-form-actions {
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 14px;
		padding-top: 28px;
		margin-top: 8px;
		border-top: 1px solid var(--bk-border);
	}

	.book-btn-submit {
		background: linear-gradient(135deg, var(--bk-ember) 0%, var(--bk-ember-deep) 100%);
		border: none;
		border-radius: 10px;
		padding: 13px 36px;
		font-size: 15px;
		font-weight: 600;
		color: #fff;
		box-shadow: 0 4px 16px rgba(168, 90, 50, 0.3);
		transition: all 0.25s ease;
		cursor: pointer;
		text-transform: uppercase;
		letter-spacing: 0.04em;
	}

	.book-btn-submit:hover {
		transform: translateY(-2px);
		box-shadow: 0 8px 22px rgba(168, 90, 50, 0.38);
		color: #fff;
	}

	.book-btn-cancel {
		color: var(--bk-muted) !important;
		font-weight: 600;
		font-size: 14px;
		text-decoration: none !important;
		padding: 13px 20px;
	}

	.book-btn-cancel:hover {
		color: var(--bk-ink) !important;
	}

	.book-form-header-bar {
		display: flex;
		align-items: center;
		justify-content: space-between;
		margin-bottom: 0;
		padding: 0 4px;
	}

	.book-form-header-bar h1 {
		font-size: 20px;
		font-weight: 700;
		color: var(--bk-ink);
		margin: 0;
	}

	.book-form-header-bar .btn-back {
		background: #fff;
		border: 2px solid #e7e5e4;
		color: var(--bk-ink) !important;
		border-radius: 10px;
		padding: 8px 16px;
		font-weight: 600;
		font-size: 13px;
		text-decoration: none !important;
		transition: all 0.2s;
	}

	.book-form-header-bar .btn-back:hover {
		border-color: var(--bk-ember);
		color: var(--bk-ember) !important;
	}

	@media (max-width: 768px) {
		.book-form-body { padding: 0 20px 28px; }
		.book-form-banner { margin: 0 -20px 22px -20px; }
		.book-stats, .book-search, .book-body { padding-left: 16px; padding-right: 16px; }
	}
</style>
