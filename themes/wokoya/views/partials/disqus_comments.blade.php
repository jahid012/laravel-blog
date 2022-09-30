@if (__o('disqus_shortname') !== '')

  <div id="disqus_thread"></div>
  <script>
    var disqus_config = function () {
      this.page.url = '{{ url()->current() }}';
      this.page.identifier = '{{ url()->current() }}';
    };

    (function() {
      var d = document, s = d.createElement('script');

      s.src = "https://{{ __o('disqus_shortname') }}.disqus.com/embed.js";

      s.setAttribute('data-timestamp', +new Date());
      (d.head || d.body).appendChild(s);
    })();
  </script>
  <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
@endif
