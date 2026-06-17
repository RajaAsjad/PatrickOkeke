<footer class="site-footer">
    <div class="site-footer__grid">
        <div data-anim="fade">
            <p class="site-footer__brand">Patrick Okeke</p>
            <p class="site-footer__desc">Author of essays and books on culture, technology, and the craft of building a thinking life.</p>
        </div>
        <div data-anim="rise" data-delay="80">
            <p class="eyebrow eyebrow--muted">Explore</p>
            <ul class="site-footer__links">
                <li><a href="{{ route('about') }}">About the author</a></li>
                <li><a href="{{ route('books') }}">All books</a></li>
                <li><a href="{{ route('contact') }}">Contact &amp; press</a></li>
            </ul>
        </div>
        <div data-anim="left" data-delay="160">
            <p class="eyebrow eyebrow--muted">Contact</p>
            <p style="margin-top:16px;font-size:.875rem;line-height:1.6">
                4445 Willard Ave, Ste. 600<br>
                Chevy Chase, MD 20815
            </p>
            <p style="margin-top:12px;font-size:.875rem"><a href="mailto:info@baezepi.com">info@baezepi.com</a></p>
            <p style="margin-top:8px;font-size:.875rem">
                <a href="tel:+13016370818">301 637 0818</a><br>
                <span class="text-muted">Main:</span> <a href="tel:+13013631154">301 363 1154</a><br>
                <span class="text-muted">Fax:</span> <a href="tel:+12272560003">227 256 0003</a>
            </p>
        </div>
    </div>
    <div class="site-footer__bottom" data-anim="fade" data-delay="200">
        <p>&copy; {{ date('Y') }} Patrick Okeke. All rights reserved.</p>
        <p class="site-footer__quote">&ldquo;The page is patient. Begin again.&rdquo;</p>
    </div>
</footer>
