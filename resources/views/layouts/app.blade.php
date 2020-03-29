<!doctype html>
<html lang="en"
      prefix="og: http://ogp.me/ns#">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta
        name="viewport"
        content="width=device-width, initial-scale=1,maximum-scale=1" , shrink-to-fit=no" />
  <link rel="icon" href="/favicon.ico" />

  <title>Corona Virus Information</title>

  <!-- Meta Tags -->
  <meta
        name="description"
        content="Information on the corona virus (covid-19) , news and statistics from around the world, with contact informatio" />

  <meta
        name="keywords"
        content="corona, covid-19 , covid 19 , covid death count, corona south africa" />

  <meta name="author" content="Zaid Kajee" />

  <link rel="apple-touch-icon" sizes="57x57" href="/ico/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/ico/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/ico/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/ico/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/ico/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/ico/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/ico/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/ico/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/ico/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="/ico/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/ico/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/ico/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/ico/favicon-16x16.png">

  <meta name="theme-color" content="#e3342f">

  <script data-ad-client="ca-pub-2683239704362097" async
          src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>


  <script>
    // Check that service workers are registered
            if ('serviceWorker' in navigator) {
            // Use the window load event to keep the page load performant
            window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js');
            });
            }
  </script>

  <!-- Open Graph -->
  <meta
        property="og:title"
        content="Corona Virus Information" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="{{ URL::current() }}" />
  <meta
        property="og:image"
        content="@yield('meta-image','https://covid.niftybit.co.za/img/virus.png')" />
  <meta property="og:image:width" content="200" />
  <meta property="og:image:height" content="200" />
  <meta
        property="og:description"
        content="Information on the corona virus (covid-19) , news and statistics from around the world" />

  <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous" />
  <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:700,400|Exo+2:700&display=swap"
        rel="stylesheet" />

  <link rel="stylesheet" href="{{ mix('/css/app.css')}}">

  <link rel="manifest" href="/manifest.json">



</head>

<body>
  <div id="app">


    <header-component></header-component>

    <main>
      @yield('content')
    </main>

  </div><!-- end of vue js -->

  {{-- <div class="container">
    <div class="row">
      <div class="col">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Covid -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-2683239704362097"
             data-ad-slot="4149133732"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </div>
    </div>
  </div> --}}


  <div class="bg-light py-3 mt-3">
    <div class="container text-center">
      <div class="row">
        <div class="col">
          <small class="text-black-50">SHARE PAGE</small><br /><br />
          <a
             href="whatsapp://send?text=https://covid.niftybit.co.za" target="_blank" aria-label="WhatsApp"
             rel="noopener" class="resp-sharing-button__link mb-1">
            <div class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--medium">
              <div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--circle"></div>WhatsApp
            </div>
          </a> <a
             href="https://www.facebook.com/sharer/sharer.php?u=https://covid.niftybit.co.za"
             target="_blank" aria-label="Facebook" rel="noopener" class="resp-sharing-button__link mb-1">
            <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--medium">
              <div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--circle"></div>Facebook
            </div>
          </a> <a
             href="https://twitter.com/intent/tweet/?text=Covid 19 Information.&amp;url=https://covid.niftybit.co.za"
             target="_blank" aria-label="Twitter" rel="noopener" class="resp-sharing-button__link mb-1">
            <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--medium">
              <div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--circle"></div>Twitter
            </div>
          </a>

        </div>
      </div>
    </div>
  </div>


  <footer class="py-5 text-white font-percent text-center bg-dark">

    <div class="container">
      <h6>MAINTAINED BY:</h6>
      <a href="https://niftybit.co.za" class="text-success">Zaid Kajee</a><br /><br>
      <h6>ATTRIBUTIONS:</h6>
      <a href="https://newsapi.org" class="text-success">newsapi.org</a><br />
      <a href="https://www.flaticon.com" class="text-success">www.flaticon.com</a><br />
      <a href="https://github.com/NovelCOVID/API" class="text-success">novelCovid</a>
    </div>
  </footer>

  {{-- <a href="/" class="float">
    <img src="/img/refresh.png" alt="refresh" height="60">
  </a> --}}




  <script src="{{ mix('/js/app.js') }}"></script>


  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-76003418-2"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-76003418-2');
  </script>

</body>

</html>