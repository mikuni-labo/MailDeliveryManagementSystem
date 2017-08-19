<footer class="footer text-center">
    <div class="container">
        <span id="scroll-top">
            <a href="#"><i class="fa fa-angle-double-up"></i></a>
        </span>

        <small>
            &copy;&nbsp;<?= date('Y', time()) ?>&nbsp;
            <a href="{{ route('home') }}">{{ config('app.name') }}</a>
            &nbsp;All&nbsp;Rights&nbsp;Reserved.
        	</small>
    </div>
</footer>
