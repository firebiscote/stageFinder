
//*************************************************************************//
//*************************************************************************//
//Dans ces deux variables on stock le nom de notre cache + l'assets qui contient les fichiers à garder en cache.
const CACHE_NAME= 'mySave';
const ASSETS = [
  '/',
  '../resources/views/auth/login.blade.php',
  '../resources/views/auth/verify.blade.php',
  '/resources/views/companies/create.blade.php',
  '../resources/views/companies/edit.blade.php',
  '../resources/views/companies/index.blade.php',
  '../resources/views/companies/rate.blade.php',
  '../resources/views/companies/show.blade.php',
  '../resources/views/delegates/create.blade.php',
  '../resources/views/delegates/edit.blade.php',
  '../resources/views/delegates/index.blade.php',
  '../resources/views/delegates/show.blade.php',
  '../resources/views/layouts/app.blade.php',
  '../resources/views/offers/apply.blade.php',
  '../resources/views/offers/create.blade.php',
  '../resources/views/offers/edit.blade.php',
  '../resources/views/offers/index.blade.php',
  '../resources/views/offers/mail.blade.php',
  '../resources/views/offers/query.blade.php',
  '../resources/views/offers/show.blade.php',
  '../resources/views/offers/wishlist.blade.php',
  '../resources/views/students/create.blade.php',
  '../resources/views/students/edit.blade.php',
  '../resources/views/students/index.blade.php',
  '../resources/views/students/show.blade.php',
  '../resources/views/tutors/create.blade.php',
  '../resources/views/tutors/edit.blade.php',
  '../resources/views/tutors/index.blade.php',
  '../resources/views/appLayout.blade.php',
  '../resources/js/app.js',
  '/image/cesi.png',
  '/image/cesi.jpg',
  '/js/app.js',
  '/manifest.json',
  'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'
];

self.addEventListener('install', evt => {
     evt.waitUntil(caches.open(CACHE_NAME).then(cache => {
        console.log('caching shell assets');
        cache.addAll(ASSETS);
        })
    )
  
});

self.addEventListener('activate', evt => {
    console.log('service Worker has been activated');
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
      caches.open('CACHE_NAME').then(function(cache) {
        return cache.match(event.request).then(function (response) {
          return response || fetch(event.request).then(function(response) {
            cache.put(event.request, response.clone());
            return response;
          });
        });
      })
    );
  });
