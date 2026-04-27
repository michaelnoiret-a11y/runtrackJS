class Router {
  constructor(routes) {
    this.routes = routes;
    this._loadInitialRoute();
  }
    _getCurrentURL() {
    const path = window.location.pathname;
    return path;
  }
  _matchUrlToRoute(urlSegs) {
    const matchedRoute = this.routes.find(route => route.path === urlSegs);
    return matchedRoute;
  }
  _loadInitialRoute() {
    const pathnameSplit = window.location.pathname.split('/');
    const pathSegs = pathnameSplit.length > 1 ? pathnameSplit.slice(1) : '';

    this.loadRoute(...pathSegs);
  }
  loadRoute(...urlSegs) {
    const matchedRoute = this._matchUrlToRoute(urlSegs);
    if (!matchedRoute) {
      throw new Error('Route not found');
    }
    matchedRoute.callback();
  }
  navigateTo(path) {
    window.history.pushState({}, '', path);
    this.loadRoute(path);
  }
}

const routes = [
  // { path: '/Index', callback: () => console.log('Index') },
  { path: '/Contact', callback: () => console.log('Contact') },
  { path: '/Favoris', callback: () => console.log('Favoris') },
  { path: '/ExporterCSV', callback: () => console.log('Exporter CSV') }
];

const router = new Router(routes);
router.navigateTo('/about');

window.addEventListener('popstate', () => {
  router._loadInitialRoute();
});