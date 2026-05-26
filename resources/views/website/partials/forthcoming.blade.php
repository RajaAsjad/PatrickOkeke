<section class="section {{ $class ?? '' }}">
    <div class="container">
        <div data-anim="rise">
            <p class="eyebrow">Forthcoming</p>
            <h2 class="display-h2" style="margin-top:12px">In the workshop</h2>
            @if(!empty($intro))
                <p class="text-body" style="margin-top:16px;max-width:42rem">{{ $intro }}</p>
            @endif
        </div>
        <ul class="workshop-list">
            <li class="workshop-item" data-anim="left" data-delay="80">
                <span class="workshop-year">2026</span>
                <div class="workshop-body">
                    <h3 class="display-h3">The Quiet Architecture</h3>
                    <p class="text-muted" style="margin-top:4px">On the unseen structures behind every creative life.</p>
                </div>
                <span class="workshop-status">Coming 2026</span>
            </li>
            <li class="workshop-item" data-anim="right" data-delay="180">
                <span class="workshop-year">2026</span>
                <div class="workshop-body">
                    <h3 class="display-h3">Letters to a Young Builder</h3>
                    <p class="text-muted" style="margin-top:4px">A correspondence on craft, doubt, and finishing the work.</p>
                </div>
                <span class="workshop-status">Coming 2026</span>
            </li>
        </ul>
    </div>
</section>
