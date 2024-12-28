document.addEventListener('DOMContentLoaded', function() {
    var acceptButton = document.getElementById('accept-cookies');
    var refuseButton = document.getElementById('refuse-cookies');
    var cookieBanner = document.getElementById('cookie-banner');
  
    if (acceptButton && refuseButton && cookieBanner) {
      acceptButton.addEventListener('click', function() {
        // Code pour accepter les cookies
        // Intégrer le suivi Matomo
        var _paq = window._paq || [];
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        var matomoUrl = 'http://100.109.130.85/matomo/'; // URL de votre instance Matomo
        var siteId = 1; // ID du site web dans Matomo
        (function() {
          var u = matomoUrl;
          _paq.push(['setTrackerUrl', u + 'piwik.php']);
          _paq.push(['setSiteId', siteId]);
          var d = document,
              g = d.createElement('script'),
              s = d.getElementsByTagName('script')[0];
          g.type = 'text/javascript';
          g.async = true;
          g.defer = true;
          g.src = u + 'piwik.js';
          s.parentNode.insertBefore(g, s);
        })();
        
        // Fermer le bandeau de cookies
        cookieBanner.style.display = 'none';
      });
  
      refuseButton.addEventListener('click', function() {
        // Code pour refuser les cookies
        // Dans ce cas, aucune action supplémentaire n'est nécessaire
        // Fermer le bandeau de cookies
        cookieBanner.style.display = 'none';
      });
    } else {
      console.error('Les éléments HTML requis ne sont pas présents sur la page.');
    }
  });
  