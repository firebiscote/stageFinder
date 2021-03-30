
//*************************************************************************//
//*************************************************************************//
//Dans ces deux variables on stock le nom de notre cache + l'assets qui contient les fichiers à garder en cache.
const NomDuCache= 'ma_sauvegarde';
const assets = [
    '/',
    '/resources/views/auth/login.blade.php',
    '/resources/views/auth/verify.blade.php',
    '/resources/views/companies/create.blade.php',
    '/resources/views/companies/edit.blade.php',
    '/resources/views/companies/index.blade.php',
    '/resources/views/companies/rate.blade.php',
    '/resources/views/companies/show.blade.php',
    '/resources/views/delegates/create.blade.php',
    '/resources/views/delegates/edit.blade.php',
    '/resources/views/delegates/index.blade.php',
    '/resources/views/delegates/show.blade.php',
    '/resources/views/layouts/app.blade.php',
    '/resources/views/offers/apply.blade.php',
    '/resources/views/offers/create.blade.php',
    '/resources/views/offers/edit.blade.php',
    '/resources/views/offers/index.blade.php',
    '/resources/views/offers/mail.blade.php',
    '/resources/views/offers/query.blade.php',
    '/resources/views/offers/show.blade.php',
    '/resources/views/offers/wishlist.blade.php',
    '/resources/views/students/create.blade.php',
    '/resources/views/students/edit.blade.php',
    '/resources/views/students/index.blade.php',
    '/resources/views/students/show.blade.php',
    '/resources/views/tutors/create.blade.php',
    '/resources/views/tutors/edit.blade.php',
    '/resources/views/tutors/index.blade.php',
    '/resources/views/tutors/index.blade.php',
    '/resources/views/appLayout.blade.php',
    '/resources/js/app.js',
    '/public/image/cesi.png',
    '/public/image/cesi.jpg',
    '/public/js/app.js',
    '/public/js/bootstrap.js',
    '/public/manifest.json',
    'https://fonts.googleapis.com/icon?family=Material+Icons',
    'https://fonts.gstatic.com/s/materialicons/v70/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2'
];

//*************************************************************************//
//*************************************************************************//
//Installation du service worker
self.addEventListener('install', evt => {

     evt.waitUntil(caches.open(NomDuCache).then(cache => {
        console.log('caching shell assets');
        cache.addAll(assets);
        })
    )
  
});

//*************************************************************************//
//*************************************************************************//
//Activation du Service Worker
self.addEventListener('activate', evt => {
    console.log('service Worker has been activated');
});

//*************************************************************************//
//*************************************************************************//
//fetch event afin de répondre quand on est en mode hors ligne.
self.addEventListener('fetch', function(event) {
    event.respondWith(
      caches.open('ma_sauvegarde').then(function(cache) {
        return cache.match(event.request).then(function (response) {
          return response || fetch(event.request).then(function(response) {
            cache.put(event.request, response.clone());
            return response;
          });
        });
      })
    );
  });
