// Inside app.js

function handleRouteChange() {
    const path = window.location.pathname;
    // Logic to render the view based on the path
}

window.addEventListener('popstate', handleRouteChange);

// Initialize the router
handleRouteChange();

function homeView() {
    return '<h1>Contact</h1>';
}

function aboutView() {
    return '<h1>Favoris</h1>';
}

function exportView() {
    return '<h1>Exporter CSV</h1>'
}

// Update handleRouteChange to render views
function handleRouteChange() {
    const path = window.location.pathname;
    let view;

    switch (path) {
        case '/Favoris':
            view = aboutView();
            break;

        case '/Exporter CSV':
            view = exportView();    

        default:
            view = homeView();
    }

    document.getElementById('app').innerHTML = view;
}

document.querySelectorAll('.route').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        history.pushState(null, '', this.href);
        handleRouteChange();
    });
    fetch('https://api.example.com/data')
    .then(response => response.json())
    .then(data => {
        // Render view with data
    });
});
