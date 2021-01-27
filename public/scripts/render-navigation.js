const navigationContainer = document.querySelector(".navigation");

let controllerMapping = window.location.pathname.split("/")[1];

fetch(`http://localhost:8080/${controllerMapping}/getnavigation`, {
        method: "GET",
        body: JSON.stringify()
    })
    .then(response => response.json())
    .then(response => {
        for (const [key, value] of Object.entries(response)){
            let element = document.createElement('a');
            element.className = "navigation__button";
            element.textContent = key
            element.setAttribute("href", value);
            navigationContainer.appendChild(element);
        }
    })
