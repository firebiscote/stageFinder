if('serviceWorker' in navigator)
{
    navigator.serviceWorker.register('stageFinder/public/js/ServiceWorker.js')
    .then((sw) => console.log('Le Service Worker a été pris en charge', sw))
    .catch((err) => console.log('Le Service Worker est introuvable', err));
}