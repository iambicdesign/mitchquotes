        <div class="navigation">
            <a href="<?php echo URL; ?>">Home</a>
            <a href="<?php echo URL; ?>quote/permalink/<?php echo $this->quotemodel->getRandomID(); ?>" title="Random Mitch Hedberg Quote">Random</a>
            <a href="<?php echo URL; ?>quote/top" title="The Best Mitch Hedberg Quotes">Top Quotes</a>
            <a href="<?php echo URL; ?>quote/bottom" title="The Worst Mitch Hedberg Quotes">Worst* Quotes</a>
            <a href="<?php echo URL; ?>quote/latest" title="The Latest Hedberg Quotes">Recently Added Quotes</a>
        </div>
        <div class="disclaimer">
            <p>* There is no such thing as a <strong>bad</strong> Mitch Hedberg quote.</p>
        </div>
        <div class="footer">
        	<p>Copyright &copy;<?php echo date('Y'); ?> Iambic Design, LLC | <a href="http://iambicdesign.net" title="Iambic Design"
        		target="_blank">Custom Software Development</a> | Built on the <a href="https://github.com/panique/mini"
        		title="MINI PHP Framework" target="_blank">MINI PHP MVC Framework</a></p>
        </div>
    </div><!--.container-->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script>
        var url = "<?php echo URL; ?>";
    </script>
    <script src="<?php echo URL; ?>js/application.js"></script>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-72564603-6', 'auto');
    ga('send', 'pageview');

    </script>
</body>
</html>
