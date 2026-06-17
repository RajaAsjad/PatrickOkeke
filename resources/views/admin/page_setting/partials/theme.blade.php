<style>
	.page-admin {
		--pg-ember: #a85a32;
		--pg-ember-deep: #7c4a2d;
		--pg-ember-light: #c9845c;
		--pg-cream: #f5f3f0;
		--pg-text: #1c1917;
	}

	.page-setting-shell {
		background: #fff;
		border-radius: 12px;
		box-shadow: 0 4px 24px rgba(28, 25, 23, 0.08);
		border: 1px solid rgba(168, 90, 50, 0.1);
		overflow: hidden;
		margin: 20px 0;
	}

	.page-setting-body {
		padding: 0 30px 40px;
		background: var(--pg-cream);
	}

	.page-setting-shell .section-banner {
		background: linear-gradient(135deg, var(--pg-ember-deep) 0%, var(--pg-ember) 52%, var(--pg-ember-light) 100%) !important;
		padding: 16px 20px;
		margin: 0 -40px 25px -40px;
		border-bottom: 2px solid rgba(124, 74, 45, 0.45);
		box-shadow: 0 4px 20px rgba(168, 90, 50, 0.18);
		display: flex;
		justify-content: center;
		align-items: center;
		position: relative;
	}

	.page-setting-shell .section-banner h3 {
		margin: 0;
		font-size: 18px;
		font-weight: 600;
		color: #fff !important;
		letter-spacing: 0.06em;
		text-transform: uppercase;
		text-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
	}

	.page-setting-shell .section-banner .btn {
		background: #fff;
		color: var(--pg-ember-deep) !important;
		border: 2px solid rgba(255, 255, 255, 0.95);
		padding: 8px 24px;
		border-radius: 25px;
		font-size: 13px;
		font-weight: 700;
		text-decoration: none;
		transition: all 0.3s ease;
		position: absolute;
		right: 20px;
		display: inline-flex;
		align-items: center;
		gap: 6px;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.12);
	}

	.page-setting-shell .section-banner .btn:hover {
		background: var(--pg-text);
		color: #fff !important;
		border-color: var(--pg-text);
		transform: translateY(-2px);
		box-shadow: 0 4px 14px rgba(28, 25, 23, 0.2);
	}

	.page-setting-shell .section-banner .btn i {
		font-size: 12px;
	}

	.page-setting-alert {
		background: #ecfdf5;
		border: 1px solid #6ee7b7;
		border-radius: 8px;
		padding: 12px 16px;
		color: #14532d;
		font-weight: 500;
		margin-bottom: 20px;
	}

	.page-setting-shell .section-block {
		margin-bottom: 40px;
		padding-bottom: 30px;
		border-bottom: 1px solid rgba(168, 90, 50, 0.1);
	}

	.page-setting-shell .section-block:last-of-type {
		border-bottom: none;
		margin-bottom: 30px;
		padding-bottom: 0;
	}

	.page-setting-shell .section-heading {
		background: linear-gradient(90deg, #fdf8f4 0%, #f5ebe0 100%);
		padding: 12px 20px;
		margin: 0 0 25px 0;
		border-radius: 8px;
		border: 1px solid rgba(168, 90, 50, 0.18);
		box-shadow: 0 2px 8px rgba(28, 25, 23, 0.04);
	}

	.page-setting-shell .section-heading h4 {
		margin: 0;
		font-size: 15px;
		font-weight: 700;
		color: var(--pg-text);
		letter-spacing: 0.05em;
		text-transform: uppercase;
		display: flex;
		align-items: center;
		gap: 8px;
	}

	.page-setting-shell .section-heading h4 i {
		font-size: 16px;
		color: var(--pg-ember);
	}

	.page-setting-shell .form-group {
		margin-bottom: 25px;
	}

	.page-setting-shell .form-group label {
		font-weight: 600;
		color: #374151;
		margin-bottom: 10px;
		font-size: 14px;
		display: block;
	}

	.page-setting-shell .form-control {
		border: 2px solid #e7e5e4;
		border-radius: 8px; 
		font-size: 14px;
		line-height: 1.6;
		transition: all 0.3s ease;
		background: #fff;
		box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
		width: 100%;
	}

	.page-setting-shell textarea.form-control {
		resize: vertical;
		min-height: 120px;
	}

	.page-setting-shell .form-control:focus {
		border-color: rgba(168, 90, 50, 0.55);
		box-shadow: 0 0 0 3px rgba(168, 90, 50, 0.12);
		outline: none;
	}

	.page-setting-shell .form-control:hover {
		border-color: #d6d3d1;
	}

	.page-setting-shell .form-hint {
		color: #6b7280;
		display: block;
		margin-top: 5px;
		font-size: 13px;
	}

	.page-setting-shell .existing-photo {
		border-radius: 8px;
		border: 1px solid rgba(168, 90, 50, 0.15);
		object-fit: cover;
		margin-top: 12px;
		box-shadow: 0 2px 10px rgba(28, 25, 23, 0.08);
	}

	.page-setting-shell .image-preview-container {
		margin-top: 15px;
		padding: 15px;
		background: #fff;
		border-radius: 8px;
		border: 2px dashed rgba(168, 90, 50, 0.25);
		display: inline-block;
	}

	.page-setting-shell .action-section {
		text-align: center;
		padding-top: 30px;
		margin-top: 30px;
		border-top: 1px solid rgba(168, 90, 50, 0.1);
	}

	.page-setting-shell .btn-update {
		background: linear-gradient(135deg, var(--pg-ember-deep) 0%, var(--pg-ember) 100%);
		border: none;
		border-radius: 8px;
		padding: 12px 40px;
		font-size: 16px;
		font-weight: 600;
		color: #fff;
		box-shadow: 0 4px 16px rgba(168, 90, 50, 0.3);
		transition: all 0.3s ease;
		cursor: pointer;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.page-setting-shell .btn-update:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 22px rgba(168, 90, 50, 0.38);
		background: linear-gradient(135deg, #6b3f26 0%, var(--pg-ember-deep) 100%);
		color: #fff;
	}

	.page-setting-shell .btn-update:active {
		transform: translateY(0);
	}

	.page-setting-shell .settings-section {
		background: #fff;
		padding: 25px;
		border-radius: 8px;
		margin-top: 20px;
		border: 1px solid rgba(168, 90, 50, 0.12);
		box-shadow: 0 2px 10px rgba(28, 25, 23, 0.04);
	}

	.page-setting-shell .toggle-switch-container {
		display: flex;
		align-items: center;
		gap: 15px;
		flex-wrap: wrap;
	}

	.page-setting-shell .toggle-label-text {
		color: #6b7280;
		font-size: 13px;
	}

	.page-setting-shell .toggle-switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 32px;
	}

	.page-setting-shell .toggle-switch input {
		opacity: 0;
		width: 0;
		height: 0;
	}

	.page-setting-shell .toggle-slider {
		position: absolute;
		cursor: pointer;
		inset: 0;
		background-color: #d6d3d1;
		transition: 0.4s;
		border-radius: 34px;
		box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
	}

	.page-setting-shell .toggle-slider:before {
		position: absolute;
		content: "";
		height: 24px;
		width: 24px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		transition: 0.4s;
		border-radius: 50%;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
	}

	.page-setting-shell .toggle-switch input:checked + .toggle-slider {
		background: linear-gradient(135deg, var(--pg-ember-deep) 0%, var(--pg-ember) 100%);
		box-shadow: 0 0 0 3px rgba(168, 90, 50, 0.2);
	}

	.page-setting-shell .toggle-switch input:checked + .toggle-slider:before {
		transform: translateX(28px);
	}

	.page-setting-shell .toggle-switch input:focus + .toggle-slider {
		box-shadow: 0 0 0 3px rgba(168, 90, 50, 0.15);
	}

	.page-setting-shell .toggle-status.active {
		background: #d4edda;
		color: #155724;
	}

	.page-setting-shell .toggle-status.inactive {
		background: #fef3c7;
		color: var(--pg-ember-deep);
	}

	.page-setting-shell .toggle-status {
		display: inline-block;
		padding: 4px 12px;
		border-radius: 12px;
		font-size: 12px;
		font-weight: 600;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.page-setting-shell .bullet-point-row {
		display: flex;
		gap: 8px;
		margin-bottom: 8px;
		align-items: center;
	}

	.page-setting-shell .bullet-point-row .form-control { flex: 1; }
	.page-setting-shell .bullet-point-row .btn-remove-bullet { flex-shrink: 0; }

	.page-setting-shell #btn-add-bullet {
		margin-top: 10px;
		background: linear-gradient(135deg, var(--pg-ember-deep) 0%, var(--pg-ember) 100%);
		color: #fff;
		border: none;
		border-radius: 8px;
		padding: 8px 16px;
		font-weight: 600;
		transition: all 0.3s ease;
	}

	.page-setting-shell #btn-add-bullet:hover {
		background: linear-gradient(135deg, #6b3f26 0%, var(--pg-ember-deep) 100%);
		color: #fff;
		box-shadow: 0 4px 12px rgba(168, 90, 50, 0.3);
	}

	.page-setting-shell .social-links-grid {
		display: grid;
		grid-template-columns: 1fr;
		gap: 0;
	}

	.page-setting-shell .social-links-grid .form-group {
		margin-bottom: 20px;
	}

	.page-setting-shell .social-links-grid .form-group:last-child {
		margin-bottom: 0;
	}

	@media (max-width: 768px) {
		.page-setting-body { padding: 20px; }
		.page-setting-shell .section-banner { margin: 0 -20px 20px -20px; padding: 12px 15px; }
		.page-setting-shell .section-banner h3 { font-size: 16px; }
	}
</style>
